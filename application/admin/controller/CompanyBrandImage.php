<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class CompanyBrandImage extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    public function __construct()
    {
        parent::__construct();
        $brand = model('company_brand')->getMenu();
        $brandArr = array_column($brand, 'title', 'id');
        $this->view->assign('brands', $brand);
        $this->view->assign('brandsArr', $brandArr);
    }
}
