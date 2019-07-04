<?php

namespace app\api\controller;


use app\api\exception\TokenException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use think\facade\Request;

/**
 * api鉴权验证
 * Class Oauth
 * @package app\api\controller
 */
class Oauth
{
    /**
     * 认证授权 通过用户信息和路由
     * @return object
     * @throws TokenException
     */
    final function authenticate()
    {
        return self::certification();
    }

    /**
     * 验证token，获取用户信息
     * @return mixed
     * @throws TokenException
     */
    public static function certification()
    {
        try {

            $authorization = Request::header('authorization');
            $authorization = explode(" ", $authorization);
            $token = $authorization[1];

            $result = JWT::decode($token, config('jwt.publicKey'), array('RS256'));
            return $result->data;

        } catch (SignatureInvalidException $e) {
            throw new TokenException([
                'msg' => '签名失败,无效的token'
            ]);
        } catch (BeforeValidException $e) {
            throw new TokenException([
                'msg' => 'token还未到使用时间'
            ]);
        } catch (ExpiredException $e) {
            dump($e->getMessage());
            throw new TokenException([
                'msg' => 'token已过期'
            ]);
        } catch (\UnexpectedValueException $e) {
            throw new TokenException([
                'msg' => '无效的token'
            ]);
        } catch (\Exception $e) {
//            dump($e->getMessage());
            throw new TokenException();
        }
    }


    /**
     * 检测当前控制器和方法是否匹配传递的数组
     * @param array $arr 需要验证权限的数组
     * @return bool
     */
    public static function match($arr = [])
    {
        $request = Request::instance();
        $arr = is_array($arr) ? $arr : explode(',', $arr);
        if (!$arr) {
            return false;
        }
        $arr = array_map('strtolower', $arr);
        // 是否存在
        if (in_array(strtolower($request->action()), $arr) || in_array('*', $arr)) {
            return true;
        }

        // 没找到匹配
        return false;
    }
}