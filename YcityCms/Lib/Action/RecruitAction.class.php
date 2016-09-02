<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/7/21
 * Time: 14:06
 */
if(!defined("YCITYCMS")) exit("Access Denied");
class RecruitAction extends HomeAction{
	private $dao;
	function _initialize(){
		parent::_initialize();
		$this->dao=M('Recruit');
	}

	public function index()
	{
		$domain=M('Domain')->select();
		$this->assign('domain',$domain);
		$type=intval($_GET['domain']);
		$workPlace=intval($_GET['workPlace']);
		$data=$this->getRecruitSimple($type,$workPlace);
		$this->assign('dataContentList', $data);
		$this->display();
	}

	public function detail(){

		$item=intval($_GET['item']);
		$condition['a.id']=$item;
		$contentDetail = $this->dao->Where($condition)->Table(C('DB_PREFIX').'recruit a')->Join(C('DB_PREFIX').'company b on a.company_id=b.id')
			->Join(C('DB_PREFIX').'contact c on a.contact_id=c.id')->join(C('DB_PREFIX').'level d on a.foreign_language=d.id')->join(C('DB_PREFIX').'level e on a.computer_skill=e.id')
			->join(C('DB_PREFIX').'domain f on a.type=f.id')->join(C('DB_PREFIX').'work_form g on a.form=g.id')->join(C('DB_PREFIX').'education h on a.education=h.id')
			->field('a.id,a.job_title,a.salary,a.count,a.description,a.condition,a.view_count,a.update_time,a.workPlace,
			b.name,b.nature,b.scale,b.description as companyIntro,c.city,c.address,c.postcode,c.website,c.contacts,c.phone,c.fax,c.email,f.title as domain,
			d.title as foreign_language,e.title as computer_skill,f.title as type,g.title as form,h.title as education')->find();
		$conditions['id']=$contentDetail['workPlace'];
		$area=M('Area')->where($conditions)->field('parent_id,title')->find();
		$contentDetail['workPlace']=parent::getLinkedUp('area','parent_id','id',$area['parent_id'],'title',array($area));
		$this->assign('contentDetail',$contentDetail);
		$this->display();
	}
	
	public function search()
	{
		$type=intval($_POST['domain']);
		$workPlace=intval($_POST['workPlace']);
		$data=$this->getRecruitSimple($type,$workPlace);
		if (is_array($data)) {
			$Info = 'success';
			$status = 1;
		} else {
			$Info = 'No Data';
			$status = 0;
		}
		$this->ajaxReturn($data, $Info, $status);
	}

	public function getRecruitSimple($ty=0,$workPlace=0,$id=0){
		if($workPlace) {
			$placeId = array($workPlace);
			$place = parent::getLinked('Area', 'parent_id', 'id', $workPlace);
			foreach ($place as $item) $placeId[] = $item['id'];
			$condition['a.workPlace'] = array('in', $placeId);
		}
		if($ty)$condition['a.type']=$ty;
		if($id)$condition['a.id']=array('in',$id);
		$condition['a.status'] = array('eq', '0');
		$listRows=5;
		$nowPage  = !empty($_GET[C('VAR_PAGE')])?intval($_GET[C('VAR_PAGE')]):1;
		$firstRow=$listRows*($nowPage-1);
		$data=$this->dao->Table(C('DB_PREFIX').'recruit a')->join(C('DB_PREFIX').'company b on a.company_id=b.id')->join(C('DB_PREFIX').'area c on a.workPlace=c.id')
			->join(C('DB_PREFIX').'education d on a.education=d.id')
			->field('a.id ,a.job_title,a.update_time,b.name as companyName,c.title as workPlace,d.title as education')
			->where($condition)->order('a.id DESC')->Limit($firstRow.','.$listRows)->findAll();
		return $data;
	}
}