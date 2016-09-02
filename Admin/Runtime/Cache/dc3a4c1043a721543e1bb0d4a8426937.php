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
		<div id="main-content">
        <!-- Main Content Section with everything -->
			<noscript>
            <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
					<div>
						您的浏览器不支持Javascript或者已经禁用了Javascript。请升级您的浏览器或者<a href="http://www.google.com/support/bin/answer.py?answer=23852" title="如何启用 JavaScript">启用</a>Javascript支持才能正确浏览页面.
					</div>
				</div>
			</noscript>
			<!-- Page Head -->
			<div class="clear"></div>
            <!-- End .clear -->
			<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-header">
					<h3>系统配置</h3>
                    <ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">站点信息配置</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">系统参数配置</a></li>
                        <li><a href="#tab3">附件参数配置</a></li>
                        <li><a href="#tab4">站点SEO配置</a></li>
					</ul>
					<div class="clear"></div>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
                	<form method="post" action="<?php echo U("Config/doModify");?>" id="mainFrom">
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                    	<div class="notification information png_bg">
							<a href="#" class="close"><img src="__PUBLIC__/Admin/images/icons/cross_grey_small.png" title="关闭此通知" alt="关闭" /></a>
							<div>
								站点信息配置会影响系统全局显示的信息，请仔细设置。系统全局显示的信息以系统前台为准，部分信息可能将不会在前台显示。如有疑问，请向您的客户专员或售后人员咨询。
							</div>
						</div>
						<fieldset class="column-left"> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<p>
								<label>网站名称</label>
								<input class="text-input medium-input" type="text" id="site_name" name="site_name" value="<?php echo ($vo["site_name"]); ?>" />
							</p>
                            <p>
								<label>网站网址</label>
								<input class="text-input medium-input" type="text" id="site_url" name="site_url" value="<?php echo (($vo["site_url"])?($vo["site_url"]):$frontUrl); ?>" />
								<br /><small>此处为您的网站系统前台地址，一般由系统自动生成，如有错误，请手动更改。</small>
							</p>
                            <p>
								<label>ICP备案号</label>
								<input class="text-input medium-input" type="text" id="icp" name="icp" value="<?php echo ($vo["icp"]); ?>" />
								<br /><small>ICP备案号将在前台底部显示，备案详情请与您的客户专员或售后人员联系。</small>
                                <br /><small><strong style="color:#F00">根据国家工信部规定，无ICP备案号的网站将不得上线。</strong></small>
							</p>
                            <p>
								<label>联系人</label>
								<input class="text-input medium-input" type="text" id="contact_name" name="contact_name" value="<?php echo ($vo["contact_name"]); ?>" />
							</p>
                            <p>
								<label>公司名称</label>
								<input class="text-input medium-input" type="text" id="company_name" name="company_name" value="<?php echo ($vo["company_name"]); ?>" />
							</p>
                            <p>
								<label>公司地址</label>
								<input class="text-input large-input" type="text" id="address" name="address" value="<?php echo ($vo["address"]); ?>" />
							</p>
                        </fieldset>
                        <fieldset class="column-right">
                            <p>
								<label>电话</label>
								<input class="text-input medium-input" type="text" id="telephone" name="telephone" value="<?php echo ($vo["telephone"]); ?>" />
							</p>
                            <p>
								<label>电子邮箱</label>
								<input class="text-input medium-input" type="text" id="email" name="email" value="<?php echo ($vo["email"]); ?>" />
							</p>
                            <p>
								<label>传真</label>
								<input class="text-input medium-input" type="text" id="fax" name="fax" value="<?php echo ($vo["fax"]); ?>" />
							</p>
                            <p>
								<label>手机</label>
								<input class="text-input medium-input" type="text" id="mobile_telephone" name="mobile_telephone" value="<?php echo ($vo["mobile_telephone"]); ?>" />
							</p>
                            <p>
								<label>QQ</label>
								<input class="text-input medium-input" type="text" id="qq" name="qq" value="<?php echo ($vo["qq"]); ?>" />
							</p>
                            <p>
								<label>MSN</label>
								<input class="text-input medium-input" type="text" id="msn" name="msn" value="<?php echo ($vo["msn"]); ?>" />
							</p>
                            <p>
								<label>其他即时通讯工具</label>
								<input class="text-input medium-input" type="text" id="other_im" name="other_im" value="<?php echo ($vo["other_im"]); ?>" />
							</p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                        <p>
                            <input class="button" type="submit" id="submit" name="submit" value="提交更新" />
                            <input class="button" type="reset" id="submit" name="submit" value="还原重填"/>
                            <input name="id" type="hidden" id="id" value="1" />
                        </p>
					</div> <!-- End #tab1 -->
					<div class="tab-content" id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->
                    	<div class="notification information png_bg">
							<a href="#" class="close"><img src="__PUBLIC__/Admin/images/icons/cross_grey_small.png" title="关闭此通知" alt="关闭" /></a>
							<div>
								系统参数配置会影响系统全局显示的信息及图像的显示效果，并可能影响搜索引擎的抓取，请仔细设置。如有疑问，请向您的客户专员或售后人员咨询。
							</div>
						</div>
                        <fieldset>
                            <p>
								<label>网站状态</label>              
								<select name="web_status" id="web_status" class="small-input">
                                	<option value="0" <?php echo (selected($vo["web_status"],0)); ?>>正常运行</option>
                                	<option value="1" <?php echo (selected($vo["web_status"],1)); ?>>暂停访问</option>
                                </select>
							</p>
                            <p>
								<label>暂停原因</label>
								<textarea class="text-input textarea" name="status_description" cols="79" rows="6" id="status_description"><?php echo ($vo["status_description"]); ?></textarea>
							</p>
                            <p>
								<label>头部附加内容</label>
								<textarea class="text-input textarea" name="header_content" cols="79" rows="6" id="header_content"><?php echo ($vo["header_content"]); ?></textarea>
                                <br /><small>此处附加内容一般留空即可</small>
							</p>
                            <p>
								<label>脚部附加内容</label>
								<textarea class="text-input textarea" name="footer_content" cols="79" rows="6" id="footer_content"><?php echo ($vo["footer_content"]); ?></textarea>
                                <br /><small>此处附加内容一般留空即可</small>
							</p>
							<p>
								<label>是否开启留言/评论审核</label>
								<select class="small-input" name="comment_verify" id="comment_verify">
                                    <option value="1" <?php echo (selected($vo["comment_verify"],1)); ?>>开启审核</option>
                                    <option value="0" <?php echo (selected($vo["comment_verify"],0)); ?>>关闭审核</option>
                              	</select>
							</p>
                            <p>
								<label>系统日志</label>
								<select name="sys_log" id="sys_log" class="small-input">
                                    <option value="1" selected="selected">开启日志</option>
                                    <option value="0">关闭日志</option>
                              	</select>
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="index" <?php echo (string2checked($vo["sys_log_ext"],'index')); ?>/>浏览
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="delete" <?php echo (string2checked($vo["sys_log_ext"],'delete')); ?>/>删除
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="modify" <?php echo (string2checked($vo["sys_log_ext"],'modify')); ?>/>编辑
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="insert" <?php echo (string2checked($vo["sys_log_ext"],'insert')); ?>/>写入
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="update" <?php echo (string2checked($vo["sys_log_ext"],'update')); ?>/>批量操作
                                <input name="sys_log_ext[]" type="checkbox" id="sys_log_ext[]" value="login" <?php echo (string2checked($vo["sys_log_ext"],'login')); ?>/>登录后台
							</p>
                            <p>
								<label>运行平台</label>
								<input class="text-input medium-input" name="run_system" type="text" id="run_system" value="<?php echo ($vo["run_system"]); ?>" />
								<br /><small>每个平台间请用"<span style="color:#F00">，</span>"隔开。此功能仅针对下载模块设置。</small>
							</p>
						</fieldset>
						<div class="clear"></div><!-- End .clear -->
						<div class="clear"></div><!-- End .clear -->
                        <p>
                            <input class="button" type="submit" id="submit" name="submit" value="提交更新" />
                            <input class="button" type="reset" id="submit" name="submit" value="还原重填"/>
                            <input name="id" type="hidden" id="id" value="1" />
                        </p>
                    </div> <!-- End #tab2 -->
                    <div class="tab-content" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
                    	<div class="notification information png_bg">
							<a href="#" class="close"><img src="__PUBLIC__/Admin/images/icons/cross_grey_small.png" title="关闭此通知" alt="关闭" /></a>
							<div>
								附件参数配置会影响站点全局的附件上传，配置不当可能会导致附件无法上传，请谨慎设置。如有疑问，请向您的客户专员或售后人员咨询。
							</div>
						</div>
                        <fieldset>
                        <fieldset class="column-left">
                            <p>
								<label>允许附件大小</label>
								<input class="text-input small-input" type="text" name="global_attach_size" id="global_attach_size" value="<?php echo ($vo["global_attach_size"]); ?>" />
                                <br /><small>单位为：KB</small>
							</p>
                            <p>
								<label>允许附件类型</label>
								<input class="text-input medium-input" type="text" name="global_attach_suffix" id="global_attach_suffix" value="<?php echo ($vo["global_attach_suffix"]); ?>" />
                                <br /><small>每个类型之间请用"<span style="color:#F00">，</span>"隔开。</small>
							</p>
                            <p>
								<label>缩略图（全局）</label>
								<select class="small-input" name="global_thumb_status" id="global_thumb_status">
                                    <option value="1" <?php echo (selected($vo["global_thumb_status"],1)); ?>>开启</option>
                                    <option value="0" <?php echo (selected($vo["global_thumb_status"],0)); ?>>关闭</option>
                                </select>
                                <input class="text-input small-input" name="global_thumb_size" type="text" id="global_thumb_size" value="<?php echo ($vo["global_thumb_size"]); ?>" /><span class="input-notification">宽,高（像素）</span>
							</p>
                            <p>
								<label>新闻(缩略图)</label>
								<select class="small-input" name="news_thumb_status" id="news_thumb_status">
                                    <option value="1" <?php echo (selected($vo["news_thumb_status"],1)); ?>>开启</option>
                                    <option value="0" <?php echo (selected($vo["news_thumb_status"],0)); ?>>关闭</option>
                                </select>
	    						<input class="text-input small-input" type="text" name="news_thumb_size" id="news_thumb_size" value="<?php echo ($vo["news_thumb_size"]); ?>" /><span class="input-notification">宽,高（像素）</span>
							</p>
                            <p>
								<label>产品(缩略图)</label>
								<select class="small-input" name="product_thumb_status" id="product_thumb_status">
                                    <option value="1" <?php echo (selected($vo["product_thumb_status"],1)); ?>>开启</option>
                                    <option value="0" <?php echo (selected($vo["product_thumb_status"],0)); ?>>关闭</option>
                                </select>
                                <input class="text-input small-input" type="text" name="product_thumb_size" id="product_thumb_size" value="<?php echo ($vo["product_thumb_size"]); ?>" /><span class="input-notification">宽,高（像素）</span>
							</p>
                            <p>
								<label>下载(缩略图)</label>              
								<select class="small-input" name="download_thumb_status" id="thumb_status4">
                                    <option value="1" <?php echo (selected($vo["download_thumb_status"],1)); ?>>开启</option>
                                    <option value="0" <?php echo (selected($vo["download_thumb_status"],0)); ?>>关闭</option>
                                </select>
                                <input class="text-input small-input" type="text" name="download_thumb_size" id="download_thumb_size" value="<?php echo ($vo["download_thumb_size"]); ?>" /><span class="input-notification">宽,高（像素）</span>
							</p>
						</fieldset>
						<fieldset class="column-right"> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <p>
								<label>水印状态</label>
								<select name="watermark_status" id="watermark_status" class="small-input">
                                    <option value="1" <?php echo (selected($vo["watermark_status"],1)); ?>>开启</option>
                                    <option value="0" <?php echo (selected($vo["watermark_status"],0)); ?>>关闭</option>
                                </select>
                                <br /><small>水印图片默认地址为：Public/Front/watermark.png</small>
							</p>
                            <p>
								<label>图片范围</label>
								<input class="text-input small-input" name="watermark_size" type="text" id="watermark_size" value="<?php echo ($vo["watermark_size"]); ?>" />
                                <br /><small>大于此尺寸的图片才会被打上水印</small>
							</p>
                            <p>
								<label>水印位置</label>
								<select class="small-input" name='watermark_position' id='watermark_position'>
                                    <option value='5' <?php echo (selected($vo["watermark_position"],5)); ?>>随机</option>
                                    <option value="0" <?php echo (selected($vo["watermark_position"],0)); ?>>右下</option>
                                    <option value="3" <?php echo (selected($vo["watermark_position"],3)); ?>>右上</option>
                                    <option value="1" <?php echo (selected($vo["watermark_position"],1)); ?>>左上</option>
                                    <option value="2" <?php echo (selected($vo["watermark_position"],2)); ?>>左下</option>
                                    <option value="4" <?php echo (selected($vo["watermark_position"],4)); ?>>中间</option>
                              	</select>
							</p>
                            <p>
								<label>水印边距</label>
								<input class="text-input small-input" type="text" name="watermark_padding" id="watermark_padding" value="<?php echo ($vo["watermark_padding"]); ?>" />
                                <br /><small>单位为：px（像素）</small>
							</p>
                            <p>
								<label>水印透明度</label>
								<input class="text-input small-input" type="text" name="watermark_trans" id="watermark_trans" value="<?php echo ($vo["watermark_trans"]); ?>" />
                                <br /><small>1－100的整数,越大透明度越低</small>
							</p>
                        </fieldset>
						<div class="clear"></div><!-- End .clear -->
                        <p>
                            <input class="button" type="submit" id="submit" name="submit" value="提交更新" />
                            <input class="button" type="reset" id="submit" name="submit" value="还原重填"/>
                            <input name="id" type="hidden" id="id" value="1" />
                        </p>
                    </div> <!-- End #tab3 -->
                    <div class="tab-content" id="tab4"> <!-- This is the target div. id must match the href of this div's tab -->
                    	<div class="notification attention png_bg">
							<a href="#" class="close"><img src="__PUBLIC__/Admin/images/icons/cross_grey_small.png" title="关闭此通知" alt="关闭" /></a>
							<div>
								站点SEO配置会影响站点全局的SEO设置，配置不当可能影响搜索引擎的排名，请谨慎设置。如对此设置不了解，留空即可，以免对站点产生负面影响。如有疑问，请向您的客户专员或售后人员咨询。
							</div>
						</div>
                        <fieldset>
                            <p>
								<label>网站标题</label>
								<input class="text-input medium-input" type="text" name="seo_title" id="seo_title" value="<?php echo ($vo["seo_title"]); ?>" />
							</p>
                            <p>
								<label>关键词</label>
								<input class="text-input medium-input" name="seo_keyword" type="text"  id="seo_keyword" value="<?php echo ($vo["seo_keyword"]); ?>" />
							</p>
                            <p>
								<label>描述</label>
								<textarea class="text-input textarea" name="seo_description" id="seo_description" cols="50" rows="5"><?php echo ($vo["seo_description"]); ?></textarea>
							</p>
                        </fieldset>
						<div class="clear"></div><!-- End .clear -->
                        <p>
                            <input class="button" type="submit" id="submit" name="submit" value="提交更新" />
                            <input class="button" type="reset" id="submit" name="submit" value="还原重填"/>
                            <input name="id" type="hidden" id="id" value="1" />
                        </p>
                    </div> <!-- End #tab4 -->
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
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
<script type="text/javascript">
$(document).ready(function() {
	$("#mainFrom").validate({
		rules: {
			site_name: "required",
			company_name: "required",
			run_system: "required",
			attach_size: "required",
			attach_suffix: "required",
			link_category: "required",
			global_category: "required"
		},
		messages: {
			site_name: "网站名称须填写",
			company_name: "公司名称必须填写",
			run_system: "运行平台(下载)必须填写",
			attach_size: "允许附件大小必须填写",
			attach_suffix: "允许附件类型必须指定",
			link_category: "友情链接类型必须指定，格式如：普通链接=1|合作伙伴=2|其它链接=3",
			global_category: "模型类别必须指定，格式如：新闻模块=News|产品模块=Product "
		}
	});
});
</script>