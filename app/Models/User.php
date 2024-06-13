<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
       'role',
       'phone_number',
        'address',
        'status',
        'confirmation_token',
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

    public static function createUser($data){
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'status' => 0, // Inactive
            'confirmation_token' => Str::random(60),
        ]);
    }

    public static function authenticate($email,$password){
        $user = static::where('email', $email)->first();

        if (!$user) {
            return null; // User not found
        }

        if (!$user->status) {
            echo "Email not verified";
            return null; // Account not active
        }

        if (!Hash::check($password, $user->password)) {
            return null; // Incorrect password
        }

        return $user;
    }
}
