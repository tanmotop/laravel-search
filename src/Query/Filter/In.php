<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/28
 * Time: 10:22
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


use Tanmo\Search\Query\Field;

class In extends Field
{
    protected $query = 'whereIn';

    /**
     * 获取查询参数
     *
     * @param $formValue
     * @return mixed
     */
    public function getQueryArgs($formValue)
    {
        // TODO: Implement getQueryArgs() method.
        $arr = [];
        if (is_array($formValue) && !empty($formValue)) {
            $arr = $formValue;
        }

        if (is_string($formValue) && !empty($formValue)) {
            $arr = array_filter(explode(',', $formValue));
        }

        return [$this->field, $arr];
    }
}