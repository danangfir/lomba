<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{
    protected $table = 'stockout';

    protected $fillable = [
        'name',
        'stock',
        'product_id',
        'unit_price',
        'total_price'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
