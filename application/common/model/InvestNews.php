<?php
namespace app\common\model;

use think\Model;

class InvestNews extends Model
{
    // 指定表名,不含前缀
    protected $name = 'invest_news';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
}
