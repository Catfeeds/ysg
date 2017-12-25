<?php
namespace app\common\validate;

use think\Validate;

class IndexMenu extends Validate
{
    protected $rule = [
        "menu_id|菜单名称" => "require",
        "image|显示图片" => "require",
        "icon|icon图标" => "require",
    ];
}
