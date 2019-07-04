<?php


namespace app\api\validate;


use app\api\exception\ParameterException;
use think\Validate;

class BaseValidate extends Validate
{
    protected $regex = ['images' => '/.*(\.jpeg|\.png|\.jpg|\.bmp)$/'];

    /**
     * 检测所有客户端发来的参数是否符合验证类规则
     * 基类定义了很多自定义验证方法
     * 这些自定义验证方法其实，也可以直接调用
     * @return bool
     * @throws ParameterException
     */
    public function goCheck()
    {
        $params = request()->param();
        $result = $this->check($params);
        if (!$result) {
            throw new ParameterException(['msg' => is_array($this->error) ? implode(
                ';', $this->error) : $this->error,]);
        } else {
            return true;
        }
    }

    /**
     * 过滤传入参数，返回Validate中定义过的值
     * @param array $arrays
     * @return array
     * @throws ParameterException
     */
    public function getDataByRule($arrays = [])
    {
        if (!$arrays) {
            $arrays = request()->param();
        }

        if (array_key_exists('uid', $arrays)) {
            throw new ParameterException(['msg' => '参数中包含非法的uid']);
        }
        $newArray = [];
        if ($this->only == null) {
            foreach ($this->rule as $key => $value) {
                if (array_key_exists($key, $arrays)) {
                    $newArray[$key] = $arrays[$key];
                }
            }
        } else {
            foreach ($this->only as $value) {
                if (array_key_exists($value, $arrays)) {
                    $newArray[$value] = $arrays[$value];
                }
            }
        }
        return $newArray;
    }

    /**
     * 自定义验证规则 如果字段存在 那么验证是否为空
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool|string
     */
    protected function requireNotEmpty($value, $rule, $data, $field)
    {
        $result = true;
        if (array_key_exists($field, $data)) {
            if ($value === '') {
                $result = $field . '不能为空';
            }
        }
        return $result;
    }
}