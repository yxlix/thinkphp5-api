<?php


namespace app\api\validate;


class DemoValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'mobile' => 'require|mobile',
        'code' => 'require|number|length:6',
        'password' => 'require|regex:/^([a-fA-F0-9]{32})$/',
        'nickname' => 'requireNotEmpty',
        'gender' => 'require|in:1,2',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [];

    /**
     * 自定义校验
     * @var array
     */
    protected $scene = [
        'edit' => ['nickname', 'gender']
    ];
}