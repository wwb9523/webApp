<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/17
 * Time: 15:46
 */
import("AdvModel");
class RecordModel extends AdvModel
{
	protected $_validate = array(
		array('stu_number', 'require', '学号必填', 0, '', Model:: MODEL_BOTH),
		array('name', 'require', '姓名必填', 0, '', Model:: MODEL_BOTH),
		array('graduate_date', 'require', '毕业年限必填', 0, '', Model:: MODEL_BOTH),
		array('certificate_type', 'require', '证件类型必填', 0, '', Model:: MODEL_BOTH),
		array('certificate_number', 'require', '证件号码必填', 0, '', Model:: MODEL_BOTH),

	);

}