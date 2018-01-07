<?php
namespace app\common\validate;

use think\Validate;

class JoinerNews extends Validate
{
    protected $rule = [
        "author|来源" => "require",
        "title|标题" => "require",
        "image|展示图片" => "require",
        "content|内容" => "require",
        "enabled|是否显示" => "require",
    ];
}
