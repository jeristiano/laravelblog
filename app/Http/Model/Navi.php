<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Navi extends Model
{
    protected $table = 'navi';
    protected $primaryKey = 'nv_id';
    protected $guarded=[];
    public $timestamps = false;
}
