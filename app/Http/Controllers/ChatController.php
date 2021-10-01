<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ChatFriends;
use App\Models\ChatMessages;
use App\Models\User;
use Engezli;
use DB;

class ChatController extends Controller
{
    // public function FunctionName(Type $var = null)
    // {
    //   # code...
    // }
    public function addfriend(Request $request)
    {
      $sender_id = $request->input('sender_id');
      $receiver_id = $request->input('receiver_id');
      $check_friend = ChatFriends::where('sender_id',$sender_id)->where('receiver_id',$receiver_id)->first();
      if ($check_friend == null) {
        $check_friend = ChatFriends::where('sender_id',$receiver_id)->where('receiver_id',$sender_id)->first();
      }
      if ($check_friend != null) {
        $conversation_id = $check_friend->conversation_id;
      }else {
      $friendData['conversation_id'] = rand();
      $friendData['sender_id'] = $request->input('sender_id');
      $friendData['receiver_id'] = $request->input('receiver_id');
      $friendData['message_id'] = '0';
      $friendData['time'] = Carbon::now();
      $friend = ChatFriends::create($friendData);
      $conversation_id = $friend->conversation_id;
      }

      return $conversation_id;
    }

    public function friendsList(Request $request, $id){
      $getfriends = ChatFriends::with('senderInfo','receiverInfo','lastMessage','projectInfo')->orWhere('sender_id',$id)
      ->orWhere('receiver_id',$id)->orderBy('id', 'DESC')->get();
      // dd($getfriends);
      return $getfriends;
    }

    public function friendsListUser(Request $request, $id){
      $getfriends = ChatFriends::with('senderInfo','receiverInfo','lastMessage')->orWhere('sender_id',$id)
      ->orWhere('receiver_id',$id)->orderBy('id', 'DESC')->get();
      // dd($getfriends);
      $user_id = $id;
      return view('frontend.notifications',compact('getfriends','user_id'));
      // return $getfriends;
    }

    public function messages(Request $request)
    {
      $user = auth()->user();
      $conversation_id = $request->input('conversation');
      // dd($conversation_id);
      return view('frontend.messages', compact('user','conversation_id'));
    }

    public function singleChat(Request $request){

      // $receiver_id = $request->input('receiver_id');
      $conversation_id = $request->input('conversation_id');

    //   $getsingleChat = ChatMessages::with('senderInfo','receiverInfo')
    //   ->orWhere(function($q) use ($sender_id, $receiver_id){
    //      $q->where('message_sender', $sender_id)
    //        ->where('message_receiver', $receiver_id);
    // })->orWhere(function($h) use ($sender_id, $receiver_id){
    //      $h->where('message_sender', $receiver_id)
    //        ->where('message_receiver', $sender_id);
    // })->get();
      $getsingleChat = ChatMessages::with('senderInfo','receiverInfo')->where('conversation_id', $conversation_id)->get();
      // dd($getsingleChat);
      return $getsingleChat;

    }

    public function send(Request $request)
    {
    // dd($request->all());
      $type = 0;
      $file = $request->file('file');
      if($file != ''){
        $type = 1;
      }else{
        $type = 0;
      }

      $message_status = 'unread';
      $conversation_id = $request->input('conversation_id');

      $data = [
        'message_sender' => $request->input('message_sender'),
        'message_receiver' => $request->input('message_receiver'),
        'message_desc' => $request->input('message'),
        'message_status' => $message_status,
        'conversation_id' => $request->input('conversation_id'),
        'message_date' => $request->input('message_date'),
      ];
      $data['message_type'] = '0';
      if($file != ''){
        $filename= $file->getClientOriginalName();
        // $imagename= 'message-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $extension = $file->getClientOriginalExtension();
        if ($extension == 'png' || $extension == 'jpg'|| $extension == 'jpeg') {
          $data['message_type'] = '1';
        }else {
          $data['message_type'] = '2';
        }
        $imagename= $filename;
        $destinationpath= public_path('images/chat_images');
        $file->move($destinationpath, $imagename);
        $data['message_file'] = $imagename;
      }
      //dd($data);
      if($file != '' || $request->input('message') != ''){
        $Insert = ChatMessages::create($data);
        $friendData['message_id'] = $Insert->id;
        $friendData['message'] = $Insert->message_desc;
        $friendData['message_status'] = $Insert->message_status;
        $friendData['time'] = $Insert->message_date;
        $updateFriend = ChatFriends::where('conversation_id', $conversation_id)->update($friendData);
      }
    }

    public function friendData(Request $request, $id)
    {
      $user = User::whereid($id)->first();
      // $all_languege = json_decode($user->language_id);
      // $language = [];
      // foreach ($all_languege as  $lang) {
      //   $get_lang = Engezli::get_language($lang);
      //   array_push($language,$get_lang);
      // }
      // $user->languages = $language;
      return $user;
    }
    public function seenMessage(Request $request){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');
      $conversation_id = $request->input('conversation_id');
      // dd($receiver_id);
    //   $getsingleChat = DB::table('chat_messages')
    //    ->orWhere(function($q) use ($receiver_id){
    //      $q->where('receiver_id', $receiver_id);
    // })->orWhere(function($h) use ($sender_id, $receiver_id){
    //      $h->where('sender_id', $receiver_id)
    //        ->where('receiver_id', $sender_id);
    // })->update(['message_status', 'seen']);
    //   dd($getsingleChat);
      $where = [
        'conversation_id'=>$conversation_id,
        'message_sender'=>$receiver_id
      ];
      $seenMsg = ChatMessages::where($where)->update(['message_status'=>'read']);

      return $seenMsg;
    }
    public function messsageCount(Request $request,$id){

      $receiver_id = $request->input('receiver_id');
      $sender_id = $request->input('sender_id');

      $msgCountGet = ChatMessages::where('message_receiver',$id)->where('message_status','unread')->get();
      // dd($msgCountGet);
      $wordCount = count($msgCountGet);
      // dd($wordCount);
      return $wordCount;
    }
}
