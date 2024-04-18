<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    // protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class, 'rider_id');
    }
}
