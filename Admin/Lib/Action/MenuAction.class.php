<?php 
/**
 * 
 * Menu(导航)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class MenuAction extends BaseAction
{
    public $dao;
	function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Menu');
	}

	/**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission();
		$count = $this->dao->count($data);
		$listRows = 15;
		$p = new page($count,$listRows);
		$dataList = $this->dao->Where($data)->Order('id DESC')->Limit($p->firstRow.','.$p->listRows)->findAll();
		$page  = $p->show();
		if($dataList !== false)
		{
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}

	/**
     * 提交
     *
     */
	public function insert()
	{
		parent::_checkPermission('Menu_insert');
		$navList = $this->dao->Where('parent_id=0')->findAll();
		$this -> assign('navList', $navList);
		$this->display();
	}

	/**
     * 提交录入
     *
     */
	public function doInsert()
	{
		parent::_checkPermission('Menu_insert');
		parent::_setMethod('post');
		if($daoCreate = $this->dao->create())
		{
			$style = createStyle($_POST);
			$this->dao->title_style = $style['title_style'];
			$this->dao->title_style_serialize = $style['title_style_serialize'];
			$daoAdd = $this->dao->add();
			if(false !== $daoAdd)
			{
			    writeCache('Menu');
				parent::_sysLog('insert', "录入:$daoAdd");
				parent::_message('success', '录入成功');
			}else
			{
				parent::_message('error', '录入成功');
			}
		}else
		{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
     * 编辑
     *
     */
	public function modify()
	{
		parent::_checkPermission('Menu_modify');
		$item = intval($_GET["id"]);
		$record = $this->dao->where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$navList = D('Menu')->where('parent_id=0')->findAll();
		$this->assign('navList', $navList);
		$this->assign('vo', $record);
		$this->display();
	}

	/**
     * 录入编辑
     *
     */
	public function doModify()
	{
		parent::_checkPermission('Menu_modify');
		parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		if($daoCreate = $this->dao->create())
		{
			$style = createStyle($_POST);
			$this->dao->title_style = $style['title_style'];
			$this->dao->title_style_serialize = $style['title_style_serialize'];
			$daoSave = $this->dao->save();
			if(false !== $daoSave)
			{
			    writeCache('Menu');
				parent::_sysLog('modify', "编辑:$item");
				parent::_message('success', '更新成功');
			}else
			{
				parent::_message('error', '更新失败');
			}
		}else
		{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
     * 批量操作
     *
     */
	public function doCommand()
	{
		parent::_checkPermission('Menu_command');
		if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
		switch ($operate){
			case 'delete': parent::_delete();break;
			case 'setStatus': parent::_setStatus('set');break;
			case 'unSetStatus': parent::_setStatus('unset');break;
			case 'update': parent::_batchModify(0, $_POST, array('title', 'link_url', 'display_order', 'target'), __URL__, 'Menu', 'display_order DESC,id DESC');break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
}
