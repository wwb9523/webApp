<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/17
 * Time: 15:46
 */
import("AdvModel");
class CertificateModel extends AdvModel
{
	protected $_validate = array(
		array('certificate_type', 'require', '内容必填', 0, '', Model:: MODEL_BOTH),
	);

}