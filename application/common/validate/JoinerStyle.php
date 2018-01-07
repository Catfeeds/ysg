<?php
namespace app\common\validate;

use think\Validate;

class JoinerStyle extends Validate
{
    protected $rule = [
        "author|来源" => "require",
        "title|标题" => "require",
        "image|显示图片" => "require",
        "content|内容" => "require",
    ];
}
