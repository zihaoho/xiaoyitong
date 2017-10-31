<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午3:01
 */

namespace app\ncre\model;


use think\Model;

class Examinfo extends Model
{
    protected $connection = 'db_config2';
    protected $table = 'exam_exam_info';

    public function get_info()
    {
        $result = $this->select();
        $items = [];
        foreach ($result as $item)
        {
            $items[] = ['value' => $item['examNum'],'text' => $item['examName']];
        }
        return $items;
    }
}