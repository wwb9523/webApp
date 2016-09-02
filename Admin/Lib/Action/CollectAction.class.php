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

class CollectAction extends BaseAction
{
    protected $category , $dao,$parentId;
    function _initialize()
    {
        parent::_initialize();
        //取所有分类，过滤出新闻模块主ID

        $this->dao = D('Collect');
    }

    /**
	 * 列表
	 *
	 */
    public function index()
    {
        parent::_checkPermission();
        $count=$this->dao->Table(C('DB_PREFIX').'collect a')->Join(C('DB_PREFIX').'member b on a.userId=b.id')->group('userId')->count();
        $listRows = 15;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Table(C('DB_PREFIX').'collect a')->Join(C('DB_PREFIX').'member b on a.userId=b.id')->Join(C('DB_PREFIX').'recruit c on a.recruitId=c.id')
            ->Join(C('DB_PREFIX').'company d on c.company_id=d.id')->Field('a.id,b.username,d.name as companyName,c.job_title,a.create_time')
            ->Limit($p->firstRow.','.$p->listRows)->findAll();
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
        parent::_checkPermission('News_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $style = createStyle($_POST);
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();
            $this->dao->title_style = $style['title_style'];
            $this->dao->title_style_serialize = $style['title_style_serialize'];
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_image = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
                $this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath']) . splitThumb($uploadFile[0]['savename']) : '' ;

            }
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
        $condition['a.id'] = intval($_GET["id"]);
        $record = $this->dao->Table(C('DB_PREFIX').'collect a')->Join(C('DB_PREFIX').'member b on a.userId=b.id')->Join(C('DB_PREFIX').'recruit c on a.recruitId=c.id')
            ->Join(C('DB_PREFIX').'company d on c.company_id=d.id')->where($condition)->
            Field('a.userId,a.recruitId,b.username,d.name as companyName,c.job_title,a.create_time')->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        $this->assign('vo', $record);
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
            $style = createStyle($_POST);
            $this->dao->title_style = $style['title_style'];
            $this->dao->title_style_serialize = $style['title_style_serialize'];
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_image = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
                $this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath']) . splitThumb($uploadFile[0]['savename']) : '' ;

                @unlink('./'.$this->upload.$_POST['old_image']);
                @unlink('./'.$this->upload.$_POST['old_thumb']);
            }
            if($_POST['deleteImage'] == 1){
                $this->dao->attach = 0;
                $this->dao->attach_image = '';
                $this->dao->attach_thumb = '';
                @unlink($_POST['old_image']);
                @unlink($_POST['old_thumb']);
            }
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
