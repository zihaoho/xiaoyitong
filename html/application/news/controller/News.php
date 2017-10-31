<?php

/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-15
 * Time: 上午11:10
 */

namespace app\news\controller;
class News
{
    public function index()
    {
       $args['page'] = input('get.page/d');
       $args['pageRows'] = input('get.pageRows/d');
       $news = new \app\news\model\News();
       return $news->get_news_list($args);
    }

    public function info()
    {
        $args['id'] = input('get.id/d');
        $news = new \app\news\model\News();
        return $news->get_news_info(
            $args);
    }
}