<?php
/**
 * Created by PhpStorm.
 * User: APTX
 * Date: 2016/8/23
 * Time: 11:46
 */
if(!defined("YCITYCMS")) exit("Access Denied");
class PersonAction extends HomeAction
{
	private $dao,$userId;
	protected function _initialize(){
		parent::_initialize();
		if(!parent::isLogin()){
			redirect( U('Public/login',array('jumpUri'=>safe_b64encode($_SERVER['REQUEST_URI']))));
		}
		$this->userId=intval(Session::get('adminId'));
		$this->dao=M('User');
	}
	
	public function index(){
		$apply=$this->getApplyData();
		$collect=$this->getCollectData();
		$resume=$this->getResumeData();
		$this->assign('apply',$apply);
		$this->assign('collect',$collect);
		$this->assign('resume',$resume);
		$this->display();
	}

	public function apply(){
		$data=$this->getApplyData();
		if($data){
			$info='success';
			$status=1;
		}
		else{
			$info='No Data';
			$status=0;
		}
		$this->ajaxReturn($data,$info,$status);
	}

	private function getApplyData(){
		$id=array();
		$this->dao=M('Apply');
		$condition['userId']=$this->userId;
		$collects = $this->dao->where($condition)->field('recruitId')->findAll();
		foreach ($collects as $item){
			$id[]=$item['recruitId'];
		}
		if(empty($id))$id[]=0;
		$Recruit=new RecruitAction();
		$data=$Recruit->getRecruitSimple(0,0,$id);
		return $data;
	}

	public function collect(){
		$data=$this->getCollectData();
		if($data){
			$info='success';
			$status=1;
		}
		else{
			$info='No Data';
			$status=0;
		}
		$this->ajaxReturn($data,$info,$status);
	}

	private function getCollectData(){
		$id=array();
		$this->dao=M('Collect');
		$condition['userId']=$this->userId;
		$collects = $this->dao->where($condition)->field('recruitId')->findAll();
		foreach ($collects as $item){
			$id[]=$item['recruitId'];
		}
		if(empty($id))$id[]=0;
		$Recruit=new RecruitAction();
		$data=$Recruit->getRecruitSimple(0,0,$id);
		return $data;
	}

	public function getResumeData(){
		$condition['a.userId']=$this->userId;
		$data=$this->dao->Table(C('DB_PREFIX').'resume a')->join(C('DB_PREFIX').'member b on a.userId=b.id')->join(C('DB_PREFIX').'education c on a.education=c.id')
			->where($condition)->field('a.*,b.realname,c.title as education')->find();
		if($data){
			$conditions['resumeId']=$data['id'];
			$language=D('Language')->where($conditions)->field('language_type,language_level')->findAll();
			$data['language']=$language;
		}
		return $data;
	}
	public function doChangePwd()
	{
		//       Load('extend');//加载Thinkphp扩展函数库
		$userId = $this->userId;
		$password = trim($_POST['password_old']);
		$passwordNew = trim($_POST['password_new']);
		if ( empty($password) || empty($passwordNew)) {
			//self::_message('error', '用户名，密码必须填写', U('Public/login'));
		//	echo 'emptyInfo';
			$this->ajaxReturn('','emptyInfo',0);
			exit();
		} 

		$condition = array();
		$dao = D('Member');
		$condition["id"] =$userId;
		$record = $dao->where($condition)->find();
		//echo $dao->getLastSql();
		if (false == $record) {
			$this->ajaxReturn('','usernameFalse',0);
		//	echo 'usernameFalse';
			exit();
			//self::_message('error', '用户信息不存在，登录失败');
		} else {
			if ($record['password'] != md5($password)) {
			//	echo 'passwordFalse';
				$this->ajaxReturn('','passwordFalse',0);
				exit();
				//self::_message('error', '密码错误', U('Public/login'));
			}
			if ($record['role_id'] == 2) {
			//	echo 'roleFalse';
				$this->ajaxReturn('','roleFalse',0);
				exit();
				//self::_message('error', '当前用户被限制登录，请联系管理员', U('Public/login'));
			}
			$roleDao = D('Role');
			$getRole = $roleDao->where("id={$record['role_id']}")->find();
			if (empty($getRole)) {
			//	echo 'roleLost';
				$this->ajaxReturn('','roleLost',0);
				exit();
			}
			/**
			 * 记录日志
			 */
			parent::_sysLog('changePwd', '修改密码', $userId, $record['username']);

			/**
			 *修改密码
			 */
			$dao = D('Member');
			$data = array();
			$data['id'] = intval($userId);
			$data['password'] = md5($passwordNew);
			$dao->save($data);
			$this->ajaxReturn('','changeSuccess',1);
		//	echo 'changeSuccess';
			exit();
		}
	}

	public function doRecruit(){

		if('apply'==$_POST['mode'])$this->dao=M('Apply');
		else if('collect'==$_POST['mode'])$this->dao=M('Collect');
		else {$this->ajaxReturn('','error mode',0);exit();}
		$condition['userId']=$this->userId;
		$condition['recruitId']=intval($_POST['recruitId']);
		$row=$this->dao->where($condition)->field('id')->find();
		if($row){$this->ajaxReturn('','existed data',1);exit();}
		parent::_setMethod('post');
		if($daoCreate = $this->dao->create()){
			$this->dao->userId=$this->userId;
			$time=time();
			$this->dao->create_time=$time;
			$this->dao->update_time=$time;
			$daoAdd = $this->dao->add();
			if(false !== $daoAdd){
				$info='success';
				$status=1;
			}else{
				$info='Add False';
				$status=0;
			}
			$this->ajaxReturn('',$info,$status);
		}
	}
	
}
