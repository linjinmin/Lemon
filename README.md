# Lemon


### 根据身份证的前4位数字，获取该身份证的省会及城市。


###使用方法

>首先   composer require ddllin/lemon


#### 示例, 应身份证前四位代表省会城市，所以必须传递，当然传递身份证全部编码也是可以的
```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Lemon\Query\Query;

var_dump(Query::query('xxxxx'));

```

#### 返回格式, 为json字符串
```
 "{"province":"\u798f\u5efa\u7701","city":"\u798f\u5dde\u5e02"}"
```










