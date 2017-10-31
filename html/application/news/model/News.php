<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-15
 * Time: 上午11:22
 */

namespace app\news\model;


use think\Cache;
use think\Loader;
use think\Model;
use think\Validate;

/**
 * Class News
 * @package app\news\model
 */
class News extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'news_info';

    public function get_news_list($data)
    {
        $validate = Loader::validate('News');
        if(!$validate->check($data))
        {
            return returnInfo($validate->getError(),210);
        }

        $result = Cache::get('news_'.$data['page'].'_'.$data['pageRows'],'');
        if( $result != '')
        {
            return returnInfo('请求成功',200, $result);
        }

        $news = $this->order('date desc')->page($data['page'],$data['pageRows'])->select();
        $items = [];

        foreach ($news as $item)
        {
            $items[] = ['ID'=>$item['ID'],'title'=>$item['title'],'author'=>$item['author'],'date'=>$item['date'],'img'=>$item['img']];
        }
        Cache::set('news_'.$data['page'].'_'.$data['pageRows'],$items,5400);
        return returnInfo('请求成功',200, $items);
    }


    public function get_news_info($data)
    {
        $rule = [
            'id'  =>  'require|number',
        ];
        $msg = [
            'id.require'  =>  'ID是必须的',
            'id.number' =>  'ID必须为数字',
        ];
        $validate = new Validate($rule,$msg);
        if( !$validate->check($data))
        {
            return returnInfo($validate->getError(),210);
        }
        Cache::inc('newsinfo_'.$data['id'].'_rdamount');
        $this->add_rdamount($data['id']);
        $result = Cache::get('newsinfo_'.$data['id'],'');
        if($result != '')
        {
            $result['rdamount'] = Cache::get('newsinfo_'.$data['id'].'_rdamount');
            return returnInfo('查询成功',200,$result);
        }

        $news = $this->where(['ID' => $data['id']])->select();
        if(count($news)>0)
        {

            $news = $news[0];
            $imgurls = new Urls();
            $urls = $imgurls->where(['imgId' => $news['ID']])->select();
            $item = [];
            if(count($urls) > 0)
            {
                foreach ($urls as $url)
                {
                    $item[] = $url['url'];
                }
                $news['imgs'] = $item;
            }else{
                $news['imgs'] = [];
            }
            Cache::set('newsinfo_'.$data['id'],$news,5400);
            return returnInfo('查询成功',200,$news);
        }
        return returnInfo('未找到数据',217);
    }

    function add_rdamount($id)
    {
        $this->where(['ID' => $id])->setInc('rdamount');
    }
}