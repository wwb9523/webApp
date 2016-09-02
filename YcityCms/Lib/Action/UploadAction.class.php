<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/4
 * Time: 11:06
 */
if(!defined("YCITYCMS")) exit("Access Denied");
class UploadAction extends HomeAction{
	private $dao;
	function _initialize(){
		parent::_initialize();
		if(!parent::isLogin())redirect( U('Public/login',array('jumpUri'=>safe_b64encode($_SERVER['REQUEST_URI']))));
		$this->dao=D('Category');
	}

	public function index(){
		$category=$this->dao->where('module=Download')->Order('id DESC')->field('id')->find();
		$id=$category[0]['id'];
		$this->assign('id',$id);
		$this->display();
	}

	public function doInsert(){
		$this->dao=D('Download');
		parent::_setMethod('post');
		if($daoCreate = $this->dao->create())
		{
			$this->dao->user_id = parent::_getAdminUid();
			$this->dao->username = parent::_getAdminName();
			$this->dao->title=parent::forShowHtml($this->dao->title);
			$this->dao->content=parent::forShowHtml($this->dao->content);
			$uploadFile = upload($this->getActionName());
			if ($uploadFile){
				$this->dao->attach_file = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
				$size=filesize(UPLOAD_PATH.DIRECTORY_SEPARATOR.$this->dao->attach_file);
				$MB=pow(1024,2);
				$KB=1024;
				$G=pow(1024,3);
				if($size>$G) {
					$this->dao->file_size = round($size/$G,2);
					$this->dao->file_size_unit = 'G';
				}
				elseif($size>$MB){
					$this->dao->file_size = round($size/$MB,2);
					$this->dao->file_size_unit = 'MB';
				}
				elseif ($size>$KB){
					$this->dao->file_size = round($size/$KB,2);
					$this->dao->file_size_unit = 'KB';
				}
				else{
					$this->dao->file_size = $size;
					$this->dao->file_size_unit = 'B';
				}
				$this->dao->extension=pathinfo(UPLOAD_PATH.DIRECTORY_SEPARATOR.$this->dao->attach_file,PATHINFO_EXTENSION);
			}
			$row=M('Category')->where('parent_id=0 and module="Download"')->field('id')->limit(1)->find();
			$this->dao->category_id=$row['id'];
			$this->dao->create_time=time();
			$daoAdd = $this->dao->add();
			if(false !== $daoAdd)
			{
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
}