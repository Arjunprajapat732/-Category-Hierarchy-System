<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Define the relationship to get child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Define the relationship to get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
