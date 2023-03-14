<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /* protected methods defines classes properties and methods that are only
    accessible within the class itself or its subclasses*/
    protected $table = "users";
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    const USER_TOKEN = "userToken";

    // relationship between two database table (hasMany)
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'created_by');
    }

    
    public function routeNotificationForOneSignal() : array{
        return ['tags'=>['key'=>'userId','relation'=>'=', 'value'=>(string)($this->id)]];
    }

    public function sendNewMessageNotification(array $data) : void {
        $this->notify(new MessageSent($data));
    }

}
