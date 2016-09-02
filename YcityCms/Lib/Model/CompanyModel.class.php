<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/17
 * Time: 15:46
 */
import("AdvModel");
class CompanyModel extends AdvModel
{
	protected $_validate = array(
		array('name', 'require', '公司名称必填', 0, '', Model:: MODEL_BOTH),
		array('nature', 'require', '公司性质必填', 0, '', Model:: MODEL_BOTH),
		array('scale', 'require', '公司规模必填', 0, '', Model:: MODEL_BOTH),
		array('description', 'require', '公司简介必填', 0, '', Model:: MODEL_BOTH),
	);

}