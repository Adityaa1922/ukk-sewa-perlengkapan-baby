<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','phone','address','password','role'];

    protected $hidden = ['password','remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isPetugas(): bool { return $this->role === 'petugas'; }
    public function isUser(): bool    { return $this->role === 'user'; }
    public function isStaff(): bool   { return in_array($this->role, ['admin', 'petugas']); }

    public function rentals(): HasMany        { return $this->hasMany(Rental::class); }
    public function handledRentals(): HasMany { return $this->hasMany(Rental::class, 'handled_by'); }
}