<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

}
