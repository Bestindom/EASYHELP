<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';
    protected $primaryKey = 'user_id';
    public $timestamps = false;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class, 'provider_id');
    // }
}
