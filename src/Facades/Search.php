<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/26
 * Time: 16:47
 * Function:
 */

namespace Tanmo\Search\Facades;


use Illuminate\Support\Facades\Facade;
use Tanmo\Search\Query\Searcher;

/**
 * Class Search
 *
 * @method static Searcher build(\Closure $closure)
 */
class Search extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tanmo\Search\Search::class;
    }
}