<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午3:23
 */

namespace app\ncre\model;


use think\Model;

class Subject extends Model
{
    protected $connection = 'db_config2';
    protected $table = 'exam_subject';
}