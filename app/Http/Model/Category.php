<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded=[];

    /*
     * @获得分类方法模型
     * @para array $data 数据数组
     * @para string $pid 上级分类id字段
     * @para string $cid 当前分类id字段
     * @para string $cname 当前分类名字字段
     * @para $deep int 从几级分类开始组织数据,默认为顶级分类
     * @return array $arr数组
     */
    public function getCateTree()
    {
        $category = $this->orderBy('cate_order','asc')->get();
        $result = $this->_getCateTree($category,'cate_pid','cate_id','cate_name',0);
        return $result;
    }

    private function _getCateTree($data, $pid, $cid, $cname, $deep = 0)
    {
        $arr=[];
        foreach ($data as $k => $v) {
            if ($v->$pid == $deep) {
                $data[$k]['_' . $cname] = $data[$k][$cname];
                $arr[] = $data[$k];
                foreach ($data as $m => $n) {
                    if ($n->$pid == $v->$cid) {
                        $data[$m]['_' . $cname] = '┣━━' . $data[$m][$cname];
                        $arr[] = $data[$m];
                    }
                }
            }

        }
        return $arr;
    }

    /*
    * @根据分类id获得分类的名字
    * @para int $cate_id 数据数组
    * @return string $cate_name组
    */

    public static function getCateName($cate_id){
        $cate_name = Category::where(['cate_id'=>$cate_id])->value('cate_name');
        return $cate_name;
    }
}
