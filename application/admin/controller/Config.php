<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Config extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    protected function afterAdd()
    {
        // todo
    }

    public function afterEdit()
    {
        cache('siteConfig', null);
        cache('mobile_siteConfig', null);
    }

}
