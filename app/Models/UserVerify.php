<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserVerify extends Model
{
    use HasFactory;

    protected $table = 'users_verify';
    protected $fillable = [
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function updateToken($user)
    {
        $userVerify = UserVerify::where('user_id', $user->id)->first();
        $userVerify->token = Str::random(64);
        $userVerify->save();

        return $userVerify;
    }
}
