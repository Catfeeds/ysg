<?php
namespace app\common\validate;

use think\Validate;

class JoinPlan extends Validate
{
    protected $rule = [
        "title|方案名称" => "require",
        "image|方案图片" => "require",
        "amount|投资金额(元)" => "require",
        "advantage|投资优势" => "require",
        "hot|投资热度(1-5)" => "require",
        "enabled|显示" => "require",
    ];
}
