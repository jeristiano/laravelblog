<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='category';
    protected $primaryKey ='cate_id';
    public $timestamps=false;
}
