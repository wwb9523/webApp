<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/7/21
 * Time: 14:06
 */
if(!defined("YCITYCMS")) exit("Access Denied");
class RecordAction extends HomeAction{
	private $dao;
	function _initialize(){
		parent::_initialize();
		$this->dao=M('Record');
		$condition['title']="档案查询注意事项";
		$notice=M('Notice')->where($condition)->field('content')->find();
		$this->assign('notice',$notice);
	}

	public function index()
	{
		$certificate=C('DATA_LIST.certificate');
		//$certificate=M('Certificate')->findAll();
		$this->assign('certificate',$certificate);
		$this->display();
	}

	public function detail(){

		$item=intval($_GET['item']);
		$condition['id']=$item;
		$contentDetail=$this->dao->where($condition)->find();
		$this->assign('contentDetail',$contentDetail);
		$this->display();
	}
	
	public function search()
	{
		$graduate=$_POST['graduate'];
		$certificate=$_POST['certificate'];
		$certificate_num=$_POST['certificate_num'];
		$condition['graduate_date']=$graduate;
		$condition['certificate_type']=$certificate;
		$condition['certificate_number']=$certificate_num;
		$contentDetail=$this->dao->where($condition)->field('id')->find();
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			if(!$contentDetail){
				$this->ajaxReturn(' ','No Data',0);
				exit();
			}
			else{
				$this->ajaxReturn($contentDetail,'success',1);
				exit();
			}
		}
	}
}