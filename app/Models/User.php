<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;


class User extends Authenticatable
{
    use Uuid;
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';


    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'nohp',
        'password',
        'is_dewa',
        'tgl_pembuatan',
        'apikey',
        'wlip'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'apikey',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tgl_pembuatan' => 'datetime',
        'password' => 'hashed',
    ];

}
