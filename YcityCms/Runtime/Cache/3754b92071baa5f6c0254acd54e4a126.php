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
    </script></head><body><div id="form_record" class="NoneBg"><div id="select_graduate" class="record_select_out"><span id="sleBG_graduate" class="sleBG"><span id="sleHid_graduate" class="sleHid"><select id="graduate" class="record_select select" name="graduate"><option value="" style="color: #9c9c9c" disabled selected>选择毕业年限</option></select></span></span></div><div id="select_certificate" class="record_select_out"><span id="sleBG_certificate" class="sleBG"><span id="sleHid_certificate" class="sleHid"><select id="certificate" class="record_select select" name="certificate"><option value="" style="color: #9c9c9c" disabled selected>选择证件类型</option><?php if(is_array($certificate)): $i = 0; $__LIST__ = $certificate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><option value="<?php echo ($row['id']); ?>"><?php echo ($row['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></span></span></div><div id="certificate_num_out"><input id="certificate_num" name="certificate_num"  placeholder="请输入证件号码"/></div><label id="errorMsg"></label><input type="submit" value="确认查询" id="record_submit"/></div><span id="record_notice"><?php echo ($notice['content']); ?></span><script language="javascript" type="text/javascript">    window.onload=function(){
        var myDate= new Date();
        var startYear=myDate.getFullYear()-20;
        var endYear=myDate.getFullYear()+2;//结束年份
        var obj=document.getElementById('graduate');
        for (var i=endYear;i>startYear;i--)
        {
            obj.options.add(new Option(i,i));
        }
    };
    $("#record_submit").click(function () {
        var _graduate=$("#graduate").val();
        var _certificate=$("#certificate").val();
        var _certificate_num=$("#certificate_num").val();
        if(_graduate==undefined)$("#errorMsg").text('毕业年限未选择!');
        else if(_certificate==undefined)$("#errorMsg").text('证件类型未选择!');
        else if(_certificate_num==undefined)$("#errorMsg").text('证件号码未填写!');
        else{
            var search="<?php echo U('Record/search');?>";           //修改url:  host/action/index.html => host/action/search
            var detail=search.replace(/(.*\/)(.*)/,"$1detail");
            $.ajax({
                type: 'post',
                url: search,
                data:{ graduate:_graduate , certificate:_certificate,certificate_num:_certificate_num},
                cache:false,
                dataType:'json',
                beforeSend:function () {
                    $("#errorMsg").html('<b>正在请求数据,请稍等！</b>');
                },
                error:function(){
                    $("#errorMsg").html('<b>数据请求失败,请稍后尝试~~</b>');
                },
                success:function(data) {
                    if(data.status==0){
                        $("#errorMsg").html('<b>没有相应记录</b>');
                    }
                    else{
                        window.location.href=detail+'/item/'+data.data['id'];
                    }
                }
            })
        }
    })
</script></body></html>