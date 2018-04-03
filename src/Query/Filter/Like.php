<?php
/**
 * Created by PhpStorm.
 * User: Hong
 * Date: 2018/3/27
 * Time: 12:44
 * Function:
 */

namespace Tanmo\Search\Query\Filter;


use Tanmo\Search\Query\Field;

class Like extends Field
{
    /**
     * @var
     */
    protected $formValue;

    protected $type = 0;

    public function getQueryArgs($formValue)
    {
        switch ($this->type) {
            case 1:
                $value = "%{$formValue}";
                break;
            case 2:
                $value = "{$formValue}%";
                break;
            default:
                $value = "%{$formValue}%";
        }

        return [$this->field, 'like', $value];
    }

    public function left()
    {
        $this->type = 1;
        return $this;
    }

    public function right()
    {
        $this->type = 2;
        return $this;
    }
}