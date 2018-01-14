<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace app\index;

use think\View;
use think\Request;
use think\Db;
use think\Config;
use think\Loader;
use think\exception\HttpException;

class Controller
{
    /**
     * @var View 视图类实例
     */
    protected $view;
    /**
     * @var Request Request实例
     */
    protected $request;
    /**
     * @var array 黑名单方法，禁止访问某些方法
     */
    protected static $blacklist = [];
    /**
     * @var array 白名单方法，如果设置会覆盖黑名单方法，只允许白名单方法能正常访问
     */
    protected static $allowList = [];

    public function __construct()
    {
        if (null === $this->view) {
            $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));
        }
        if (null === $this->request) {
            $this->request = Request::instance();
        }

        // 白名单/黑名单方法
        if ($this::$allowList && !in_array($this->request->action(), $this::$allowList)) {
            throw new HttpException(404, 'method not exists:' . $this->request->controller() . '->' . $this->request->action());
        } elseif ($this::$blacklist && in_array($this->request->action(), $this::$blacklist)) {
            throw new HttpException(404, 'method not exists:' . $this->request->controller() . '->' . $this->request->action());
        }

        // 前置方法
        $beforeAction = "before" . $this->request->action();
        if (method_exists($this, $beforeAction)) {
            $this->$beforeAction();
        }

        // 获取网站配置，菜单等公共信息
        $config = cache('siteConfig');
        if (! $config) {
            $config = $this->getModel('config')->where(['id' => 1])->find();
            cache('siteConfig', $config, EXPIRE_TIME);
        }

        if (!empty($config) && $config['enabled'] == 'N') {
            exit('站点已关闭 == !');
        }

        $this->view->assign('config', $config);

        // 顶部菜单
        $topMenus = cache('topMenus');

        if (! $topMenus) {

            $menus = $this->getModel('menu')->where(['enabled' => 'Y', 'is_top' => 'Y'])->field(['id', 'name', 'pinyin', 'parent_id'])->select()->toArray();

            $result = [];
            foreach ($menus as $item) {
                if ($item['parent_id'] == 0) {
                    $result[$item['id']] = $item;
                } else {
                    $result[$item['parent_id']]['child'][] = $item;
                }
            }
            $topMenus = array_values($result);
            cache('topMenus', $topMenus, EXPIRE_TIME);
        }

        $this->view->assign('topMenus', $topMenus);

        // 底部导航
        $bottomMenus = cache('bottomMenu');

        if (! $bottomMenus) {
            $bottomMenus = $this->getModel('menu')->where(['enabled' => 'Y', 'is_bottom' => 'Y'])->field(['id', 'name', 'pinyin'])->select()->toArray();
            cache('bottomMenu', $bottomMenus, EXPIRE_TIME);
        }
        $this->view->assign('bottomMenus', $bottomMenus);
    }

    /**
     * 获取模型
     *
     * @param string $controller
     * @param bool   $type 是否返回模型的类型
     *
     * @return \think\db\Query|\think\Model|array
     */
    protected function getModel($controller = '', $type = false)
    {
        $module = Config::get('app.model_path');
        if (!$controller) {
            $controller = $this->request->controller();
        }
        if (
            class_exists($modelClass = Loader::parseClass($module, 'model', $this->parseCamelCase($controller)))
            || class_exists($modelClass = Loader::parseClass($module, 'model', $controller))
        ) {
            $model = new $modelClass();
            $modelType = 'model';
        } else {
            $model = Db::name($this->parseTable($controller));
            $modelType = 'db';
        }

        return $type ? ['type' => $modelType, 'model' => $model] : $model;
    }

    /**
     * 获取实际的控制器名称(应用于多层控制器的场景)
     *
     * @param $controller
     *
     * @return mixed
     */
    protected function getRealController($controller = '')
    {
        if (!$controller) {
            $controller = $this->request->controller();
        }
        $controllers = explode(".", $controller);
        $controller = array_pop($controllers);

        return $controller;
    }

    /**
     * 格式化类名，将 /. 转为 \\
     * 已废弃，请使用Loader::parseClass()
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function parseClass($name = '')
    {
        if (!$name) {
            $name = $this->request->controller();
        }

        return str_replace(['/', '.'], '\\', $name);
    }

    /**
     * 格式化表名，将 /. 转为 _ ，支持多级控制器
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function parseTable($name = '')
    {
        if (!$name) {
            $name = $this->request->controller();
        }

        return str_replace(['/', '.'], '_', $name);
    }

    /**
     * 将abc.def.Gh转为AbcDefGh
     *
     * @param $string
     *
     * @return mixed
     */
    protected function parseCamelCase($string)
    {
        return preg_replace_callback('/(\.|^)([a-zA-Z])/', function ($match) {
            return ucfirst($match[2]);
        }, $string);
    }
}
