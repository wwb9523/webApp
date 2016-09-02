<?php 
/**
 * 
 * AdminLog(系统日志)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class AdminLogAction extends BaseAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        parent::_checkPermission('AdminLog');
        $this->dao = D('AdminLog');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        $condition = array();
        $username = formatQuery($_GET['username']);
        $userId = intval($_GET['userId']);
        $orderBy = trim($_GET['orderBy']);
        $ip = trim($_GET['ip']);
        $orderType = trim($_GET['orderType']);
        $setOrder = setOrder(array(array('userId', 'user_id'), 'id'), $orderBy, $orderType);
        $pageSize = intval($_GET['pageSize']);
        $username &&  $condition['username'] = $username;
        $ip &&  $condition['ip'] = $ip;
        $userId &&  $condition['user_id'] = array('eq', $userId);
        $count = $this->dao->where($condition)->count();
        $listRows = empty($pageSize) ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Where($condition)->Order($setOrder)->Limit($p->firstRow.','.$p->listRows)->findAll();
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
     * 操作指令
     *
     */
    public function doCommand()
    {
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        switch ($operate){
            case 'delete': parent::_delete();break;
            case 'update': parent::_batchModify($_POST,array('id', 'action'));break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
