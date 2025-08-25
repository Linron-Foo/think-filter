## 一个让 ThinkPHP8 模型搜索更优雅的包

### 特性介绍
- 让THINKPHP8模型搜索更优雅

### 安装

```
composer require linron/think-filter
```

### 用法
#### 创建过滤器

```
<?php

namespace app\filter;

use linron\thinkfilter\QueryFilter;
use think\db\BaseQuery;

class UserListFilter extends QueryFilter
{

    public function name(string $name): BaseQuery
    {
        return $this->builder->whereLike('name', "%{$name}%");
    }

    public function age(int $age): BaseQuery
    {
        return $this->builder->where('age', $age);
    }
}
```

#### 模型中使用

```
<?php

namespace app\model;

use linron\thinkfilter\src\traits\FilterTrait;
use think\Model;

class UserModel extends Model
{
    use FilterTrait;

    protected string $table = 'zl_user';
}
```

```
<?php

namespace app\service;

use app\domain\UserListSearchDto;
use app\filter\UserListFilter;
use app\model\UserModel;

class UserService
{

    public function getUserList(UserListSearchDto $searchDto): array
    {
        $args = [
            "name" => "测试bom123",
            "age" => 18,
        ];
        $users = UserModel::modelFilter($args, UserListFilter::class)->paginate(['page' => 1, 'list_rows' => 10]);
        return [
            "code" => 200,
            "msg" => "Ok",
            "data" => $users
        ];
    }
}
```