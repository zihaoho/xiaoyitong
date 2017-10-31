<?php
/**
 * Created by PhpStorm.
 * User: suancaiyu
 * Date: 17-7-8
 * Time: 下午1:49
 */
namespace app\user\model;
use think\Db;
use think\Loader;
use think\Model;
use app\user\model\Token;
use think\Session;
use think\cache\driver\Redis;
use think\Validate;

/**
 * Class User
 * @package app\user\model\
 * 用户操作类
 */
class User extends Model
{
    protected $connection = 'db_config1';
    protected $table = 'user_user';

    public function getAll(){
        $map['phoneNum'] = '13541402046';
        return time();
    }

    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化

    }

    /**
     * 用户登录调用
     */
    public function login($data){
        $result = $this->userValidate($data);
        if(!$result['flag']){
            return $result['msg'];
        }
        $where = $result['msg'];
        //数据库查询
        if($this->where($where)->count()) {
            //登录成功
            $map['token'] = md5(md5(time()) . md5($where['mobile']));
            $map['mobile'] = $where['mobile'];
            $map['createTime'] = time();
            $map['ip'] = $data['ip'];
            $map['device'] = $data['device'];
            $token = new Token;
            if($token->where(['mobile'=>$map['mobile']])->count())
            {
                $token->save($map,['mobile'=>$map['mobile']]);
            }else{
                $token->save($map);
            }
            return returnInfo('登录成功',200,$map);
        }else{
            //登录失败
            return returnInfo('登录失败，不存在的帐号或密码错误',212);
        }
    }

    /**
     * 用户注册调用
     */
    public function registered($data){
        $result = $this->userValidate($data);
        if(!$result['flag']){
            return $result['msg'];
        }
        $where = $result['msg'];
        //验证短信验证码
        $redis = new Redis();
        $code = $redis->get('reg'.$data['phoneNum']);
        $redis->rm('reg'.$data['phoneNum']);
        if(!$code){
            return returnInfo('验证码超时',213);
        }
        if(!($data['code'] == $code)){
            return returnInfo('验证码错误',214);
        }

        //验证用户是否存在
        if($this->where(['mobile'=>$where['mobile']])->count()){
            return returnInfo('用户已存在',216);
        }
        //写入数据库
        $user = ['mobile'=>$where['mobile'],
            'password'=>$where['password'],
            'create_time'=>time()];
        if($this->data($user,true)->isUpdate(false)->save()){
            //注册成功
            $map['phoneNum'] = $data['phoneNum'];
            $map['timestamp'] = time();
            return returnInfo('注册成功',200,$map);
        }else{
            return returnInfo('注册写入数据库失败',215);
            //注册失败
        }
    }

    /**
     * 用户绑定
     */
    public function userBind($data){
        $relu = [
            'token' => 'require|length:32',
            'StuNo' => 'require|length:8|number',
            'idcard' => 'require|length:18'
        ];

        $msg = [
            'token.require' => 'token是必须的',
            'token.length' => 'token格式错误',
            'StuNo.require' => '学号是必须的',
            'StuNo.number' => '学号是数字',
            'StuNo.length' => '学号必须8位',
            'idcard.require' => '身份证是必须的',
            'idcard.length' => '身份证必须18位'
        ];

        $vali = new Validate($relu,$msg);

        if(!$vali->check($data))
        {
            return returnInfo($vali->getError(),210);
        }

        if(!isLogin($data['token']))
        {
            return returnInfo('该用户未登录',218);
        }
        $bind = new Userbind();
        if($bind->where(['StuNo' => $data['StuNo']])->count()){
            return returnInfo('用户已绑定,不可重复绑定',215);
        }

        $result = Db::connect('db_config1')
            ->view('user_auth','mobile')
            ->view('user_user','id','user_auth.mobile = user_user.mobile')
            ->where(['user_auth.token'=>$data['token']])
            ->select();
        $map['user_id'] = $result[0]['id'];
        $map['StuNo'] = $data['StuNo'];
        $map['createTime'] = time();
        $student = new Student();
        if($student->where(['StuNo'=>$data['StuNo'],'idcard'=>$data['idcard']])->count()){
            if($bind->data($map)->save())
            {
                return returnInfo('用户绑定成功',200,['StuNo'=>$data['StuNo'],'phoneNumber'=>$result[0]['mobile']]);
            }
            return returnInfo('用户绑定失败,写数据库失败',215);
        }
        return returnInfo('用户信息不匹配,绑定失败!',217);
    }


    /*
     * 修改密码。忘记密码
     */
    public function forgetPwd($data)
    {
        $result = $this->userValidate($data);
        if(!$result['flag']){
            return $result['msg'];
        }
        $where = $result['msg'];
        //验证短信验证码
        $redis = new Redis();
        $code = $redis->get('forget'.$data['phoneNum']);
        $redis->rm('forget'.$data['phoneNum']);
        if(!$code){
            return returnInfo('验证码超时',213);
        }
        if(!($data['code'] == $code)){
            return returnInfo('验证码错误',214);
        }
        //验证用户是否存在
        if(!($this->where(['mobile'=>$where['mobile']])->count())){
            return returnInfo('用户不存在',216);
        }
        //
        $map['password'] = $where['password'];
        if($this->save($map,['mobile'=>$where['mobile']]))
        {
            $this->logout_mobile($where['mobile']);
            return returnInfo('修改成功',200,['phoneNumber'=>$data['phoneNum']]);
        }
        return returnInfo('不能使用相同密码',215);
    }


    public function logout($token)
    {
        $tokenModel = new Token();
        $result = $tokenModel->token_check($token);
        if($result['code'] != 200)
        {
            return returnInfo($result['msg'],210);
        }
        if($tokenModel->where(['token' => $token])->delete())
        {
            return returnInfo('注销成功',200,array('time'=>time()));
        }
        return returnInfo('注销失败',215);
    }

    public function logout_mobile($mobile)
    {
        $tokenModel = new Token();
        $tokenModel->where(['mobile' => $mobile])->delete();
    }

    /**
     * @param $data
     * @return array
     * 用户验证
     */
    function userValidate($data){
        //建立验证及查询条件
        $where['mobile'] = $data['phoneNum'];
        $where['password'] = $data['password'];
        //输入数据验证
        $validate = Loader::validate('User');
        if(!$validate->check($where)){
            return array('flag'=>false,'msg'=>returnInfo($validate->getError(),210));
        }
        if(!timestampValidate($data['timestamp'])){
            return array('flag'=>false,'msg'=>returnInfo('手机时间错误',211));
        }
        $where['password'] = md5($where['password']);
        return array('flag'=>true,'msg'=>$where);
    }
}