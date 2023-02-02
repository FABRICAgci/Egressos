<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function countrie(): HasOne
    {
        return $this->hasOne(Countrie::class, 'id', 'countrie_nascimento');
    }

    public function countrieondemora(): HasOne
    {
        return $this->hasOne(Countrie::class, 'id', 'countrie_mora');
    }

    public function uf(): HasOne
    {
        return $this->hasOne(Uf::class, 'id', 'uf_nascimento');
    }

    public function ufondemora(): HasOne
    {
        return $this->hasOne(Uf::class, 'id', 'uf_mora');
    }

    public function cidade(): HasOne
    {
        return $this->hasOne(Cidade::class, 'id', 'cidade_nascimento');
    }

    public function cidadeondemora(): HasOne
    {
        return $this->hasOne(Cidade::class, 'id', 'cidade_mora');
    }

    public function titulo(): HasOne
    {
        return $this->hasOne(Titulo::class, 'id', 'titulo_id');
    }

    public function area(): HasOne
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }
}
