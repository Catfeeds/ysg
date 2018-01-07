<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class MenuTopic extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    public function __construct()
    {
        parent::__construct();
        //$menus = model('menu')->getMenu();

        $menus = $this->getModel('menu')
            ->where(['enabled' => 'Y'])
            ->field(['id', 'name', 'pinyin', 'parent_id'])
            ->order('parent_id asc')
            ->select()
            ->toArray();

        $result = [];
        // 分组
        foreach ($menus as $item) {
            if ($item['parent_id'] == 0) {
                $result[$item['id']][] = $item;
            } else {
                $result[$item['parent_id']][] = $item;
            }
        }
        $menus = [];
        // 排序
        foreach ($result as $item) {
            foreach ($item as $it) {
                $menus[] = $it;
            }
        }

        $menusArr = array_column($menus, 'name', 'id');
        $this->view->assign('menus', $menus);
        $this->view->assign('menusArr', $menusArr);

        $this->view->assign('indexUrl', url('menuTopic/index'));
    }

    protected function filter(&$map)
    {
        if ($this->request->param("")) {
            $map[''] = ["like", "%" . $this->request->param("") . "%"];
        }
    }
}
