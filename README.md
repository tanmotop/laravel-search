# laravel-search
Laravel模型查询包

依赖
------------
- php: >=7.0
- laravel/framework: ~5.5

安装
------------
```
composer require tanmo/laravel-search
```

使用
------------

- 在需要查找的`Model`中引入`Tanmo\Search\Traits\Search`的Trait
- 使用`Search` 的Facade创建搜索器`$searcher`
```
$searcher = Search::build(function (Searcher $searcher) {
            $searcher->equal('username');
            $searcher->like('realname');
        });

$users = (new User())->search($searcher)->paginate(10);
```

功能
------------
`Searcher`支持的方法

- `equal($field, $formField = null)`
- `neq($field, $formField = null)`
- `between($field, $formField = null)`
- `notBetween($field, $formField = null)`
- `like($field, $formField = null)`
- `lt($field, $formField = null)`
- `gt($field, $formField = null)`
- `in($field, $formField = null)`
- `notIn($field, $formField = null)`
- `gte($field, $formField = null)`
- `lte($field, $formField = null)`

Tip
------------

- `$field`参数为要搜索的数据表字段名，如果表单`name`属性名与数据表一致则`$formField`可为空，否则`$formField`需填入表单的`name`名称
- 关联查询时`$field`参数可用点`.`隔开，如:`role.name`表示搜索关联表`role`下的`name`字段
