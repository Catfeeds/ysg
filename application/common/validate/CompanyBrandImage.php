<?php
namespace app\common\validate;

use think\Validate;

class CompanyBrandImage extends Validate
{
    protected $rule = [
        "relate_id|品牌名称" => "require",
        "image|图片" => "require",
    ];
}
