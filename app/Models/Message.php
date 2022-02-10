<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from',
        'to',
        'message',
        'is_read',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($message) {
            $message->chat_id = max((int)$message->from, (int)$message->to) . '-' . min((int)$message->from, (int)$message->to);
        });
    }
}
