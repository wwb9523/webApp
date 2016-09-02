<?php
/**
 * 
 * 首页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied");
class IndexAction extends HomeAction 
{
	public $dao,$conf;
	function _initialize()
    {
        parent::_initialize();
    }
	
	public function index()
	{
		$domain=M('Domain')->select();
		$this->assign('domain',$domain);
        $this->display();
	}
}