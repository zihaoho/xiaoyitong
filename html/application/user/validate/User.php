<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-8
 * Time: 下午4:35
 */
namespace app\user\validate;

use think\Validate;

/**
 * Class User
 * @package app\user\validate
 * 用户登录输入验证
 */
class User extends Validate
{
    protected $rule = [
        'mobile'  =>  'require|number|length:11',
        'password' =>  'require|length:32',
    ];

    protected $message = [
        'mobile.require'  =>  '手机号是必须的',
        'password.require' =>  '密码是必须的',
        'mobile.number' =>  '手机号为数字',
        'password.length' =>  '密码在32位',
        'mobile.length' =>  '手机号码只支持11位',
    ];
}