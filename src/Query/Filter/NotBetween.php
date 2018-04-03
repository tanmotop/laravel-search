<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/28
 * Time: 10:29
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


class NotBetween extends Between
{
    protected $query = 'whereNotBetween';
}