<?php
namespace app\index\controller;

use app\index\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        // 轮播图
        $banners = $this->getModel('banner')->where(['enabled' => 'Y'])->select();

        // 首页配置
        $index = $this->getModel('index_config')->find();

        // 菜单
       //$menus = $this->getModel('indexMenu')->where(['enabled' => 'Y'])->select();
        $menus = Db::name('index_menu')
            ->alias('i')
            ->join('menu menu', 'i.menu_id = menu.id')
            ->field(['menu.id','menu.pinyin', 'menu.name', 'i.image', 'i.icon'])
            ->where(['i.enabled' => 'Y'])
            ->select();

        // 公司实力
        $strength = $this->getModel('CompanyStrength')->where(['enabled' => 'Y'])->select();
        $strengthImages = $this->getModel('CompanyStrengthImage')->where(['enabled' => 'Y'])->select();
        $result = [];
        foreach ($strengthImages as $item) {
            if (isset($result[$item['relate_id']])) {
                $result[$item['relate_id']][] = $item['image'];
            } else {
                $result[$item['relate_id']][] = $item['image'];
            }
        }

        // 公司文化
        $culture = $this->getModel('CompanyCulture')->where(['enabled' => 'Y'])->select();

        // 加盟服务
        $service = $this->getModel('CompanyService')->where(['enabled' => 'Y'])->select();

        // 品牌实力
        $brands = $this->getModel('CompanyBrand')->where(['enabled' => 'Y'])->select();
        $brandImages = $this->getModel('CompanyBrandImage')->where(['enabled' => 'Y'])->select();
        $brandResult = [];
        foreach ($brandImages as $item) {
            if (isset($brandResult[$item['relate_id']])) {
                $brandResult[$item['relate_id']][] = $item['image'];
            } else {
                $brandResult[$item['relate_id']][] = $item['image'];
            }
        }

        $this->view->assign('banners', $banners);
        $this->view->assign('menus', $menus);
        $this->view->assign('index', $index);
        $this->view->assign('culture', $culture);
        $this->view->assign('service', $service);
        $this->view->assign('strength', $strength);
        $this->view->assign('strengthImages', $result);
        $this->view->assign('brands', $brands);
        $this->view->assign('brandImages', $brandResult);

        return view('index');
        //return \think\Response::create(\think\Url::build('/admin'), 'redirect');
    }
}
