<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-16
 * Time: 下午2:55
 */

namespace app\news\model;


use think\Model;

class Urls extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'news_imgurls';
}