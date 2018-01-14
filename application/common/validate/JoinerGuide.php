<?php
namespace app\common\validate;

use think\Validate;

class JoinerGuide extends Validate
{
    protected $rule = [
        "title|标题" => "require",
        "author|来源" => "require",
        "image|封面图" => "require",
        "content|内容" => "require"
    ];
}
