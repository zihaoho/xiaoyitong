<?php

/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-14
 * Time: 下午7:15
 */
namespace app\upload\controller;
use think\Request;

class Upload
{
    function index()
    {
//        $file = request()->file('image');
//        ;
//        //$info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
//        return [$file->getSize(),$file->getInfo()];
        return Request::instance()->param(true);
    }
}