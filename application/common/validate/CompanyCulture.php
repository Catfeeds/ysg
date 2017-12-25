<?php
namespace app\common\validate;

use think\Validate;

class CompanyCulture extends Validate
{
    protected $rule = [
        "image|图片地址" => "require",
    ];
}
