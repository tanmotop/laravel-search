<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/26
 * Time: 17:22
 * Function:
 */

namespace Tanmo\Search\Query;


use Illuminate\Database\Eloquent\Model;

abstract class Field
{
    /**
     * The form field
     * @var string
     */
    protected $formField = '';

    /**
     * The db field
     * @var string
     */
    protected $field = '';

    /**
     * @var string
     */
    protected $query = 'where';

    /**
     * @var
     */
    protected $builder;

    /**
     * Field constructor.
     * @param $field
     * @param null $formField
     */
    public function __construct($field, $formField = null)
    {
        $this->field = $field;
        $this->formField = $formField ?? $field;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->formField;
    }

    /**
     * 绑定builder
     *
     * @param $builder
     * @return $this
     */
    public function bindBuilder($builder)
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * 查询
     *
     * @param $formValue
     * @return mixed
     */
    public function query($formValue)
    {
        /// 单表查询
        $query = $this->query;
        $fields = explode('.', $this->field);

        if (count($fields) == 1) {
            return call_user_func_array([$this->builder, $query], $this->getQueryArgs($formValue));
        }

        /// 关系查询
        $query = 'whereHas';
        [$relation, $this->field] = $fields;

        return call_user_func_array([$this->builder, $query], [$relation, function($builder) use ($formValue) {
            call_user_func_array([$builder, $this->query], $this->getQueryArgs($formValue));
        }]);
    }

    /**
     * 获取查询参数
     *
     * @param $formValue
     * @return mixed
     */
    abstract public function getQueryArgs($formValue);
}