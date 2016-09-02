<?php 
/**
 * 
 * News(新闻)
 *
 * @package      	shuguangCMS_Corp
 * @author          shuguang QQ:5565907 <web@sgcms.cn>
 * @copyright     	Copyright (c) 2008-2010  (http://www.sgcms.cn)
 * @license         http://www.sgcms.cn/license.txt
 * @version        	$Id: NewsModel.class.php v2.0 2010-01-01 06:59:03 shuguang $

 */
 
import("AdvModel");
class RecruitModel extends AdvModel
{
    protected $_validate = array(
        array('job_title', 'require', '职位名称必填', 0, '', Model:: MODEL_BOTH),
        array('form', 'require', '公司性质必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('create_time', 'strtotime', Model:: MODEL_BOTH, 'function'),
        array('update_time', 'time', Model:: MODEL_UPDATE, 'function'),
    );
}