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

class NoticeAction extends BaseAction
{
    protected $category , $dao,$parentId;
    function _initialize()
    {
        parent::_initialize();
        //取所有分类，过滤出新闻模块主ID
        $category = D('Category')->where('module="Notice"')->Order('display_order DESC,id DESC')->findAll();

        //取主ID下属分类
        $this->assign('category', $category);
        $this->dao = D('Notice');
    }

    /**
	 * 列表
	 *
	 */
    public function index()
    {
        parent::_checkPermission();
        $count=$this->dao->count();
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Order('id DESC')->Limit($p->firstRow.','.$p->listRows)->findAll();
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
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Notice_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $daoAdd = $this->dao->add();
            if(false !== $daoAdd)
            {
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
        $item = intval($_GET["id"]);
        $record = $this->dao->where('id='.$item)->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        $this->assign('vo', $record);
        $condition['id']=$record['category_id'];
        $cur=M('category')->where($condition)->field('category_id,id,parent_id')->select();
        $cur=$cur[0];
        $this->assign('cur', $cur);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        parent::_checkPermission('News_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create())
        {
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
