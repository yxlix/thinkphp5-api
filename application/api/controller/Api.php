<?php

namespace app\api\controller;


use app\api\exception\UserException;
use think\Request;
use think\facade\Cache;

/**
 * api 入口文件基类，需要控制权限的控制器都应该继承该类
 */
class Api
{
    protected $request;
    protected $clientInfo;

    protected $noAuth = [];


    /**
     * Api constructor.
     * @param Request $request tp5.1构造方法注入获取请求对象
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->init();
    }

    public function init()
    {

        if (!Oauth::match($this->noAuth)) {
            $oauth = app('app\api\controller\Oauth');   //tp5.1容器，直接绑定类到容器进行实例化
            return $this->clientInfo = $oauth->authenticate();
        }
    }


    /**
     * 检测空方法
     * @return false|string
     */
    public function _empty()
    {
        return jsonMsg([], 404, 'empty method!');
    }


    /**
     * 校验用户、审核状态
     * @param int $uid
     * @return void
     * @throws UserException
     */
    protected function checkOwner($uid)
    {
        if (!Cache::has('check_' . $uid)) {
            throw new UserException(['code' => '4', 'msg' => '请先完成认证']);
        }
        if (Cache::get('check_' . $uid)['userStatus'] != 1) {
            throw new UserException(['code' => '4', 'msg' => '您的账号已经被关闭，请联系客服！']);
        }
        if (Cache::get('check_' . $uid)['individualStatus'] != 1 && Cache::get('check_' . $uid)['companyStatus'] != 1) {
            throw new UserException(['code' => '4', 'msg' => '请先完成实名认证']);
        }
        return;
    }
}
