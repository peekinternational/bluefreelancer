<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFriends extends Model
{
    use HasFactory;
    protected $fillable = [
      'conversation_id',
      'message_id',
      'message',
      'project_id',
      'sender_id',
      'receiver_id',
      'time',
      'message_status',
      'update_by_message'
    ];

    public function senderInfo()
    {
      return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiverInfo()
    {
      return $this->belongsTo(User::class, 'receiver_id');
    }
    public function lastMessage()
    {
      return $this->belongsTo(ChatMessages::class, 'message_id');
    }
}
