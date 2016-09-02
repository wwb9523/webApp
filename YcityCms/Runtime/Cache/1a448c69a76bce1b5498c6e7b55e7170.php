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
    </script></head><body><script type="text/javascript" >    $(function(){
        $("#login_submit").click(function(){
            var jumpUri = $("#jumpUri").val();
            $.ajax({
                type: "POST",
                url: "<?php echo U('Public/doLogin');?>",
                data: {
                    username: $('#username').val(), password: $('#password').val(), verifyCode: $('#verifyCode').val()
                },
                cache:false,
                dataType:'json',
                error:function(){
                    alert('error');
                },
                beforeSend: function () {
                    $("#login_submit").addClass("disable");
                    $("#login_submit").attr("disable", "disable");
                    $("#login_submit").attr("value", "正在登录...");
                },
                success: function (data) {
                    if (data.status == 0) {
                        switch (data.info) {
                            case 'errorVerifyCode':
                                //$("#verifyImage").attr('src', "<?php echo U('Public/verify',0,0,0);?>?"+ Math.random());
                                resetVerifyCode();
                                $("#msg").html('<span style="color:#FF0000">验证码错误</span>');
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                break;
                            case 'emptyInfo':
                                $("#msg").html('<span style="color:#FF0000">用户名密码必须填写</span>');
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                break;
                            case 'usernameFalse':
                                $("#msg").html('<span style="color:#FF0000">用户信息不存在，登录失败</span>');
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                resetVerifyCode();
                                break;
                            case 'passwordFalse':
                                $("#msg").html('<span style="color:#FF0000">密码错误</span>');
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                resetVerifyCode();
                                break;
                            case 'roleFalse':
                                $("#msg").html('<span style="color:#FF0000">当前用户被限制登录，请联系管理员</span>');
                                resetVerifyCode();
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                break;
                            case 'roleLost':
                                $("#msg").html('<span style="color:#FF0000">不存在的用户组，请联系管理员</span>');
                                resetVerifyCode();
                                $("#login_submit").removeClass('disable');
                                $("#login_submit").attr("value", "登录");
                                break;
                            default:
                                $("#msg").html('<span style=" color:#FF0000">' + data + '</span>');
                                alert('未知错误，请联系管理员');
                        }
                        return false;
                    }
                    else {
                        $("#msg").html('<span style="color:#FF0000">登录成功</span>');
                        window.location.href = '<?php echo U("Index/index");?>';
                        return true;
                    }
                }
            });
        });
        $("#verifyImage").click(function(){
            resetVerifyCode();
        })
    });

    function resetVerifyCode()
    {
        $("#verifyImage").attr('src', "<?php echo U('Public/verify',0,0,0);?>");
    }

</script><div id="login_wrap"><div id="logo_login"><img id="login_logo" src="__PUBLIC__/Images/login_logo.png"></div><div id="loginTitle"><span id="login_title">创·就业信息网系统平台登录</span></div><div id="login_form"><div id="login_input"><input style="display:none" type="text" id="aaa" class="hidden"/><input type="password" name="password1"  id="password1" class="hidden"/><div class="login_line"><div class="login_label"><img class="login_labelImg" src="__PUBLIC__/Images/login_pic1.png"/></div><input type="text" name="username" id="username" autocomplete="off" placeholder="请输入用户名" value=""/></div><div class="login_line"><div class="login_label"><img class="login_labelImg" src="__PUBLIC__/Images/login_pic2.png"/></div><input class="password" type="password" name="password" placeholder="请输入密码" id="password" /></div><div class="verifyCode"><div class="login_label"><img class="login_labelImg" src="__PUBLIC__/Images/login_pic3.png"/></div><input type="text" name="verifyCode" id="verifyCode" placeholder="请输入验证码" size="8" maxlength="4" /><img src="<?php echo U('Public/verify');?>" align="absmiddle" class="checkcode"  id="verifyImage"/></div></div><div id="msg"></div><div id="forgetPwd" onclick=""><span id="forget_pwd">忘记密码 ?</span></div><input type="submit" value="登&nbsp;录" id="login_submit" class="submit"><input name="jumpUri" type="hidden" id="jumpUri" value="<?php echo ($jumpUri); ?>" /></div></div></body></html>