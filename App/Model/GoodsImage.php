<?php
/**
 * 商品图片数据模型
 *
 *
 *
 *
 * @copyright  Copyright (c) 2016-2017 MoJiKeJi Inc. (http://www.fashop.cn)
 * @license    http://www.fashop.cn
 * @link       http://www.fashop.cn
 * @since      File available since Release v1.1
 */

namespace App\Model;

use ezswoole\Model;
use traits\model\SoftDelete;

class GoodsImage extends Model
{
    use SoftDelete;
    protected $deleteTime    = 'delete_time';
    protected $resultSetType = 'collection';

	/**
	 * 添加
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param  array $data
	 * @return int pk
	 */
	public function addGoodsImage( $data = [] )
	{
		$result = $this->allowField( true )->save( $data );
		if( $result ){
			return $this->getLastInsID();
		}
		return $result;
	}

	/**
	 * 添加多条
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param array $data
	 * @return boolean
	 */
	public function addGoodsImageAll( $data )
	{
		return $this->insertAll( $data );
	}

	/**
	 * 修改
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param    array $condition
	 * @param    array $data
	 * @return   boolean
	 */
	public function editGoodsImage( $condition = [], $data = [] )
	{
		// return $this->foreach ($condition as $key => $value) {
		// 	$this->db->where($key, $value);
		// }
		// return $this->db->update($this->table, $data);
	}

	/**
	 * 删除
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param    array $condition
	 * @return   boolean
	 */
	public function delGoodsImage( $condition = [] )
	{
		return $this->where( $condition )->delete();
	}

	/**
	 * 计算数量
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param array $condition 条件
	 * @return int
	 */
	public function getGoodsImageCount( $condition )
	{
		return $this->where( $condition )->count();
	}

	/**
	 * 获取商品图片单条数据
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param array  $condition 条件
	 * @param string $field     字段
	 * @return array
	 */
	public function getGoodsImageInfo( $condition = [], $field = '*' )
	{
		$info = $this->where( $condition )->field( $field )->find();
		return $info ? $info->toArray() : false;
	}

	/**
	 * 获得商品图片列表
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param    array  $condition
	 * @param    string $field
	 * @param    string $order
	 * @param    string $page
	 * @return   array
	 */
	public function getGoodsImageList( $condition = [], $field = '*', $order = '', $page = '1,10' )
	{
		$list = $this->where( $condition )->order( $order )->field( $field )->page( $page )->select();
		return $list ? $list->toArray() : false;
	}

    /**
     * 列表更多
     * @param  [type] $condition        [条件]
     * @param  [type] $condition_str    [条件]
     * @param  [type] $field            [字段]
     * @param  [type] $order            [排序]
     * @param  [type] $page             [分页]
     * @param  [type] $group            [分组]
     * @return [type]                   [数据]
     */
    public function getGoodsImageMoreList($condition = array(), $condition_str = '', $field = '*', $order = 'id desc', $page = '1,20', $group='') {
        if($page == ''){
            $data = $this->alias('goods_image')->join('__GOODS__ goods','goods_image.goods_id = goods.id','LEFT')->where($condition)->where($condition_str)->order($order)->field($field)->group($group)->select();

        }else{
            $data = $this->alias('goods_image')->join('__GOODS__ goods','goods_image.goods_id = goods.id','LEFT')->where($condition)->where($condition_str)->order($order)->field($field)->page($page)->group($group)->select();

        }
        return $data ? $data->toArray() : array();
    }

    /**
     * 获得数量
     * @param  [type] $condition        [条件]
     * @param  [type] $condition_str    [条件]
     * @param  [type] $distinct         [去重]
     * @return [type]                   [数据]
     */
    public function getGoodsImageMoreCount($condition = array(), $condition_str = '', $distinct = '') {
        if($distinct == ''){
            return $this->alias('goods_image')->join('__GOODS__ goods','goods_image.goods_id = goods.id','LEFT')->where($condition)->where($condition_str)->count();

        }else{
            return $this->alias('goods_image')->join('__GOODS__ goods','goods_image.goods_id = goods.id','LEFT')->where($condition)->where($condition_str)->count("DISTINCT ".$distinct);
        }
    }
	/**
	 * 软删除
	 * @datetime 2017-04-19 10:46:57
	 * @author   韩文博
	 * @param    array $condition
	 * @return   boolean
	 */
	public function softDelGoodsImage( $condition = [] )
	{
        return $this->save(['delete_time'=>time()],$condition);
	}

}

?>