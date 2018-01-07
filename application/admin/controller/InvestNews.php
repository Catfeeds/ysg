<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class InvestNews extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    public function __construct()
    {
        parent::__construct();
        $menus = model('menu')->getInvestMenu();

        $menuArr = array_column($menus, 'name', 'id');
        $this->view->assign('menus', $menus);
        $this->view->assign('menuArr', $menuArr);
    }

    protected function filter(&$map)
    {
        if ($this->request->param("title")) {
            $map['title'] = ["like", "%" . $this->request->param("title") . "%"];
        }
    }
}
