<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comedor extends Model
{
    use HasFactory;

    protected $table = 'comedores';
    public $timestamps = false;
    
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'users_id');
    }
}
