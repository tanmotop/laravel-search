<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/27
 * Time: 9:58
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


use Tanmo\Search\Query\Field;

class Equal extends Field
{
    public function getQueryArgs($formValue)
    {
        // TODO: Implement getQueryArgs() method.
        return [$this->field, $formValue];
    }
}