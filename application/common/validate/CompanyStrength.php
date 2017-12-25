<?php
namespace app\common\validate;

use think\Validate;

class CompanyStrength extends Validate
{
    protected $rule = [
        "title|标题" => "require",
    ];
}
