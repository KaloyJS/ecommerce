<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SubCategory extends Model
{
    // enable soft deletes
    use SoftDeletes;

    public $timestamps = true;
    protected $fillable = ['name', 'slug', 'category_id'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function transform($data)
    {
        $subcategories = [];
        foreach ($data as $item) {
            $added = new Carbon($item->created_at);
            array_push($subcategories, [
                'id' => $item->id,
                'name' => $item->name,
                'category_id' => $item->category_id,
                'slug' => $item->slug,
                'added' => $added->toFormattedDateString()
            ]);
        }
        return $subcategories;
    }
}