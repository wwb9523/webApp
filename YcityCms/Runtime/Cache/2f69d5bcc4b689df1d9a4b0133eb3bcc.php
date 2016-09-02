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
    </script></head><body><div id="member_main"><div id="member_title"><img id="user_logo" src="__PUBLIC__/Images/user_logo.png"/><span id="memberName"><?php echo ($realName); ?></span><span id="member_words">已申请职位<a><?php echo (count($apply)); ?></a>个,收藏职位<a><?php echo (count($collect)); ?></a>个</span><a id="member_loginOut" href="<?php echo U('Public/logout');?>">退出登录</a></div><div id="member_navs"><div class="member_nav member_selected" id="link_apply"><div class="member_navIn member_border" ><div class="member_logo"><img id="member_logo1" src="__PUBLIC__/Images/apply.png"/></div><a >已申请职位</a></div></div><div class="member_nav member_unselected" id="link_collect"><div class="member_navIn member_border"  ><div class="member_logo"><img id="member_logo2" src="__PUBLIC__/Images/collect.png"/></div><a  >已收藏职位</a></div></div><div class="member_nav member_unselected" id="link_resume"><div class="member_navIn member_border" ><div class="member_logo"><img id="member_logo3" src="__PUBLIC__/Images/resume.png"/></div><a  >个人简历</a></div></div><div class="member_nav member_unselected" id="change_pwd"><div class="member_navIn"><div class="member_logo"><img id="member_logo4" src="__PUBLIC__/Images/change_pwd.png"/></div><a  >修改密码</a></div></div></div><div id="member_page"><div  id="member_apply" class="Page_selected"><div class="member_page_title"><span id="apply_title">已申请职位</span></div><div class="recruit_list member_recruit"><ul class="list_recruit" id="apply_list"><?php if(is_array($apply)): $i = 0; $__LIST__ = $apply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="row_recruit"><a href="<?php echo U('Recruit/detail',array('item'=>$row['id']));?>" class="href"></a><div class="recruit_left"><a class="job_title" ><?php echo ($row['job_title']); ?></a><span class="companyName" ><?php echo ($row['companyName']); ?></span><span class="education" ><?php echo ($row['education']); ?></span></div><div class="recruit_right"><span class="job_date"><?php echo (date('Y-m-d',$row['update_time'])); ?></span><span class="workPlace" ><?php echo ($row['workPlace']); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div><div  id="member_collect" class="Page_unselected" ><div class="member_page_title"><span id="collect_title">已收藏职位</span></div><div class="recruit_list member_recruit"><ul class="list_recruit" id="collect_list"><?php if(is_array($collect)): $i = 0; $__LIST__ = $collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="row_recruit"><a href="<?php echo U('Recruit/detail',array('item'=>$row['id']));?>" class="href"></a><div class="recruit_left"><a class="job_title" ><?php echo ($row['job_title']); ?></a><span class="companyName" ><?php echo ($row['companyName']); ?></span><span class="education" ><?php echo ($row['education']); ?></span></div><div class="recruit_right"><span class="job_date"><?php echo (date('Y-m-d',$row['update_time'])); ?></span><span class="workPlace" ><?php echo ($row['workPlace']); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div><div id="member_resume" class="Page_unselected"><div class="member_page_title resume_title"><span >基本资料</span></div><div id="resume_simply"><div class="resume_line1"><div id="resume_head_pic"><div id="resume_img"></div></div></div><div class="resume_line1"><div class="resume_line"><label>姓名</label><span><?php echo ($resume['realname']); ?></span></div><div  class="resume_line"><label >性别</label><?php if($resume['gender'] == 0): ?><span >女</span><?php else: ?><span >男</span><?php endif; ?></div><div  class="resume_line"><label>年龄</label><span><?php echo ($resume['age']); ?>岁</span></div></div><div class="clearfix"></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>民族</label><span><?php echo ($resume['nation']); ?></span></div></div><div class="child_flex1"><label>出生日期</label><span><?php echo (date('Y-m-d',$resume['birth_date'])); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>生源地</label><span><?php echo ($resume['native_place']); ?></span></div></div><div class="child_flex1"><label>政治面貌</label><span><?php echo ($resume['politics_status']); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>学号</label><span><?php echo ($resume['stu_number']); ?></span></div></div><div class="child_flex1"><label>学制</label><span><?php echo ($resume['length_schooling']); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>学历</label><span><?php echo ($resume['education']); ?></span></div></div><div class="child_flex1"><label>入学时间</label><span><?php echo (date('Y-m-d',$resume['entrance_date'])); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>毕业时间</label><span><?php echo (date('Y-m-d',$resume['graduate_date'])); ?></span></div></div><div class="child_flex1"><label>毕业院系</label><span><?php echo ($resume['faculty']); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>所学专业</label><span><?php echo ($resume['profession']); ?></span></div></div><div class="child_flex1"><label>培养方式</label><span><?php echo ($resume['mode']); ?></span></div></div><div  class="resume_line"><label>备注</label><span><?php echo ($resume['remark']); ?></span></div></div><div class="member_page_title resume_title"><span >个人能力及实习经历</span></div><div id="resume_internship"><?php if(is_array($resume['language'])): $i = 0; $__LIST__ = $resume['language'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>外语语种</label><span><?php echo ($item['language_type']); ?></span></div></div><div class="child_flex1"><label>外语水平</label><span><?php echo ($item['language_level']); ?></span></div></div><?php endforeach; endif; else: echo "" ;endif; ?><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>计算机能力</label><span><?php echo ($resume['computer_skill']); ?>级</span></div></div><div class="child_flex1"><label>普通话程度</label><span><?php echo ($resume['mandarin']); ?></span></div></div><div  class="resume_line"><label>实习经历</label><span><?php echo ($resume['internship']); ?></span></div><div  class="resume_line"><label>个人能力及荣誉</label><span><?php echo ($resume['honor']); ?></span></div><div  class="resume_line"><label>个人爱好及特长</label><span><?php echo ($resume['speciality']); ?></span></div></div><div class="member_page_title resume_title"><span >求职意向</span></div><div id="resume_intention"><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>求职类型</label><span><?php echo ($resume['job_type']); ?></span></div></div><div class="child_flex1"><label>期望月薪</label><span><?php echo ($resume['monthly_salary']); ?></span></div></div><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>期望从事职业</label><span><?php echo ($resume['jobs']); ?></span></div></div><div class="child_flex1"><label>期望工作地点</label><span><?php echo ($resume['work_place']); ?></span></div></div></div><div class="member_page_title resume_title"><span>联系方式</span></div><div id="resume_contact"><div  class="resume_line"><div class="child_flex1"><div class="resume_lineIn"><label>个人电子邮箱</label><span><?php echo ($resume['email']); ?></span></div></div><div class="child_flex1"><label>QQ</label><span><?php echo ($resume['QQ']); ?></span></div></div><div  class="resume_line"></div></div></div><div id="member_password" class="Page_unselected"><div class="member_psw"><input type="password"  class="member_pswIn"  id="password_old" name="password_old" placeholder="请输入旧密码"/></div><div class="member_psw"><input type="password" class="member_pswIn"  id="password_new" name="password_new" placeholder="请输入新密码"/></div><div class="member_psw"><input type="password"  class="member_pswIn" id="password_new2" name="password_new" placeholder="请再次输入新密码"/></div><span id="msg"></span><input type="button" id="member_submit" value="确认修改"/></div></div><div id="news_msg"></div></div><script>    $(document).ready(function() {
        var page=1;
        var nav=new Array();
        nav=[['link_apply','member_apply'],['link_collect','member_collect'],['link_resume','member_resume'],['change_pwd','member_password']];
        $('.member_nav').click(function () {
            $('#news_msg').text('');
            $('.member_selected').removeClass('member_selected');
            $(this).addClass('member_selected');
            for(var i=0;i<nav.length;i++){
                if(nav[i][0]==$(this).attr('id')){
                    $('#'+nav[i][1]).css('display','block');
                }
                else{
                    $('#'+nav[i][1]).css('display','none');
                }
            }
        });
        $('#member_submit').click(function () {
            if($('#password_new').val()!=$("#password_new2").val()){
                $("#msg").html('<span style="color:#FF0000">验证码错误</span>');
                return false;
            }
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('Person/doChangePwd');?>",
                    data: {
                        password_old: $('#password_old').val(), password_new: $('#password_new').val(), verifyCode: $('#verifyCode').val()
                    },
                    cache:false,
                    dataType:'json',
                    error:function(){
                        alert('error');
                    },
                    beforeSend: function () {
                        $("#login_submit").addClass("disable");
                        $("#login_submit").attr("disable", "disable");
                        $("#login_submit").attr("value", "正在提交...");
                    },
                    success: function (data) {
                        if (data.status == 0) {
                            switch (data.info) {
                                case 'emptyInfo':
                                    $("#msg").html('<span style="color:#FF0000">密码必须填写</span>');
                                    $("#login_submit").removeClass('disable');
                                    $("#login_submit").attr("value", "提交");
                                    break;
                                case 'usernameFalse':
                                    $("#msg").html('<span style="color:#FF0000">用户信息不存在，登录失败</span>');
                                    $("#login_submit").removeClass('disable');
                                    $("#login_submit").attr("value", "提交");
                                    break;
                                case 'passwordFalse':
                                    $("#msg").html('<span style="color:#FF0000">密码错误</span>');
                                    $("#login_submit").removeClass('disable');
                                    $("#login_submit").attr("value", "提交");
                                    break;
                                case 'roleFalse':
                                    $("#msg").html('<span style="color:#FF0000">当前用户被限制登录，请联系管理员</span>');
                                    $("#login_submit").removeClass('disable');
                                    $("#login_submit").attr("value", "提交");
                                    break;
                                case 'roleLost':
                                    $("#msg").html('<span style="color:#FF0000">不存在的用户组，请联系管理员</span>');
                                    $("#login_submit").removeClass('disable');
                                    $("#login_submit").attr("value", "提交");
                                    break;
                                default:
                                    $("#msg").html('<span style=" color:#FF0000">' + '未知错误，请联系管理员'+ '</span>');
                                    //alert('未知错误，请联系管理员');
                            }
                            return false;
                        }
                        else {
                           // $("#msg").html('<span style="color:#FF0000">修改密码成功</span>');
                            alert('密码修改成功');
                            location.reload();
                            return true;
                        }
                    }
                });
        });
        $(window).scroll(function() {
            var currentId=$('.member_selected').attr('id');
            var currentFunc;
            if(currentId=='link_apply')currentFunc='apply';
            else if(currentId=='link_collect')currentFunc='collect';
            else return;
            var scrollTop = $(this).scrollTop(),scrollHeight = $(document).height(),windowHeight = $(this).height();
            var positionValue = (scrollTop + windowHeight) - scrollHeight;
            var href="<?php echo U('Person/index');?>".replace(/(.*\/)(.*)/,"$1"+currentFunc);
            if (positionValue == 0) {
                $.ajax({
                    type:'post',
                    url:href+'?&p='+(page+1),
                    data:{ },
                    cache:false,
                    dataType:'json',
                    beforeSend:function () {
                        $("#news_msg").html('<b>正在请求数据,请稍等！</b>');
                    },
                    error:function(){
                        $("#news_msg").html('<b>数据请求失败,请稍后尝试~~</b>');
                    },
                    success:function(data){
                        if(data.status==1) {
                            data=data.data;
                            addData(data,currentFunc+'_list');
                            page = page + 1;
                        }
                        else{
                            switch (data.info) {
                                case 'No Data':
                                    $("#news_msg").html('<b>没有更多内容了o(╯□╰)o</b>');break;
                                default: alert('未知错误');
                            }
                        }
                    }
                })
            }
        });
        function addData(data,id) {
            for (i = 0; i < data.length; i++) {
                var date = new Date(data[i]['update_time'] * 1000).Format('yyyy-MM-dd');
                var href=window.location.href;
                var url=href.replace(/(.*\/)(.*)/,"$1detail")+'/item/'+data[i].id;
                var li = '<li class="row_recruit">' +
                        '<a class="href" href='+url+'></a>'
                        +'<div class="recruit_left"><a class="job_title" >'+data[i].job_title
                        +'</a><span class="companyName" >'+data[i].companyName
                        +'</span><span class="education" >'+data[i].education
                        +'</span></div><div class="recruit_right"><span class="job_date">'+date
                        +'</span><span class="workPlace" >'+data[i].workPlace
                        +'</span></div>';
                $("#"+id).append(li);
            }
        }
    })
</script></body></html>