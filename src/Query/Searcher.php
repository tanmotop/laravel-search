<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/26
 * Time: 16:36
 * Function:
 */

namespace Tanmo\Search\Query;


use Closure;
use ArrayAccess;
use Tanmo\Search\Query\Filter\Like;
use Tanmo\Search\Query\Filter\Between;
use Tanmo\Search\Query\Filter\Equal;
use Tanmo\Search\Query\Filter\Neq;
use Tanmo\Search\Query\Filter\NotBetween;
use Tanmo\Search\Query\Filter\Lt;
use Tanmo\Search\Query\Filter\Gt;
use Tanmo\Search\Query\Filter\In;
use Tanmo\Search\Query\Filter\NotIn;
use Tanmo\Search\Query\Filter\Gte;
use Tanmo\Search\Query\Filter\Lte;

/**
 * Class Searcher
 * @package Tanmo\Search\Query
 *
 * @method Equal equal($field, $formField = null)
 * @method Neq neq($field, $formField = null)
 * @method Between between($field, $formField = null)
 * @method NotBetween notBetween($field, $formField = null)
 * @method Like like($field, $formField = null)
 * @method Lt lt($field, $formField = null)
 * @method Gt gt($field, $formField = null)
 * @method In in($field, $formField = null)
 * @method NotIn notIn($field, $formField = null)
 * @method Gte gte($field, $formField = null)
 * @method Lte lte($field, $formField = null)
 */
class Searcher implements ArrayAccess
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $supports = ['equal', 'neq', 'between', 'notBetween', 'like', 'lt', 'gt', 'in', 'notIn', 'gte', 'lte'];

    /**
     * @var array
     */
    protected $ignore = [];

    /**
     * Searcher constructor.
     * @param Closure $closure
     */
    public function __construct(Closure $closure)
    {
        if ($closure instanceof Closure) {
            $closure($this);
        }
    }

    /**
     * @param $method
     * @param $arguments
     * @return $this|Field
     */
    public function __call($method, $arguments)
    {
        if (in_array($method, $this->supports)) {
            $className = '\\Tanmo\\Search\\Query\Filter\\' . ucfirst($method);
            return $this->addField(new $className(... $arguments));
        }

        return $this;
    }

    /**
     * @param Field $field
     * @return Field
     */
    protected function addField(Field $field)
    {
        return $this->fields[$field->getKey()] = $field;
    }

    /**
     * @param string|array $field
     */
    public function ignore($field)
    {
        if (is_array($field) && !empty($field)) {
            $this->ignore = array_merge($this->ignore, $field);
        }
        else {
            $this->ignore[] = $field;
        }
    }

    /**
     * @param $field
     * @return bool
     */
    public function isIgnore($field)
    {
        return in_array($field, $this->ignore);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->fields[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->fields[$offset]) ? $this->fields[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param Field $value
     */
    public function offsetSet($offset, $value)
    {
        if (! is_null($offset)) {
            $this->fields[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->fields[$offset]);
    }
}