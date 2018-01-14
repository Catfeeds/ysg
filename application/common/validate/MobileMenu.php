<?php
namespace app\common\validate;

use think\Validate;

class MobileMenu extends Validate
{
    protected $rule = [
        "menu_id|菜单名称" => "require",
        "index_show|显示在首页" => "require",
        "position|排序" => "require",
    ];
}
