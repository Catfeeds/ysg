<?php
namespace app\mobile\controller;

use app\mobile\Controller;
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
        $this->view->assign('showTop', 1);
        if (! empty($info)) {
            $this->view->assign('topic', $info);
            $this->view->assign('title', $info['name']);
            return $this->view->fetch('index/topic');
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
            $this->view->assign('title', $info['name']);
            return view('index/topic');
        } else {
            switch ($name) {
                case 'qiyexinwen':
                    return $this->qiyexinwen();
                    break;

                case 'touzikaidian':
                    $pinyin = input('pinyin', 'touzikaidian');
                    return $this->touzikaidian($pinyin);
                    break;

                case 'chanpinzhanshi':
                    return $this->fenlei();
                    break;

                case 'chenggonganli':
                    return $this->ganyan();
                    break;
            }
        }
    }

    public function message()
    {
        $request = Request::instance();
        $username = $request->post('username');
        $phone = $request->post('telephone');
        $content = $request->post('content');

        if (empty($username) || empty($phone)) {
            echo json_encode(['code' => 400, 'msg' => '用户名或手机号不能为空']); exit;
        } else {
            $this->getModel('feedback')->insert(
                [
                    'username' => $username,
                    'telephone' => $phone,
                    'content' => $content
                ]
            );

            echo json_encode(['code' => 200, 'msg' => '提交成功，请等候官方联系']); exit;
        }
    }

    public function index()
    {
        // 轮播图
        $banners = cache('mobile_indexBanner');
        if (! $banners) {
            $banners = $this->getModel('banner')->where(['enabled' => 'Y'])->select();
            $banners = array_map(function (&$item){
                $item['image'] = $item['image'] ? $item['image'] . '?imageView2/2/h/268/w/640' : '';
                return $item;
            }, $banners);
            cache('mobile_indexBanner', $banners, EXPIRE_TIME);
        }

        // 首页配置
        $index = cache('mobile_indexConfig');
        if (! $index) {
            $index = $this->getModel('index_config')->find();
            cache('mobile_indexConfig', $index, EXPIRE_TIME);
        }

        // 菜单颜色
        $colors = [ 'ff4848', '3da6ff', 'ff4848'];

        // 菜单
        $menus = cache('mobile_indexMenu');
        if (! $menus) {
            $menus = Db::name('mobile_menu')
                ->alias('i')
                ->join('menu menu', 'i.menu_id = menu.id')
                ->field(['menu.id','menu.pinyin', 'menu.name', 'i.alias', 'i.icon'])
                ->where(['menu.enabled' => 'Y', 'i.index_show' => 'Y'])
                ->select();

            cache('mobile_indexMenu', $menus, EXPIRE_TIME);
        }

        // 加盟案例
        $fengcais = cache('mobile_JoinerStyle');
        if (! $fengcais) {
            $fengcais = $this->getModel('JoinerStyle')->where(['enabled' => 'Y'])->order('id desc')->limit(5)->select();
            cache('mobile_JoinerStyle', $fengcais, EXPIRE_TIME);
        }

        $ganyans = cache('mobile_JoinerNews');
        if (! $ganyans) {
            $ganyans = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])->order('id desc')->limit(6)->select();
            cache('mobile_JoinerNews', $ganyans, EXPIRE_TIME);
        }

        // 企业新闻
        $news = cache('mobile_indexNews');
        if (! $news) {
            $news = $this->getModel('news')->where(['enabled' => 'Y'])->order('id desc')->limit(6)->select();
            cache('mobile_indexNews', $news, EXPIRE_TIME);
        }

        // 投资开店
        $invests = cache('mobile_indexInvest');
        if (! $invests) {
            $invests = $this->getModel('InvestNews')->where(['enabled' => 'Y'])
                ->order('id desc')
                ->limit(6)
                ->select();
            cache('mobile_indexInvest', $invests, EXPIRE_TIME);
        }

        // 成功案例
        $joins = cache('mobile_indexJoiner');
        if (! $joins) {
            $joins = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])
                ->order('id desc')
                ->limit(6)
                ->select();
            cache('mobile_indexJoiner', $joins, EXPIRE_TIME);
        }

        // 是否有视频
        $video = $this->getModel('video')->where(['enabled' => 'Y'])->find();

        $this->view->assign('showTop', 0);
        $this->view->assign('banners', $banners);
        $this->view->assign('menus', $menus);
        $this->view->assign('index', $index);
        $this->view->assign('fengcais', $fengcais);
        $this->view->assign('ganyans', $ganyans);
        $this->view->assign('news', $news);
        $this->view->assign('invests', $invests);
        $this->view->assign('joins', $joins);
        $this->view->assign('colors', $colors);
        $this->view->assign('video', $video);

        return view('index');
    }

    // 视频
    public function video()
    {
        $video = $this->getModel('video')->where(['enabled' => 'Y'])->find();
        $this->view->assign('video', $video);

        return view('index/video');
    }

    public function lianxi()
    {
        $about = $this->getModel('about')->find(1);

        $this->view->assign('about', $about);
        return view('index/lianxi');
    }

    // 企业新闻
    public function qiyexinwen()
    {
        $newsList = $this->getModel('news')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(15, false, ['type' => 'bootstrap']);

        $this->view->assign('newsList', $newsList);

        return view('index/detail');
    }

    // 新闻列表
    public function detail($id)
    {
        $news = $this->getModel('news')->where(['enabled' => 'Y'])->find($id);
        $this->view->assign('news', $news);

        $prev = $this->getModel('news')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('news')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('news')->where(['enabled' => 'Y'])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);

        return view('index/detail');
    }

    // 风采
    public function fengcai()
    {
        $list = $this->getModel('JoinerStyle')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(12, false, ['type' => 'bootstrap']);

        $this->view->assign('menuName', '成功案例');
        $this->view->assign('list', $list);
        //print_r($list);exit;
        return view('index/anli');
    }

    public function anliDetail($id)
    {
        $item = $this->getModel('JoinerStyle')->where(['enabled' => 'Y'])->find($id)->toArray();
        $prev = $this->getModel('JoinerStyle')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('JoinerStyle')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('JoinerStyle')->where(['enabled' => 'Y'])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('news', $item);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);
        return view('index/anliDetail');
    }

    // 感言
    public function ganyan()
    {
        $list = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(12, false, ['type' => 'bootstrap']);

        $this->view->assign('list', $list);
        $this->view->assign('menuName', '加盟商感言');
        return view('index/anli');
    }

    public function ganyanDetail($id)
    {
        $item = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])->find($id)->toArray();
        $prev = $this->getModel('JoinerNews')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('JoinerNews')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('JoinerNews')->where(['enabled' => 'Y'])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('news', $item);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);
        return view('index/ganyanDetail');
    }

    // 产品主页
    public function fenlei()
    {
        $categoryId = input('cid');
        $condition = [];
        if ($categoryId) {
            $condition = ['category_id' => $categoryId];
        }

        $newProducts = $this->getModel('Product')->where(array_merge(['enabled' => 'Y', 'is_new' => 'Y'],$condition))->order('id desc')->limit(5)->select();
        $products = $this->getModel('Product')->where(array_merge(['enabled' => 'Y'], $condition))->paginate(15, false, ['type' => 'bootstrap']);
        $categories = $this->getModel('ProductCategory')->where(['enabled' => 'Y'])->select();

        $this->view->assign('categories', $categories);
        $this->view->assign('newProducts', $newProducts);
        $this->view->assign('products', $products);
        $this->view->assign('type', input('type') ? input('type') : 'all');

        return view('index/product');
    }

    // 产品详情
    public function fenleiDetail($id)
    {
        $product = $this->getModel('Product')->where(['enabled' => 'Y'])->find($id)->toArray();
        $prev = $this->getModel('Product')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('Product')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('Product')->where(['enabled' => 'Y'])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }
        $categories = $this->getModel('ProductCategory')->where(['enabled' => 'Y'])->select();

        $this->view->assign('categories', $categories);
        $this->view->assign('product', $product);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);
        return view('index/productDetail');
    }

    // 投资开店
    public function touzikaidian($pinyin = 'touzikaidian')
    {
        $menu = $this->getModel('menu')->where(['pinyin' => $pinyin])->find();
        $touzi = $this->getModel('menu')->where(['pinyin' => 'touzikaidian'])->find();
        $category = $this->getModel('menu')->where(['enabled' => 'Y', 'parent_id' => $touzi['id']])->select();
        $news = $this->getModel('InvestNews')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(10, false, ['type' => 'bootstrap']);

        $this->view->assign('news', $news);
        $this->view->assign('category', $category);
        $this->view->assign('menuName', $menu['name']);
        $this->view->assign('pinyin', $pinyin);

        if ($pinyin == 'kaidianwenda') {
            return view('index/wenda');
        } else {
            return view('index/touzi');
        }
    }

    // 投资问答详情
    public function touziDetail($id)
    {
        $news = $this->getModel('InvestNews')->where(['enabled' => 'Y'])->find($id)->toArray();
        $prev = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();
        $menuName = $this->getModel('menu')->where(['enabled' => 'Y', 'id' => $news['category_id']])->value('name');
        $relations = $this->getModel('InvestNews')->where(['enabled' => 'Y'])->limit(13)->select();

        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('menuName', $menuName);
        $this->view->assign('news', $news);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);

        return view('index/touziDetail');
    }

    // 利润分析
    public function lirunfenxi()
    {
        $menu = $this->getModel('menu')->where(['pinyin' => 'lirunfenxi'])->find();
        $news = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id']])
            ->order('id desc')
            ->paginate(10, false, ['type' => 'bootstrap']);

        $this->view->assign('list', $news);
        return view('index/lirun');
    }

    public function lirunDetail($id)
    {
        $menu = $this->getModel('menu')->where(['pinyin' => 'lirunfenxi'])->find();
        $item = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id']])->find($id)->toArray();
        $prev = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id'], 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id'],'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('InvestNews')->where(['enabled' => 'Y','category_id' => $menu['id']])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('news', $item);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);
        return view('index/lirunDetail');
    }

    // 成本费用
    public function chengbenfeiyong()
    {
        $menu = $this->getModel('menu')->where(['pinyin' => 'chengbenfeiyong'])->find();
        $news = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id']])
            ->order('id desc')
            ->paginate(10, false, ['type' => 'bootstrap']);

        $this->view->assign('list', $news);
        return view('index/chengben');
    }

    public function chengbenDetail($id)
    {
        $menu = $this->getModel('menu')->where(['pinyin' => 'chengbenfeiyong'])->find();
        $item = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id']])->find($id)->toArray();
        $prev = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id'], 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('InvestNews')->where(['enabled' => 'Y', 'category_id' => $menu['id'],'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();

        $relations = $this->getModel('InvestNews')->where(['enabled' => 'Y','category_id' => $menu['id']])->limit(13)->select();
        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('news', $item);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);
        return view('index/chengbenDetail');
    }

    // 投资指南
    public function zhinan()
    {
        $zhinan = $this->getModel('menu')->where(['pinyin' => 'jiamengzhinan'])->find();
        $category = $this->getModel('menu')->where(['enabled' => 'Y', 'parent_id' => $zhinan['id']])->select();

        $list = $this->getModel('JoinerGuide')->where(['enabled' => 'Y'])
            ->order('id desc')
            ->paginate(10, false, ['type' => 'bootstrap']);

        $this->view->assign('list', $list);
        $this->view->assign('category', $category);

        return view('index/zhinan');
    }

    // 投资指南
    public function zhinanDetail($id)
    {
        $news = $this->getModel('JoinerGuide')->where(['enabled' => 'Y'])->find($id)->toArray();
        $prev = $this->getModel('JoinerGuide')->where(['enabled' => 'Y', 'id' => ['LT', $id]])->limit(1)->field(['id', 'title'])->find();
        $next = $this->getModel('JoinerGuide')->where(['enabled' => 'Y', 'id' => ['GT', $id]])->limit(1)->field(['id', 'title'])->find();
        $relations = $this->getModel('JoinerGuide ')->where(['enabled' => 'Y'])->limit(13)->select();

        foreach ($relations as $key => $relation) {
            if ($relation['id'] == $id
                || (!empty($prev) && $relation['id'] == $prev['id'])
                || (!empty($next) && $relation['id'] == $next['id'])
            ) {
                unset($relations[$key]);
            }
        }

        $this->view->assign('news', $news);
        $this->view->assign('next', $next);
        $this->view->assign('prev', $prev);
        $this->view->assign('relations', $relations);

        return view('index/zhinanDetail');
    }
}
