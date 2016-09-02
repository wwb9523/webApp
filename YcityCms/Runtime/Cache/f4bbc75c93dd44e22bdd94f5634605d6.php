<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php if(isset($contentDetail)): ?><?php echo ($contentDetail["title"]); ?>-<?php endif; ?><?php if(isset($moduleTitle)): ?><?php echo ($moduleTitle); ?>-<?php endif; ?><?php echo ($sysConfig["site_name"]); ?>-<?php echo ($sysConfig["seo_title"]); ?>-Powered by Y-city</title><meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1" /><script src="__PUBLIC__/Js/jquery-3.1.0.min.js"></script><script src="__PUBLIC__/Js/jquery.cookie.js"></script><script src="__PUBLIC__/Js/underscore/underscore.js"></script><link href="__PUBLIC__/Style/style2.css" rel="stylesheet" type="text/css" /><script>        (function () {
            var scale = 1;
            document.querySelector('meta[name="viewport"]').setAttribute('content', 'initial-scale=' + scale + ',maximum-scale=' + scale + ',minimum-scale=' + scale + ',user-scalable=no');
            var deviceWidth = document.documentElement.clientWidth > 970 ? 970 : document.documentElement.clientWidth;
            document.documentElement.style.fontSize = (deviceWidth / 6.4) + 'px';
            window.onresize = _.debounce(function () {
                var deviceWidth = document.documentElement.clientWidth > 970 ? 970 : document.documentElement.clientWidth;
                document.documentElement.style.fontSize = (deviceWidth / 6.4) + 'px';
            }, 50);
        })();
        Date.prototype.Format = function (fmt) {
            var o = {
                "M+": this.getMonth() + 1, //月份
                "d+": this.getDate(), //日
                "h+": this.getHours(), //小时
                "m+": this.getMinutes(), //分
                "s+": this.getSeconds(), //秒
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度
                "S": this.getMilliseconds() //毫秒
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        }
    </script></head><body><div id="pagewrap" class="clearfix"><div ><img src="__PUBLIC__/Images/header_img.png" id="header_img"/></div><div class="nav_contain" id="nav1"><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>75));?>" class="href"></a><img src="__PUBLIC__/Images/message.png" class="nav_img"/><div class="nav_font" ><a name="message" id="message">宣讲通知</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('Recruit/index');?>" class="href"></a><img src="__PUBLIC__/Images/recruit.png" class="nav_img"><div class="nav_font" ><a  name="recruit" id="recruit">招聘启事</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>77));?>" class="href"></a><img src="__PUBLIC__/Images/employment.png" class="nav_img"><div class="nav_font" ><a  name="employment" id="employment">就业指导</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>78));?>" class="href"></a><img src="__PUBLIC__/Images/institution.png" class="nav_img"><div class="nav_font" ><a  name="institution" id="institution">机构简介</a></div></div></div></div><div class="nav_contain" id="nav2"><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('Record/index');?>" class="href"></a><img src="__PUBLIC__/Images/query.png" class="nav_img"><div class="nav_font" ><a  name="query" id="query">档案查询</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>79));?>" class="href"></a><img src="__PUBLIC__/Images/businessGuide.png" class="nav_img"><div class="nav_font" ><a  name="businessGuide" id="businessGuide">创业指导</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>80));?>" class="href"></a><img src="__PUBLIC__/Images/businessSituation.png" class="nav_img"><div class="nav_font" ><a  name="businessSituation" id="businessSituation">创业风云</a></div></div></div><div class="button_nav"><div class="button_navIn"><a href="<?php echo U('News/index',array('item'=>81));?>" class="href"></a><img src="__PUBLIC__/Images/helpInfo.png" class="nav_img"><div class="nav_font" ><a  name="helpInfo" id="helpInfo">帮助信息</a></div></div></div></div><div id="search"><div id="select_domain"><span id="sleBG_domain" class="sleBG"><span id="sleHid_domain" class="sleHid"><select id="domain"  name="type" class="recruit_select select"><option value='' style="color: #9c9c9c" selected>选择招聘领域</option><?php echo (buildselect($domain,0)); ?></select></span></span></div><div id="select_workPlace"><span id="sleBG_work" class="sleBG"><span id="sleHid_work" class="sleHid"><div  id="workPlace" data-id='0' name="workPlace" class="recruit_select select"><span id="workPlace_txt">选择工作地点</span><a id="workPlace_id" style="display: none"></a></div></span></span></div><div  id="search_submit"><a id="search_font">搜索职位</a></div></div><div id="region_picker"><a href="javascript:;" class="region_closer" title="cancel">×</a><div class="regions"></div></div><?php if($isLogin): ?><div id="stu_login"><span id="realName">欢迎:<?php echo ($realName); ?></span><a id="person_center" href="<?php echo U('Person/index');?>">个人中心</a><a id="login_out" href="<?php echo U('Public/logout');?>">注销</a></div><?php else: ?><div id="stu_login"><a href="<?php echo U('Public/login');?>" class="href"></a><img id="img_stuLogin" src="__PUBLIC__/Images/stu_login.png"/><div id="font_stuLogin"><a>学生用户登录</a></div></div><?php endif; ?><div id="scan_code"><img id="img_scanCode" src="__PUBLIC__/Images/scanCode.png"/></div></div><script>    $(function () {
        $("#search_submit").click(function () {
            window.location.href=window.location.protocol+'//'+window.location.host+'/webApp/Recruit/index/domain/'+$('#domain').val()+'/workPlace/'+$('#workPlace_id').text();
        })
    })
</script><script src="__PUBLIC__/Js/area.js"></script></body></html>