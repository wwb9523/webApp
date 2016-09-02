<?php
/**
 * 
 * Global(全局)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(defined('APP_PATH')!='./YcityCms' && !defined("YCITYCMS"))  exit("Access Denied");
class HomeAction extends Action
{
    private $roleId,$adminId,$username,$adminAccess,$roleName,$realName;
    public $globalCategory, $globalMenu, $sysConfig;
    /**
     * 初始化
     *
     */
    protected function _initialize()
    {
        //取配置
        if(fileExit('./cms.config.php')){
            $this->sysConfig = @require_once('./cms.config.php');
        }else{
            $this->sysConfig = M('Config')->where('id=1')->find();
        }

        //检测是否停止
        $this->assign('sysConfig', $this->sysConfig);
        if($this->sysConfig['web_status'] == 1){
            $this->display('Public:stop');
            exit();
        }
        //取分类
        $this->globalCategory = getCache('Category');

        //导入函数
        Load('extend');
        //导入分页类
        import("ORG.Util.Page");
        $this->assign('moduleName', MODULE_NAME);
        if(!$this->isLogin()){
            $this->assign('isLogin',0);
        }
        else{
            $this->assign('isLogin',1);
            $this->assign('userName',$this->username);
            $this->assign('realName',$this->realName);
        }
    }

    public function isLogin(){
        $this->roleId = intval(Session::get('roleId'));
        $this->adminId = intval(Session::get('adminId'));
        $this->username = Session::get('username');
        $this->realName = Session::get('realName');
        if(empty($this->roleId)||empty($this->realName)){
            return false;
        }
        else{
            return true;
        }
    }
    Protected function _getAdminUid()
    {
        return $this->adminId;
    }

    Protected function _getRoleId()
    {
        return $this->roleId;
    }

    Protected function _getRoleName()
    {
        return $this->roleName;
    }

    Protected function _getAdminName()
    {
        return $this->username;
    }

    Protected function _getRealName()
    {
        return $this->realName;
    }
    public function _empty()
    {
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Public:notFound");
    }

   
    /*
    *查询
    */
    public function search($conditions='',$table)
    {
        $condition=!empty($conditions)?$conditions:'';
        $resultList=$this->dao->where($condition)->Table($table)->select();
        $this->assign('searchResultList',$resultList);
        $this->display();
    }

    /**
    *获取类型列表
    */
    public function getCategory($conditions='')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $selectitems=$this->dao->where($condition)->select();
        $this->assign('selectitems',$selectitems);
        $this->display();  
    }
    /**
    *获取简单列表
    */
    public function getSimpleList($conditions='')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $dataContentList=$this->dao->where($condition)->select();
        $this->assign('dataContentList',$dataContentList);
    }
    /**
     * 数据列表
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getList($conditions = '', $orders = '' , $listRows = '')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->where($condition)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据列表,表关联
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJoinList($conditions = '', $orders = '' , $listRows = '', $table = '', $join = '', $fields = '')
    {
        $this->dao=D('News');
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->Where($condition)->Table($table)->Join($join)->Field($fields)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Table($table)->join($join)->field($fields)->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据列表,表关联
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJustList($conditions = '', $orders = '' ,$listRows = '', $table = '', $join = '', $fields = '')
    {
        $this->dao=D('News');
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->Where($condition)->Table($table)->Join($join)->Field($fields)->count();

        $nowPage  = !empty($_GET[C('VAR_PAGE')])?intval($_GET[C('VAR_PAGE')]):1;
        $firstRow=$listRows*($nowPage-1);
        $listRows = empty($listRows) ? 15 : $listRows;
      //  if($pageCount<=(intval($_GET['p'])-1)*$listRows){return 'No Data';}
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Table($table)->join($join)->field($fields)->Where($condition)->Order($orderd)->Limit($firstRow.','.$listRows)->select();
        return $dataContentList;
    }

    /**
     * 数据集
     *
     * @param $conditions 条件
	 *
     */
    public function getDetail($conditions = '', $viewCount = false)
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
		//更新查看次数
		$viewCount && $this->dao->setInc($viewCount, $conditions);
        $this->assign('contentDetail', $contentDetail);
        $this->display( );
    }

    /**
    *数据集
    */
    public function getSimpleDetail($conditions = '', $viewCount = false)
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
        //更新查看次数
        $viewCount && $this->dao->setInc($viewCount, $conditions);
        $this->assign('contentDetail', $contentDetail);
    }

    /**
     * getLinked 获取链表
     * @param * @param $model 模型名
     * @param * $parent  column name for parent
     * @param * $child  column name for child
     * @param * $parentId  需要查询的子节点的父id
     * @param * array $arr 用于递归传参
     * @return array
     */
    public function getLinked($model,$parent,$child,$parentId,$arr=array())
    {
        $condition[$parent]=$parentId;
        $data=M($model)->where($condition)->select();
        if($data){
            $arr=array_merge($this->getLinked($model,$parent,$child,$data[0][$child],$arr),$data);
        }
        //   $arr=array_reverse($arr);
        return  $arr;
    }
    /**
     * 数据集,表关联
     * 此处查询条件可能为数组
     * @param $conditions 条件
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJoinDetail($conditions = '', $viewCount = false, $table = '', $join = '', $fields = '')
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
		
		$condition1 = is_array($conditions) ? $conditions[0] : $conditions;
		$condition2 = is_array($conditions) ? $conditions[1] : $conditions;

        $contentDetail = $this->dao->Table($table)->Join($join)->Field($fields)->Where($condition1)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
		//更新查看次数
		$viewCount && $this->dao->setInc($viewCount, $condition2);
        $this->assign('contentDetail', $contentDetail);
        $link = $this->getLinked('Category', 'parent_id', 'id', $contentDetail['categoryId']);
        $this->assign('top_link', $link);
        $this->display();
    }

        /**
     * 数据集,表关联
     * 此处查询条件可能为数组
     * @param $conditions 条件
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJustDetail($conditions = '', $viewCount = false, $table = '', $join = '', $fields = '')
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
        
        $condition1 = is_array($conditions) ? $conditions[0] : $conditions;
        $condition2 = is_array($conditions) ? $conditions[1] : $conditions;

        $contentDetail = $this->dao->Table($table)->Join($join)->Field($fields)->Where($condition1)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
        //更新查看次数
        $viewCount && $this->dao->setInc($viewCount, $condition2);
       // $this->assign('contentDetail', $contentDetail);
        return $contentDetail;
    }

    /**
     * 验证码
     *
     */
    function verify()
    {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }



    protected function _sysLog($action = '',$message = '',$adminId=0,$username='')
    {
        $formatMessage = empty($message) ?'': " ({$message})";
        $getConfig = getContent('cms.config.php','.');
        $sysLog = $getConfig['sys_log'];
        $sysLogExt = $getConfig['sys_log_ext'];
        if(!empty($action) &&!empty($sysLog) &&in_array($action,explode(',',$sysLogExt)))
        {
            $getUri =  empty($uri) ?formatQuery($_SERVER['REQUEST_URI']) : $uri ;
            $dao = D('AdminLog');
            $dao->user_id = intval($adminId);
            $dao->username = $username;
            $dao->action =$getUri.$formatMessage;
            $dao->ip = get_client_ip();
            $dao->create_time = time();
            $daoAdd = $dao->add();
            $lastSql = $dao->getLastSql();
            if(false === $daoAdd)
            {
                self::_message('error',"日志写入失败:<br />{$lastSql}",0,30);
            }
        }
    }

    protected function _setMethod($set = 'POST')
    {
        $getMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if($getMethod != $set){
            self::_message('error',"当前只接受 {$set} 数据");
        }
    }

    /**
     * 输出信息
     *
     * @param $type
     * @param $content
     * @param $jumpUrl
     * @param $time
     * @param $ajax
     */
    protected function _message($type = 'success', $content = '更新成功', $jumpUrl = __URL__, $time = 3, $ajax = false)
    {
        $jumpUrl = empty($jumpUrl) ? __URL__ : $jumpUrl ;
        switch ($type){
            case 'success':
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->success($content, $ajax);
                break;
            case 'error':
                $this->assign('jumpUrl', 'javascript:history.back(-1);');
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                break;
            case 'errorUri':
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                break;
            default:
                die('error type');
                break;
        }
    }

    /**
     * forShowHtml   将字符串或数组中某些项转义为HTML安全输出的字符串
     * @param * * @param $field    字符串或数组键名
     * @param array $array
     * @return * array
     */
    protected function forShowHtml($field,$array=array()){
        require_once THINK_PATH.'/Lib/ORG/Util/Input.class.php';
        $Input = Input::getInstance();
        if(!empty($array)) {                                        //2个参数时
            if (is_array($field)) {
                foreach ($field as $item) $array[$item] = $Input->forShow($array[$item]);
            } else $array[$field] = $Input->forShow($array[$field]);
            return $array;
        }
        else{                                                       //1个参数时
            $field=$Input->forShow($field);
            return $field;
        }
    }

    public function getLinkedUp($model,$parent,$child,$parentId,$field='',$arr=array())
    {
        $condition[$child]=$parentId;
        $field=$field.','.$parent;
        $data=M($model)->where($condition)->field($field)->select();
        if($data){
            $arr=$arr;
            $arr=array_merge($data,$this->getLinkedUp($model,$parent,$child,$data[0][$parent],$field,$arr));
        }
        //   $arr=array_reverse($arr);
        return  $arr;
    }
}

