<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

class Brands extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'brands';
    protected $fillable = ['name', 'slug', 'description', 'user_id',  'logo', 'type', 'outstanding', 'display', 'created_at', 'updated_at'];
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function scopeFilter($query, $fillable = [])
    {
        $date = !empty($fillable['date']) ? $fillable['date'] : [];
        return $query->when(count($date) > 0, function ($query) use ($date) {
            $date_start = $date[0] ?? null;
            $date_end = $date[1] ?? Date::now();
            $query->when($date_start, function ($query) use ($date_start) {
                return $query->whereDate('created_at', '>=', $date_start);
            })->when($date_start, function ($query) use ($date_end) {
                return $query->whereDate('created_at', '<=', $date_end);
            });
        })
            ->search($fillable['search'] ?? null);
    }
    function scopeSort($query, $column, $direction)
    {
        $column = in_array($column, $this->fillable) ? $column : 'created_at';
        return $query->orderBy($column, $direction ?? 'asc');
    }
    function scopeSearch($query, $text)
    {
        return $query->when(!empty($text), function ($query) use ($text) {
            $query->where('name', 'like', "%{$text}%");
        });
    }
}
