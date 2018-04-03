<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/26
 * Time: 16:47
 * Function:
 */

namespace Tanmo\Search;


use Closure;
use Tanmo\Search\Query\Searcher;

class Search
{
    /**
     * @param Closure $closure
     * @return Searcher
     */
    public function build(Closure $closure)
    {
        $builder = new Searcher($closure);

        return $builder;
    }
}