<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Date;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_url',
        'locked_at'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    function scopeFilter($query, ...$filter)
    {
        return $query->when(!empty($filter['sort'] && in_array($filter['sort'], $this->fillable)), function ($query) use ($filter) {
            return $query->orderBy($filter['sort'], $filter['direction']);
        })->when(!empty($filter['date']), function ($query) use ($filter) {
            $date_start = $filter['date'][0] ?? null;
            $date_end = $filter['date'][1] ?? Date::now();
            return $query->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end);
        })->search($filter['search'] ?? '');
    }
    function scopeSearch($query, $search)
    {
        return $query->when(!empty($search), function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });
    }
}
