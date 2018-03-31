<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class CompanyStrengthImage extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    public function __construct()
    {
        parent::__construct();
        $menus = model('company_strength')->getMenu();
        $menusArr = array_column($menus, 'title', 'id');
        $this->view->assign('category', $menus);
        $this->view->assign('categoryArr', $menusArr);
    }

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
        cache('companyStrengthImages', null);
    }
}
