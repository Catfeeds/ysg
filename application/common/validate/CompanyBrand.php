<?php
namespace app\common\validate;

use think\Validate;

class CompanyBrand extends Validate
{
    protected $rule = [
        "title|品牌名称" => "require",
    ];
}
