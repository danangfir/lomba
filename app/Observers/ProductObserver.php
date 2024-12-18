<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        if ($product->stock > 0) {
            StockIn::create([
                'name' => $product->name,
                'stock' => $product->stock,
                'product_id' => $product->id,
                'unit_price' => $product->purchase_price,
                'total_price' => $product->purchase_price * $product->stock,
            ]);
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $oldStock = $product->getOriginal('stock');
        $newStock = $product->stock;
        
        if ($oldStock !== $newStock) {
            if ($newStock > $oldStock) {
                $stockChange = $newStock - $oldStock;
                StockIn::create([
                    'name' => $product->name,
                    'stock' => $stockChange,
                    'product_id' => $product->id,
                    'unit_price' => $product->purchase_price,
                    'total_price' => $product->purchase_price * $stockChange,
                ]);
            } else {
                $stockChange = $oldStock - $newStock;
                StockOut::create([
                    'name' => $product->name,
                    'stock' => $stockChange,
                    'product_id' => $product->id,
                    'unit_price' => $product->selling_price,
                    'total_price' => $product->selling_price * $stockChange,
                ]);
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if ($product->stock > 0) {
            StockOut::create([
                'name' => "Stock out due to product deletion: {$product->name}",
                'stock' => $product->stock,
                'product_id' => $product->id,
                'unit_price' => $product->selling_price,
                'total_price' => $product->selling_price * $product->stock,
            ]);
        }
    }
}