<?php

namespace linron\thinkfilter\traits;

use think\db\BaseQuery;

trait FilterTrait
{
    public function scopeModelFilter(BaseQuery $query, array $params, string $filterClass): BaseQuery
    {
        return (new $filterClass())->filter($query, $params);
    }

    public static function modelFilter(array $params, string $filterClass): BaseQuery
    {
        return (new $filterClass())->filter((new static())->getQuery(), $params);
    }
}