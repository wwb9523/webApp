<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
	<head>
		<base href="/">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>新城网络企业网站管理平台</title>

		<!--                       CSS                       -->
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="__ROOT__/Public/Admin/css/reset.css"  type="text/css" media="screen" />
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/style.css" type="text/css" media="screen" />
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/invalid.css" type="text/css" media="screen" />	
        <!-- Colorpicker Stylesheet -->
        <link rel="stylesheet" href="__PUBLIC__/Admin/scripts/colorpicker/colorpicker.css" type="text/css" media="screen" />
        <!-- UEditor Stylesheet -->
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Js/ueditor/themes/default/ueditor.css" media="screen" />
		<!-- Colour Schemes
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/blue.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="__PUBLIC__/Admin/css/red.css" type="text/css" media="screen" />  
		-->
		<!-- Internet Explorer Fixes Stylesheet -->
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="__PUBLIC__/Admin/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		<!--                       Javascripts                       -->
        <!-- UEditor -->

        <script type="text/javascript" src="__PUBLIC__/Js/ueditor/editor_config.js"></script>
    	<script type="text/javascript" src="__PUBLIC__/Js/ueditor/editor_ui_all.js"></script>
        <!-- WdatePicker -->
        <script type="text/javascript" src="__PUBLIC__/Js/My97DatePicker/WdatePicker.js"></script>
		<!-- colorpicker -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/colorpicker/colorpicker.js"></script>
		<!-- jQuery -->
		<script src="__PUBLIC__/Js/jquery-3.1.0.min.js"></script>
        <!-- jQuery Validation -->
        <script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.validate.js"></script>
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/simpla.jquery.configuration.js"></script>
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/facebox.js"></script>
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.wysiwyg.js"></script>
		<!-- jQuery Datepicker Plugin -->
		<!-- script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.datePicker.js"></script -->
		<script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.date.js"></script>
		<!--[if IE]><script type="text/javascript" src="__PUBLIC__/Admin/scripts/jquery.bgiframe.js"></script><![endif]-->
		<!-- Internet Explorer .png-fix -->
		<!--[if IE 6]>
			<script type="text/javascript" src="__PUBLIC__/Admin/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
	</head>
<body>
	<div id="body-wrapper">
<!-- Wrapper for the radial gradient background -->
		<div id="sidebar">
        	<div id="sidebar-wrapper">
                <!-- Sidebar with logo and menu -->
                <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
                <!-- Logo (221px wide) -->
                <a href="#"><img id="logo" src="__PUBLIC__/Admin/images/logo.png" alt="logo" /></a>
                <!-- Sidebar Profile links -->
                <div id="profile-links">你好，<a href="<?php echo U('User/modify',array('id'=>$adminId, 'jumpUri'=>'run' ));?>"><?php echo ($realName); ?></a><br /><br /><a href="<?php echo ($frontUrl); ?>" target="_blank" title="浏览网站">浏览网站</a> | <a href="<?php echo U('Public/logout');?>" title="退出系统">退出系统</a></div>        
                <ul id="main-nav">  <!-- Accordion Menu -->
                    <li>
                        <a href='<?php echo U("Index/index");?>' class='nav-top-item no-submenu <?php if($moduleName == Index ): ?>current<?php endif; ?>'><!-- Add the class "no-submenu" to menu items with no sub menu -->系统首页</a>       
                    </li>
                    <!--<li> 
                        <a href="#" class="nav-top-item current">--><!-- Add the class "current" to current menu item --><!--Articles</a>
                        <ul>
                            <li><a href="#">Write a new Article</a></li>
                            <li><a class="current" href="#">Manage Articles</a></li>--> <!-- Add class "current" to sub menu items also -->
                            <!--<li><a href="#">Manage Comments</a></li>
                            <li><a href="#">Manage Categories</a></li>
                        </ul>
                    </li>-->
                    <li>
                        <a href="#" class='nav-top-item <?php if(($moduleName == Config) OR ($moduleName == Module) OR ($moduleName == Theme) OR ($moduleName == User) OR ($moduleName == Role)): ?>current<?php endif; ?>'>基本设置</a>
                        <ul>
                            <li class="Config"><a href="<?php echo U("Config/index");?>" <?php if(($moduleName == Config)): ?>class="current"<?php endif; ?>>系统配置</a></li>
                            <li class="Module"><a href="<?php echo U("Module/index");?>" <?php if(($moduleName == Module)): ?>class="current"<?php endif; ?>>系统模块</a></li>
                            <li class="Theme"><a href="<?php echo U("Theme/index");?>" <?php if(($moduleName == Theme)): ?>class="current"<?php endif; ?>>风格主题</a></li>
                            <li class="User"><a href="<?php echo U("User/index");?>" <?php if(($moduleName == User) OR ($moduleName == Role)): ?>class="current"<?php endif; ?>>管理员管理</a></li>
                            <!-- li class="AdminRole"><a href="<?php echo U("AdminRole/index");?>" <?php if(($moduleName == AdminRole)): ?>class="current"<?php endif; ?>>角色管理</a></li -->
                        </ul>
                    </li>
                    <li>
                        <a href="#" class='nav-top-item <?php if(($moduleName == Ad) OR ($moduleName == Category) OR ($moduleName == Link)): ?>current<?php endif; ?>'>模块管理</a>
                        <ul>
                            <!-- li class="Menu"><a href="<?php echo U("Menu/index");?>">导航管理</a></li -->
                            <!--<li class="Ad"><a href="<?php echo U("Ad/index");?>">广告管理</a></li>-->
                            <li class="Category"><a href="<?php echo U("Category/index");?>">分类管理</a></li>
                            <!--<li class="News"><a href="<?php echo U('News/index');?>" <?php if(($moduleName == News)): ?>class="current"<?php endif; ?>>工作形式管理</a></li>-->
                            <!--<li class="Link"><a href="<?php echo U("Link/index");?>">友情链接管理</a></li>-->
                            <!-- li class="Feedback"><a href="<?php echo U("Feedback/index");?>">留言管理</a></li>
                            <li class="Job"><a href="<?php echo U("Job/index");?>">招聘管理</a></li>
                            <li class="Tags"><a href="<?php echo U("Tags/index");?>">标签管理</a></li>
                            <li class="Comment"><a href="<?php echo U("Comment/index");?>">评论管理</a></li -->
                        </ul>
                    </li>

                    <li>
                        <a href="#" class='nav-top-item <?php if(($moduleName == News) OR($moduleName == Notice) OR ($moduleName == Record) OR ($moduleName == Resume) OR ($moduleName == Job) OR ($moduleName == Video) OR ($moduleName == Journal) OR ($moduleName == Notice) OR ($moduleName == Person)): ?>current<?php endif; ?>'>内容管理</a>
                        <ul>
                            <li class="News"><a href="<?php echo U('News/index');?>" <?php if(($moduleName == News)): ?>class="current"<?php endif; ?>>新闻管理</a></li>
                            <li class="Notice"><a href="<?php echo U('Notice/index');?>"<?php if(($moduleName == Notice)): ?>class="current"<?php endif; ?>>公告管理</a></li>
                            <li class="Record"><a href="<?php echo U('Record/index');?>" <?php if(($moduleName == Record)): ?>class="current"<?php endif; ?>>档案管理</a></li>
                            <li class="Resume"><a href="<?php echo U('Resume/index');?>" <?php if(($moduleName == Resume)): ?>class="current"<?php endif; ?>>简历管理</a></li>
                            <li class="Job"><a href="<?php echo U('Recruit/index');?>" <?php if(($moduleName == Recruit)): ?>class="current"<?php endif; ?>>招聘管理</a></li>
                          <!--  <li class="Page"><a href="<?php echo U('Page/index');?>" <?php if(($moduleName == Page)): ?>class="current"<?php endif; ?>>单页管理</a></li>-->
                           <!-- <li class="Course"><a href="<?php echo U('Course/index');?>" <?php if(($moduleName == Course)): ?>class="current"<?php endif; ?>>精品课程管理</a></li>-->
                           <!-- <li class="Page"><a href="<?php echo U('Page/modify',array('id'=>1));?>" <?php if(($moduleName == Page)): ?>class="current"<?php endif; ?>>单页管理</a></li> -->
                           <!-- <li class="Article"><a href="<?php echo U('Article/index');?>" <?php if(($moduleName == Article)): ?>class="current"<?php endif; ?>>投稿管理</a></li> -->
                            <!--<li class="Video"><a href="<?php echo U('Video/index');?>" <?php if(($moduleName == Video)): ?>class="current"<?php endif; ?>>视频管理</a></li>
                            <li class="Journal"><a href="<?php echo U('Journal/index');?>" <?php if(($moduleName == Journal)): ?>class="current"<?php endif; ?>>期刊管理</a></li>
                            <li class="Person"><a href="<?php echo U('Person/index');?>" <?php if(($moduleName == Person)): ?>class="current"<?php endif; ?>>企业人物管理</a></li>-->
						</ul>
                    </li>
                    <li>
                        <a href="#" class='nav-top-item <?php if(($moduleName == Member) OR ($moduleName == Group)): ?>current<?php endif; ?>'>会员管理</a>
                        <ul>
                            <li class="Config"><a href="<?php echo U("Member/index");?>" <?php if(($moduleName == Member)): ?>class="current"<?php endif; ?>>会员资料管理</a></li>
                            <!-- li class="Module"><a href="<?php echo U("Group/index");?>" <?php if(($moduleName == Group)): ?>class="current"<?php endif; ?>>会员组管理</a></li -->
                        </ul>
                    </li>
                    <li>
                        <a href="#" class='nav-top-item <?php if(($moduleName == Core) OR ($moduleName == Tools) OR ($moduleName == Label) OR ($moduleName == Database) OR ($moduleName == AdminLog)): ?>current<?php endif; ?>'>高级设置</a>
                        <ul>
                        	<li class="Core"><a href="<?php echo U("Core/index");?>" <?php if(($moduleName == Core)): ?>class="current"<?php endif; ?>>内核配置</a></li>
                        	<li class="Tools"><a href="<?php echo U("Tools/index");?>" <?php if(($moduleName == Tools)): ?>class="current"<?php endif; ?>>工具箱</a></li>
                            <!-- li class="Label"><a href="<?php echo U("Label/index");?>">数据调用</a></li -->
                            <li class="Database"><a href="<?php echo U("Database/index");?>" <?php if(($moduleName == Database)): ?>class="current"<?php endif; ?>>数据库管理</a></li>
                            <li class="AdminLog"><a href="<?php echo U("AdminLog/index");?>" <?php if(($moduleName == AdminLog)): ?>class="current"<?php endif; ?>>操作日志</a></li>
						</ul>
                    </li>  
                </ul>
                <!-- End #main-nav -->
				<div id="messages" style="display: none">
                <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                    <h3>3 Messages</h3>
                    <p>
                        <strong>17th May 2009</strong> by Admin<br />
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
                        <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                    </p>
                    <p>
                        <strong>2nd May 2009</strong> by Jane Doe<br />
                        Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
                        <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                    </p>
                    <p>
                        <strong>25th April 2009</strong> by Admin<br />
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
                        <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                    </p>
                    <form action="" method="post">
                        <h4>New Message</h4>
                        <fieldset>
                            <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
                        </fieldset>
                        <fieldset>
                            <select name="dropdown" class="small-input">
                                <option value="option1">Send to...</option>
                                <option value="option2">Everyone</option>
                                <option value="option3">Admin</option>
                                <option value="option4">Jane Doe</option>
                            </select>
                            <input class="button" type="submit" value="Send" />
                        </fieldset>
                    </form>
                </div>
                <!-- End #messages -->
            </div>
        </div>
        <!-- End #sidebar -->
		<div id="main-content" class="index">
        <!-- Main Content Section with everything -->
			<noscript>
            <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
					<div>
						您的浏览器不支持Javascript或者已经禁用了Javascript。请升级您的浏览器或者启用Javascript支持才能正确浏览页面。在您升级您的浏览器或启用Javascript之前，您仍可正常地对您的系统进行管理，但某些高级功能将失效。<a href="http://www.google.com/support/bin/answer.py?answer=23852" title="如何启用 JavaScript" target="_blank">如何启用？</a>
					</div>
				</div>
			</noscript>
			<!-- Page Head -->
			<h2>欢迎回来 <?php echo ($realName); ?></h2>
			<p id="page-intro">您可以进行如下快捷操作：</p>
			<ul class="shortcut-buttons-set">
				<li>
                	<a class="shortcut-button" href="#"><span><img src="__PUBLIC__/Admin/images/icons/pencil_48.png" alt="icon" /><br />发布文章</span></a></li>
				<li>
                	<a class="shortcut-button" href="#"><span><img src="__PUBLIC__/Admin/images/icons/paper_content_pencil_48.png" alt="icon" /><br />创建页面</span></a></li>
				<li>
                	<a class="shortcut-button" href="#"><span><img src="__PUBLIC__/Admin/images/icons/image_add_48.png" alt="icon" /><br />上传图片</span></a></li>
				<li>
                	<a class="shortcut-button" href="#"><span><img src="__PUBLIC__/Admin/images/icons/clock_48.png" alt="icon" /><br />新增备忘</span></a></li>
				<li>
                	<a class="shortcut-button" href="#messages" rel="modal"><span><img src="__PUBLIC__/Admin/images/icons/comment_48.png" alt="icon" /><br />编辑模块</span></a>
                </li>
			</ul>
            <!-- End .shortcut-buttons-set -->
			<div class="clear"></div>
            <!-- End .clear -->
            <div class="content-box column-left">
				<div class="content-box-header">
                <!-- Add the class "closed" to the Content box header to have it closed by default -->
					<h3>个人信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
                    	<p>用户名：<?php echo ($username); ?></p>
                        <p>所属用户组：<?php echo ($roleName); ?></p>
                        <p>最后登录时间：<?php echo (date("Y.m.d H:i:s",$user['last_login_time'])); ?></p>
                        <p>登录次数：<?php echo ($user['login_count']); ?></p>
					</div>
                    <!-- End #tab3 -->
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
            <div class="content-box column-right">
				<div class="content-box-header">
                <!-- Add the class "closed" to the Content box header to have it closed by default -->
					<h3>统计信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
                        <table>
                            <tbody>
                                <tr>
                                    <td>新闻模型</td>
                                    <td>产品模型</td>
                                    <td>下载模型</td>
                                    <td>公告模型</td>
                                    <td>单页模型</td>
                                </tr>
                                <tr>
                                    <td><?php echo ($statNews); ?></td>
                                    <td><?php echo ($statProduct); ?></td>
                                    <td><?php echo ($statDownload); ?></td>
                                    <td><?php echo ($statNotice); ?></td>
                                    <td><?php echo ($statPage); ?></td>
                                </tr>
                                <tr>
                                    <td>评论总数</td>
                                    <td>留言总数</td>
                                    <td>会员总数</td>
                                    <td>分类总数</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><?php echo ($statComment); ?></td>
                                    <td><?php echo ($statFeedback); ?></td>
                                    <td><?php echo ($statMember); ?></td>
                                    <td><?php echo ($statCategory); ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
					</div>
                    <!-- End #tab3 -->
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
            <div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box column-left">
				<div class="content-box-header">
					<h3>系统信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
						<p>系统版本：<?php echo C('SYS_VERSION');?> build<?php echo C('SYS_UPDATETIME');?></p>
                        <p>程序开发：sffy，mchunt，yel_hb</p>
                        <p>页面设计：晓风残月</p>
                        <p>电子邮箱：y_city@qeeyang.com</p>
                        <p>官方网站：<a href="http://www.y-city.net.cn" target="_blank">http://www.y-city.net.cn</a></p>
					</div>
                    <!-- End #tab3 -->        
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
			<div class="content-box column-right">
				<div class="content-box-header">
                <!-- Add the class "closed" to the Content box header to have it closed by default -->
					<h3>服务器信息</h3>
				</div>
                <!-- End .content-box-header -->
				<div class="content-box-content">
					<div class="tab-content default-tab">
                        <p>主机域名: <?php echo ($serverUri); ?></p>
                        <p>运行环境: <?php echo ($serverSoft); ?></p>
                        <p>MySQL版本: <?php echo ($mysqlVersion); ?></p>
                        <p>PHP版本: <?php echo ($phpVersion); ?></p>
                        <!-- p>全局变量: <?php echo ($phpGpc); ?></p -->
                        <p>附件上传限制: <?php echo ($phpUploadSize); ?></p>
                        <!-- p>最大执行时间: <?php echo ($maxExcuteTime); ?></p>
                        <p>最大使用内存: <?php echo ($maxExcuteMemory); ?></p>
                        <p>当前使用内存: <?php echo ($excuteUseMemory); ?></p -->
					</div>
                    <!-- End #tab3 -->        
				</div>
                <!-- End .content-box-content -->
			</div>
            <!-- End .content-box -->
			<div class="clear"></div>
			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2011 <a href="http://www.qeeyang.com" target="_blank">Qeeyang Technology Co.,Ltd.</a> | Powered by <a href="http://www.y-city.net.cn" target="_blank">Y-city</a>
				</small>
			</div>
            <!-- End #footer -->
		</div>
        <!-- End #main-content -->
	</div>
</body>
</html>