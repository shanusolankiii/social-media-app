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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }


    // In User.php model

    // public function isFollowing(User $user)
    // {
    //     return $this->following()->where('follower_id', $user->id)->exists();
    // }

    public function isFollowing($user_id, $follower_id)
    {
        $followerTable = Follower::where('user_id', '=', $user_id)->where('follower_id', '=', $follower_id)->exists();
        return $followerTable;
    }



    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }


}
