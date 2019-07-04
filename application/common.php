<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 生成订单号
 * @param $title
 * @return string
 */
function createOrderNo($title = NULL)
{
    $orderNo = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    return $title ? $title . $orderNo : $orderNo;
}


/**
 * 获取七牛图片路径
 * @param $value
 * @return string
 */
function getQiniuPath($value)
{
    if (strpos($value, 'http') === 0) {
        return $value;
    }
    $temp = cache('qiniu_path');
    if (!$temp) {
        cache('qiniu_path', config('qiniu.path'), ['expire' => 3600]);
        $temp = cache('qiniu_path');
    }

    return $value ? $temp . $value : $value;
}

/**
 * 返回数据
 * @param array $data
 * @param int $code 成功返回0
 * @param string $message
 * @param array $header
 * @return \think\response\Json
 */
function jsonMsg($data = [], $code = 0, $message = 'success', $header = [])
{
    http_response_code($code);    //设置返回头部状态
    $return['code'] = (int)$code;
    $return['msg'] = $message;
    $return['data'] = is_array($data) || is_object($data) ? $data : ['info' => $data];

    foreach ($header as $name => $val) {
        if (is_null($val)) {
            header($name);
        } else {
            header($name . ':' . $val);
        }
    }

    return json($return);
}
