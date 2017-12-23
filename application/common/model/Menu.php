<?php
namespace app\common\model;

use think\Model;

class Menu extends Model
{
    // 指定表名,不含前缀
    protected $name = 'menu';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected $resultSetType = 'collection';

    /**
     * 获取父级菜单
     */
    public function getParentMenu()
    {
        $result = $this->where(['parent_id' => 0, 'enabled' => 'Y'])
            ->order('id ASC')
            ->field(['id', 'name'])
            ->select()
            ->toArray();

        return $result;
    }

    /**
     * @return array
     */
    public function getMenu()
    {
        $result = $this->where([ 'enabled' => 'Y'])
            ->order('id ASC')
            ->field(['id', 'name'])
            ->select()
            ->toArray();

        return $result;
    }
}
