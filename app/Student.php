<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const SEX_UN =0;
    const SEX_GRIL =2;
    const SEX_BOY =1;
    protected $table = 'student';
    public $timestamps = true;
    protected $fillable=['age','sex','name'];
    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }
    //性别字段处理方法
    public function sex($index=null){
        $sex =[self::SEX_UN=>'未知',self::SEX_BOY=>'男', self::SEX_GRIL=>'女'];
        if($index!==null){
           return array_key_exists($index,$sex)?$sex[$index]:$sex[self::UN];
        }
        return $sex;
    }
}

