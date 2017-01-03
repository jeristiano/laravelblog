<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    protected $primaryKey = 'lk_id';
    protected $guarded=[];
    public $timestamps = false;
}
