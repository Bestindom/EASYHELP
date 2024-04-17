<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    // protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function rider(): BelongsToMany
    {
        return $this->belongsToMany(Rider::class, 'user_id');
    }

    public function provider(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class, 'orders', 'user_id', 'user_id');
    }
}
