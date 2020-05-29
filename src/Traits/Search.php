<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/26
 * Time: 16:34
 * Function:
 */

namespace Tanmo\Search\Traits;


use Tanmo\Search\Query\Searcher;

trait Search
{
    /**
     * @param Searcher $searcher
     * @return $this
     */
    public function search(Searcher $searcher)
    {
        $inputs = request()->all();

        foreach ($inputs as $key => $value) {
            if ((empty($value) && !is_numeric($value)) ||
                (is_array($value) && empty(array_filter($value))) ||
                !isset($searcher[$key]) ||
                $searcher->isIgnore($key)
            ) {
                continue;
            }

            $builder = $searcher[$key]->bindBuilder($builder ?? $this)->query($value);
        }

        return $builder ?? $this;
    }
}