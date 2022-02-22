<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path', 'profit_percent', 'profit_price'];

    public function getImagePathAttribute()
    {
        return asset('Attachments/product_images/' . $this->image);
    } //end of image path attribute

    public function category()
    {
        return $this->belongsTo(Category::class);
    } //end fo category

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);
    } //end of get profit attribute

    public function getProfitPriceAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;

        return number_format($profit);
    } //end of get profit attribute

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    } //end of orders
}