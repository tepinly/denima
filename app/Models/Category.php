<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products() {
        $this->hasMany(Product::class)->withTimestamps();
    }

    public static function getName($category_id) {
        $name = Category::where('id', $category_id)->value('name');
        return $name;
    }
}
