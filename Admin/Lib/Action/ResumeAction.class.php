<?php 
/**
 * 
 * News(新闻)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class ResumeAction extends BaseAction
{
    protected $category , $dao,$parentId;
    function _initialize()
    {
        parent::_initialize();
        //取所有分类，过滤出新闻模块主ID
        $this->dao = D('Resume');
    }

    /**
	 * 列表
	 *
	 */
    public function index()
    {
        parent::_checkPermission();
        $condition = array();
        $title = formatQuery($_GET['title']);
        $companyId = intval($_GET['companyId']);
        $status =  intval($_GET['status']);
        $createTime = trim($_GET['createTime']);
        $createTime1 = trim($_GET['createTime1']);
        $viewCount = intval($_GET['viewCount']);
        $viewCount1 = intval($_GET['viewCount1']);
        $setTime = setTime($createTime, $createTime1);
        $setViewCount = setViewCount($viewCount, $viewCount1);
        $pageSize = intval($_GET['pageSize']);
        $title &&  $condition['a.job_title'] = array('like', '%'.$title.'%');
        $status && $condition['a.status'] = array('eq', $status);
        $companyId && $condition['a.user_id'] = array('eq', $companyId);
        $createTime1 && $condition['a.create_time'] = array('between', $setTime);
        $viewCount1 && $condition['a.view_count'] = array('between', $setViewCount);
        $count=$this->dao->Table(C('DB_PREFIX').'news a')->Join(C('DB_PREFIX').'category b on a.category_id=b.id')->where($condition)->count();
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Table(C('DB_PREFIX').'resume a')->Join(C('DB_PREFIX').'member b on a.userId=b.id')->where($condition)->
        order('id DESC')->Field('a.id,a.gender,a.age,a.jobs,a.update_time,b.realname')->Limit($p->firstRow.','.$p->listRows)->findAll();
        $page = $p->show();
        if ($dataList !== false)
        {
            $this->assign('pageBar', $page);
            $this->assign('dataList', $dataList);
        }
        parent::_sysLog('index');
        $this->display();
    }

    /**
     * 录入
     *
     */
    public function insert()
    {
        parent::_checkPermission();
        $education=M('education')->select();
        $this->assign('education',$education);
        $member=M('member')->field('id,username')->select();
        $this->assign('member',$member);
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Resume_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $daoAdd = $this->dao->add();
            if(false !== $daoAdd)
            {
                $this->dao->create_time=time();
                $this->dao->update_time=time();
                parent::_tags('insert', $_POST['tags'], $daoAdd);
                parent::_sysLog('insert', "录入:$daoAdd");
                parent::_message('success', '录入成功');
            }else
            {
                parent::_message('error', '录入失败');
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
        parent::_checkPermission();
        $item =intval($_GET["id"]);
        $education=M('education')->select();
        $condition['a.id'] =$item;
        $record = $this->dao->Table(C('DB_PREFIX').'resume a')->Join(C('DB_PREFIX').'member b on a.userId=b.id')
            ->where($condition)->Field('a.*,b.realname')->find();
        $conditions['id']=$record['workPlace'];
        $area=M('Area')->where($conditions)->field('parent_id,title')->find();
        $record['areas']=parent::getLinkedUp('area','parent_id','id',$area['parent_id'],array($area));
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        $this->assign('education',$education);
        $this->assign('vo', $record);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        parent::_checkPermission('Resume_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->update_time=time();
            $daoSave = $this->dao->save();
            if(false !== $daoSave)
            {
                parent::_tags('modify', $_POST['tags'], $item);
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '更新完成');
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
        parent::_checkPermission('News_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        $newCategory = intval($_POST['newCategory']);
        switch ($operate){
            case 'delete':
                parent::_tagsDelete('News');
                parent::_delete(0, 0, array('attach_image', 'attach_thumb'));
                break;
            case 'recommend': parent::_recommend('set');break;
            case 'unRecommend': parent::_recommend('unset');break;
            case 'setTop': parent::_setTop('set');break;
            case 'unSetTop': parent::_setTop('unset');break;
            case 'setStatus': parent::_setStatus('set');break;
            case 'unSetStatus': parent::_setStatus('unset');break;
            case 'update': parent::_batchModify(0, $_POST, array('title','display_order'));break;
            case 'move': parent::_move($newCategory);break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
