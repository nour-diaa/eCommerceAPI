<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Validator;

class Category extends Model
{
    protected $table = "category";

    protected $fillable = ["name", "parent"];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public static function validate($inputs, $show=false)
    {
        $rules = [
            "name" => "required|string",
            "parent" => "exists:category,id"
        ];

        return Validator::make($inputs, $rules);
    }

    public static function make($name, $parent)
    {
        assert($name != null);

        $category = Category::create([
            "name" => $name,
            "parent" => $parent
        ]);

        return $category;
    }

    public static function updateObj($id, $name, $parent=null)
    {
        assert($name != null);

        $category = Category::find($id);
        $category->name = $name;
        $category->parent = $parent;
        $category->save();

        return $category;
    }
}
