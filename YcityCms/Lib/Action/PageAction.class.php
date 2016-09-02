<?php
/**
 * 
 * 单页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class PageAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('Page');
    }

    /**
     * 详细信息
     *
     */
    public function detail()
    {
        $data=M('Category')->where("module='Page'")->field('title')->find();
        $name=$data['title'];
        $contentDetail=$this->dao->limit('1')->find();
        $this->assign('name',$name);
        $this->assign('contentDetail', $contentDetail);
        $this->display();
    }
}