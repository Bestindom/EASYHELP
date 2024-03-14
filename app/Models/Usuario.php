<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'users';
    public $timestamps = false;

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class, 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'id');
    }

    public function comedor(): BelongsTo
    {
        return $this->belongsTo(Comedor::class, 'id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id');
    }
}
