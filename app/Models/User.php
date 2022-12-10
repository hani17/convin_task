<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin'
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
        'is_admin' => 'boolean',
    ];

    /**
     * @return HasOne<Statistics>
     */
    public function statistics(): HasOne
    {
        return $this->hasOne(Statistics::class);
    }

    public function scopeAdmin(Builder $builder): void
    {
        $builder->where('is_admin', true);
    }

    public function scopeOrdinary(Builder $builder): void
    {
        $builder->where('is_admin', false);
    }

    public function scopeSearch(Builder $builder, string $searchWord): void
    {
        $builder->where('name', 'like', '%' . $searchWord . '%')
        ->orWhere('email', 'like', '%' . $searchWord . '%');
    }
}
