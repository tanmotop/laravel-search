<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/27
 * Time: 10:07
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


use Tanmo\Search\Query\Field;

class Between extends Field
{
    protected $query = 'whereBetween';

    public function getQueryArgs($formValue)
    {
        $start = $formValue['start'];
        $end = $formValue['end'];
        return [$this->field, [$start, $end]];
    }
}