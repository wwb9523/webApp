<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/17
 * Time: 15:46
 */
import("AdvModel");
class NoticeModel extends AdvModel
{
	protected $_validate = array(
		array('content', 'require', '内容必填', 0, '', Model:: MODEL_BOTH),
	);

}