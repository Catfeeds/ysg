<?php
namespace app\common\validate;

use think\Validate;

class CompanyStrengthImage extends Validate
{
    protected $rule = [
        "relate_id|公司实力名称" => "require",
        "image|图片地址" => "require",
    ];
}
