<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-21
 * Time: 上午10:21
 */

namespace app\code\validate;

use think\Validate;
class Codeargs extends Validate
{
    protected $rule = [
        'mobile'  =>  'require|number|length:11',
        'tag' =>  'require',
    ];

    protected $message = [
        'mobile.require'  =>  '手机号是必须的',
        'tag.require' =>  '标志是必须的',
        'mobile.number' =>  '手机号为数字',
        'mobile.length' =>  '手机号码只支持11位',
    ];
}