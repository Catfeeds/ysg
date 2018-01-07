<?php
namespace app\index\controller;

use app\index\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $request = Request::instance();
        $action = $request->action();

        $info = Db::name('menu menu')
            ->join('menu_topic topic', 'menu.id=topic.menu_id')
            ->field(['menu.name', 'menu.pinyin', 'topic.content'])
            ->where(['menu.pinyin' => $action, 'topic.enabled' => 'Y'])
            ->find();

        if (! empty($info)) {
            $this->view->assign('topic', $info);
            return $this->view->fetch('template/topic');
        }
    }

    public function _empty($name)
    {
        $info = Db::name('menu menu')
            ->join('menu_topic topic', 'menu.id=topic.menu_id')
            ->field(['menu.name', 'menu.pinyin', 'topic.content'])
            ->where(['menu.pinyin' => $name, 'topic.enabled' => 'Y'])
            ->find();

        if (!empty($info)) {
            $this->view->assign('topic', $info);
            return view('template/topic');
        } else {
            switch ($name) {
                case 'qiyexinwen':
                    $this->qiyexinwen();
                    break;
            }
        }
    }


    public function index()
    {
        // 轮播图
        $banners = cache('indexBanner');
        if (! $banners) {
            $banners = $this->getModel('banner')->where(['enabled' => 'Y'])->select();
            cache('indexBanner', $banners, EXPIRE_TIME);
        }

        // 首页配置
        $index = cache('indexConfig');
        if (! $index) {
            $index = $this->getModel('index_config')->find();
            cache('indexConfig', $index, EXPIRE_TIME);
        }

        // 菜单
        $menus = cache('indexMenu');
        if (! $menus) {
            $menus = Db::name('index_menu')
                ->alias('i')
                ->join('menu menu', 'i.menu_id = menu.id')
                ->field(['menu.id','menu.pinyin', 'menu.name', 'i.image', 'i.icon'])
                ->where(['i.enabled' => 'Y'])
                ->select();
            cache('indexMenu', $menus, EXPIRE_TIME);
        }

        // 公司实力
        $strength = cache('companyStrength');
        if (! $strength) {
            $strength = $this->getModel('CompanyStrength')->where(['enabled' => 'Y'])->select();
            cache('companyStrength', $strength, EXPIRE_TIME);
        }

        $result = cache('companyStrengthImages');
        if (! $result) {
            $strengthImages = $this->getModel('CompanyStrengthImage')->where(['enabled' => 'Y'])->select();
            $result = [];
            foreach ($strengthImages as $item) {
                if (isset($result[$item['relate_id']])) {
                    $result[$item['relate_id']][] = $item['image'];
                } else {
                    $result[$item['relate_id']][] = $item['image'];
                }
            }
            cache('companyStrengthImages', $result, EXPIRE_TIME);
        }

        // 公司文化
        $culture = cache('companyCulture');
        if (! $culture) {
            $culture = $this->getModel('CompanyCulture')->where(['enabled' => 'Y'])->select();
            cache('companyCulture', $culture, EXPIRE_TIME);
        }

        // 加盟服务
        $service = cache('companyService');
        if (! $service) {
            $service = $this->getModel('CompanyService')->where(['enabled' => 'Y'])->select();
            cache('companyService', $service, EXPIRE_TIME);
        }

        // 品牌实力
        $brands = cache('companyBrand');
        if (! $brands) {
            $brands = $this->getModel('CompanyBrand')->where(['enabled' => 'Y'])->select();
            cache('companyBrand', $brands, EXPIRE_TIME);
        }

        $brandResult = cache('companyBrandImage');
        if (! $brandResult) {
            $brandImages = $this->getModel('CompanyBrandImage')->where(['enabled' => 'Y'])->select();
            $brandResult = [];
            foreach ($brandImages as $item) {
                if (isset($brandResult[$item['relate_id']])) {
                    $brandResult[$item['relate_id']][] = $item['image'];
                } else {
                    $brandResult[$item['relate_id']][] = $item['image'];
                }
            }
            cache('companyBrandImage', $brandResult, EXPIRE_TIME);
        }

        // 加盟案例
        $fengcais = cache('JoinerStyle');
        if (! $fengcais) {
            $fengcais = $this->getModel('JoinerStyle')->where(['enabled' => 'Y'])->order('id desc')->limit(5)->select();
            cache('JoinerStyle', $fengcais, EXPIRE_TIME);
        }

        $ganyans = cache('JoinerNews');
        if (! $ganyans) {
            $ganyans = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])->order('id desc')->limit(5)->select();
            cache('JoinerNews', $ganyans, EXPIRE_TIME);
        }

        // 视频展示
        $videos = cache('indexVideo');
        if (! $videos) {
            $videos = $this->getModel('video')->where(['enabled' => 'Y'])->select();
            cache('indexVideo', $videos, EXPIRE_TIME);
        }

        // 企业新闻
        $news = cache('indexNews');
        if (! $news) {
            $news = $this->getModel('news')->where(['enabled' => 'Y'])->order('id desc')->limit(6)->select();
            cache('indexNews', $news, EXPIRE_TIME);
        }

        // 加盟方案
        $plans = cache('JoinPlan');
        if (! $plans) {
            $plans = $this->getModel('JoinPlan')->where(['enabled' => 'Y'])->order('id ASC')->limit(2)->select();
            cache('JoinPlan', $plans, EXPIRE_TIME);
        }

        // 投资管理菜单
        $investId = $this->getModel('menu')->where(['enabled' => 'Y', 'pinyin' => 'touzikaidian'])->value('id');
        $investMenu = cache('investMenu');
        if (! $investMenu) {
            $investMenu = $this->getModel('menu')->where(['enabled' => 'Y', 'parent_id' => $investId])->field(['id', 'pinyin', 'name'])->select()->toArray();
            cache('investMenu', $investMenu, EXPIRE_TIME);
        }

        $invests = cache('invests');
        if (! $invests) {
            $invests = [];
            foreach ($investMenu as $item) {
                $res = cache($item['pinyin']);
                if (! $res) {
                    $invests[$item['pinyin']] = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $item['id']])->order('id DESC')->limit(6)->select();
                    cache($item['pinyin'], $invests[$item['pinyin']], EXPIRE_TIME);
                } else {
                    $invests[$item['pinyin']] = $res;
                }
            }
            cache('invests', $invests, EXPIRE_TIME);
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
        $this->view->assign('join', $fengcais || $ganyans ? 1 : 0);
        $this->view->assign('fengcais', $fengcais);
        $this->view->assign('ganyans', $ganyans);
        $this->view->assign('videos', $videos);
        $this->view->assign('news', $news);
        $this->view->assign('plans', $plans);
        $this->view->assign('invests', $invests);
        $this->view->assign('investMenu', $investMenu);

        return view('index');
        //return \think\Response::create(\think\Url::build('/admin'), 'redirect');
    }

    // 企业新闻
    public function qiyexinwen()
    {
        $newsList = $this->getModel('news')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(5, false, ['type' => 'bootstrap']);

        $this->view->assign('newsList', $newsList);

        return view('index/news');
    }

    public function detail($id)
    {
        $news = $this->getModel('news')->where(['enabled' => 'Y'])->find($id);
        $this->view->assign('news', $news);

        $prev = $this->getModel('news')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->value('title');
        $next = $this->getModel('news')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->value('title');

        $relations = $this->getModel('news')->where(['enabled' => 'Y'])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id || $relation['title'] == $next || $relation['title'] == $prev) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);

        return view('index/detail');
    }
}
