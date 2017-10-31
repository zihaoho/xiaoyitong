<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午3:19
 */

namespace app\ncre\model;


use think\Model;

class Level extends Model
{
    protected $connection = 'db_config2';
    protected $table = 'exam_level';

    public function get_level()
    {
        $subject = new Subject();
        $result = $this->select();
        $items = [];
        foreach ($result as $item)
        {
            $sub_result  = $subject->where(['levelId'=> $item['id']])->select();
            $sub_items = [];
            foreach ($sub_result as $sub_item)
            {
                $sub_items[] = ['value'=>$sub_item['id'],'text'=>$sub_item['subjectName']];
            }
            $items[] = ['value'=>$item['id'],'text' => $item['levelName'],'children'=>$sub_items];
        }
        return $items;
    }
}