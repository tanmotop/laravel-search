<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/28
 * Time: 10:27
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


class NotIn extends In
{
    protected $query = 'whereNotIn';
}