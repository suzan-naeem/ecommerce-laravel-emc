<?php

function sliderFormat(array $array, int $number) {
    $arr = [];
    $x = 0;
    foreach ($array as $key => $item) {
        if ($key != 0 && $key % $number == 0) {
            $x++;
        }
        $arr[$x][] = $item;
    }
    return $arr;
}

function getCategories() {
    return \App\Models\Category::all();
}

function getProductImage($product_id) {
    return \App\Models\ProductImage::where('product_id', $product_id)->first()['image'];
}

function isFavorite($product_id) {
    if (auth('client')->check()) {
        $fav = \App\Models\Favorite::where([
            ['client_id', auth('client')->user()->id],
            ['product_id', $product_id]
        ])->first();
        return $fav ? true : false;
    } else {
        return false;
    }
}

function hasDiscount($product) {
    if ($product['discount'] && $product['discount_from'] <= date('Y-m-d')
        && $product['discount_to'] >= date('Y-m-d')) {
        return true;
    }
    return false;
}

function currencies() {
    $currencies = \App\Models\Currency::where('display', 1)->get();
    $arr = [];
    foreach ($currencies as $currency) {
        $arr[] = $currency['name_en'];
    }
    return $arr;
}

function currencyValue() {
    return \App\Models\Currency::where('name_en', session()->get('currency'))->first()['value'];
}

function setting($key) {
    return \App\Models\Setting::where('key', $key)->first()['value'];
}

function getDeliveryCharge($weight) {
    return \App\Models\Weight::getDeliveryCharge($weight);
}
