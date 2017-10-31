<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-8
 * Time: 下午4:35
 */
namespace app\news\validate;

use think\Validate;

/**
 * Class User
 * @package app\user\validate
 * 用户登录输入验证
 */
class News extends Validate
{
    protected $rule = [
        'page'  =>  'require|number',
        'pageRows' =>  'require|number',
    ];

    protected $message = [
        'page.require'  =>  '页码是必须的',
        'pageRows.require' =>  '每页记录数是必须的',
        'page.number' =>  '页码必须为数字',
        'pageRows.number' => '每页记录数必须为数字'
    ];
}