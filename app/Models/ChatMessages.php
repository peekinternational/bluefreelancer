<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    use HasFactory;
    protected $fillable = [
      'conversation_id',
      'message_sender',
      'message_receiver',
      'project_id',
      'message_desc',
      'message_file',
      'message_type',
      'message_date',
      'message_status'
    ];

    public static function getUnseenMsg()
    {
      return ChatMessages::where('message_receiver', auth()->id())->where('message_status', 'unread')->count();
    }
    public function senderInfo()
    {
      return $this->belongsTo(User::class, 'message_sender');
    }
    public function receiverInfo()
    {
      return $this->belongsTo(User::class, 'message_receiver');
    }
}
