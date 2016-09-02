<?php
/**
 * 
 * Public(公共)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class PublicAction extends HomeAction{
    private $adminId;
    private $roleId;
    
    function _initialize()
    {
        parent::_initialize();
        $this->adminId = Session::get('adminId');
        $this->roleId = Session::get('roleId');
    }

    /**
     * 登录页
     *
     */
    public function login()
    {
        $jumpUri = safe_b64decode($_GET['jumpUri']);
        $this->assign('jumpUri', $jumpUri);
        $this->display();
    }

    /**
     * 提交登录
     *
     */
    public function doLogin()
    {
//		load('extend');//加载Thinkphp扩展函数库  why??
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $verifyCode = trim($_POST['verifyCode']);
        if(empty($username) || empty($password)){
            //self::_message('error', '用户名，密码必须填写', U('Public/login'));
         //   echo 'emptyInfo';
            $this->ajaxReturn('','emptyInfo',0);
            exit();
        }elseif(md5($verifyCode) != Session::get('verify'))
        {
            //self::_message('error', '验证码错误', U('Public/login'));
          //  echo 'errorVerifyCode';
            $this->ajaxReturn('','errorVerifyCode',0);
            exit();
        }

        $condition = array();
        $dao = D('Member');
        $condition["username"] = $username;
        $record = $dao->where($condition)->find();
        if(false == $record)
        {
          //  echo 'usernameFalse';
            $this->ajaxReturn('','usernameFalse',0);
            exit();
            //self::_message('error', '用户信息不存在，登录失败');
        }else{
            if ($record['password'] != md5($password)){
              //  echo 'passwordFalse';
                $this->ajaxReturn('','passwordFalse',0);
                exit();
                //self::_message('error', '密码错误', U('Public/login'));
            }
            if ($record['role_id'] == 2) {
            //   echo 'roleFalse';
                $this->ajaxReturn('','roleFalse',0);
                exit();
                //self::_message('error', '当前用户被限制登录，请联系管理员', U('Public/login'));
            }
            $roleDao = D('Group');
            $getRole = $roleDao->where("id={$record['group_id']}")->find();
            if(empty($getRole)){
          //      echo 'roleLost';
                $this->ajaxReturn('','roleLost',0);
                exit();
            }
            Session::set('username', $record['username']);
            Session::set('adminId', $record['id']);
            Session::set('roleId', $record['group_id']);
            Session::set('adminAccess', C('ADMIN_ACCESS'));
			Session::set('roleName', $getRole['role_name']);
			Session::set('realName', $record['realname']);

            /**
             * 记录日志
             */
            parent::_sysLog('login','登录系统',$record['id'],$username);
       
			$dao = D('Member');
			$data = array();
			$data['id'] = intval($record['id']);
			$data['last_login_time'] = time();
			$data['last_ip'] = get_client_ip();
			$data['login_count'] = array('exp','login_count+1');
			$dao->save($data);

        //    echo 'loginSuccess';
            $this->ajaxReturn('','loginSuccess',1);
            exit();
            //self::_message('success', '登录成功', U('Index/index'), 1);
        }
    }

    public function changePwd(){
        $jumpUri = safe_b64decode($_GET['jumpUri']);
        $this->assign('jumpUri', $jumpUri);
        $this->display();
    }

    public function doChangePwd()
    {
 //       Load('extend');//加载Thinkphp扩展函数库
        $username = trim($_POST['username']);
        $password = trim($_POST['password_old']);
        $passwordNew = trim($_POST['password_new']);
        $verifyCode = trim($_POST['verifyCode']);
        if (empty($username) || empty($password) || empty($passwordNew)) {
            //self::_message('error', '用户名，密码必须填写', U('Public/login'));
            echo 'emptyInfo';
            exit();
        } elseif (md5($verifyCode) != Session::get('verify')) {
            //self::_message('error', '验证码错误', U('Public/login'));
            echo 'errorVerifyCode';
            exit();
        }

        $condition = array();
        $dao = D('Member');
        $condition["username"] = $username;
        $record = $dao->where($condition)->find();
        //echo $dao->getLastSql();
        if (false == $record) {
            echo 'usernameFalse';
            exit();
            //self::_message('error', '用户信息不存在，登录失败');
        } else {
            if ($record['password'] != md5($password)) {
                echo 'passwordFalse';
                exit();
                //self::_message('error', '密码错误', U('Public/login'));
            }
            if ($record['role_id'] == 2) {
                echo 'roleFalse';
                exit();
                //self::_message('error', '当前用户被限制登录，请联系管理员', U('Public/login'));
            }
            $roleDao = D('Role');
            $getRole = $roleDao->where("id={$record['role_id']}")->find();
            if(empty($getRole)){
                echo 'roleLost';
                exit();
            }
            /**
             * 记录日志
             */
            parent::_sysLog('changePwd','修改密码',$record['id'],$username);

            /**
             *修改密码
             */
            $dao = D('Member');
            $data = array();
            $data['id'] = intval($record['id']);
            $data['password']=md5($passwordNew);
            $dao->save($data);

            echo 'changeSuccess';
            exit();
        }
    }

    /**
     * 验证码
     *
     */
    public function verify()
    {
        import('ORG.Util.Image');
        if(isset($_REQUEST['adv']))
        {
            Image::showAdvVerify();
        }
        else
        {
            Image::buildImageVerify();
       }
    }


    public function getArea(){
        $parentId=intval($_POST['id']);
        $condition['parent_id']=$parentId;
        $data=M('Area')->where($condition)->field('id,title')->findAll();
        $level=D('Area')->where($condition)->field('level')->find();
        if($data){
            $info=$level['level'];
            $status=1;
        }else{
            $info='No Data';
            $status=0;
        }
        $this->ajaxReturn($data,$info,$status);
    }

    /**
     * 输出信息
     *
     * @param unknown_type $type
     * @param unknown_type $content
     * @param unknown_type $jumpUrl
     * @param unknown_type $time
     * @param unknown_type $ajax
     */
    public function _message($type = 'success', $content = '更新成功', $jumpUrl = __URL__, $time = 3, $ajax = false)
    {
        $jumpUrl = empty($jumpUrl) ? __URL__ : $jumpUrl ;
        if($type == 'success'){
            $this->assign('jumpUrl', $jumpUrl);
            $this->assign('waitSecond', $time);
            $this->success($content, $ajax);
        }elseif($type == 'error'){
            $this->assign('jumpUrl', $jumpUrl);
            $this->assign('waitSecond', $time);
            $this->error($content, $ajax);
        }elseif($type == 'redirect'){
            $this->redirect($jumpUrl);
        }
    }

    /**
     * 无权限操作显示页
     *
     */
    public function accessFalse()
    {
        $this->display();
    }

    /**
     * 退出登录
     *
     */
    public function logout()
    {
        Session::destroy();
        cookie('tempTheme', null);
        redirect( U('Index/index'));
    }
}
