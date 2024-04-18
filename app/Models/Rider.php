<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rider extends Model
{
    use HasFactory;

    protected $table = 'riders';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    // public function usuarios(): HasMany
    // {
    //     return $this->hasMany(Usuario::class, 'users_id');
    // }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'user_id');
    }
}
