<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class CompanyBrand extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function afterAdd()
    {
        $this->clearCache();
    }

    public function afterEdit()
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        cache('companyBrand', null);
    }
}
