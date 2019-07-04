<?php
/**
 * 调用演示类
 */

namespace app\api\controller\v1;


use app\api\controller\Api;
use app\api\exception\ParameterException;
use app\api\validate\DemoValidate;
use Firebase\JWT\JWT;
use think\response\Json;

class Demo extends Api
{

    /**
     * 不需要鉴权方法
     * index 、 login不需要鉴权
     * ['index','login']
     * 所有方法都不需要鉴权
     * [*]
     */
    public $noAuth = ['index','login'];

    /**
     * 显示资源列表
     * @return Json
     */
    public function index()
    {
        return jsonMsg('无需鉴权调用');
    }

    public function getMyInfo()
    {
        //这里未登录会抛出token错误异常，登录会返回用户的uid
        return jsonMsg($this->clientInfo->uid);
    }

    /**
     * 保存新建的资源
     * @return Json
     * @throws ParameterException
     */
    public function save()
    {
        $validate = new DemoValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule();
        //这里拿到的数据就是DemoValidate中定义的数据,客户端传入没有定义过的数据会被过滤
        return jsonMsg($data);
    }

    /**
     * 保存更新的资源
     * @return Json
     * @throws ParameterException
     */
    public function update()
    {
        $validate = new DemoValidate();
        $validate->scene('edit')->goCheck();
        $data = $validate->getDataByRule();
        //自定义验证，这里拿到的数据是$scene中定义的edit数据
        return jsonMsg($data);
    }

    /**
     * 登录
     * @return Json
     */
    public function login()
    {
        //登录成功后生成token
        $uid = 1;
        $token = $this->createToken($uid);
        return jsonMsg($token);
    }

    /**
     * 生成token
     * @param $uid
     * @return string
     */
    private function createToken($uid)
    {
        $token = config('jwt.token');
        $data = [
            'uid' => $uid,
            'platform' => 'client'
        ];
        $token['data'] = $data;
        $jwt = JWT::encode($token, config('jwt.privateKey'), 'RS256');
        return $jwt;
    }
}