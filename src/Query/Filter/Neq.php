<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/28
 * Time: 10:14
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


use Tanmo\Search\Query\Field;

class Neq extends Field
{

    /**
     * 获取查询参数
     *
     * @param $formValue
     * @return mixed
     */
    public function getQueryArgs($formValue)
    {
        // TODO: Implement getQueryArgs() method.
        return [$this->field, '<>', $formValue];
    }
}