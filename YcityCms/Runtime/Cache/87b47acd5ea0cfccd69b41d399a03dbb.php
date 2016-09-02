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
    </script></head><body><script>    var page=1;

    function addData(data) {
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
            $("#list_recruit").append(li);
        }
    }

    function clearData() {
        $("#list_recruit").children('li').remove();
    }
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop(),scrollHeight = $(document).height(),windowHeight = $(this).height();
            var positionValue = (scrollTop + windowHeight) - scrollHeight;
            if (positionValue == 0) {
                var href="<?php echo U('Recruit/search');?>";
                $.ajax({
                    type:'post',
                   // url:window.location.protocol+'//'+window.location.host+'/webApp/Recruit/search'+'?&p='+(page+1),
                    url:href+'?&p='+(page+1),
                    data:{domain:$.cookie('domain'),workPlace:$.cookie('workPlace')},
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
                            addData(data);
                            page = page + 1;
                        }
                        else{
                            switch (data.info) {
                                case 'No Data':
                                    $("#news_msg").html('<b>没有更多内容了o(╯□╰)o</b>');break;
                                default: alert('未知错误,请于管理员联系');
                            }
                        }
                    }
                })
            }
        });
    
    function changeData() {
        page=1;
        clearData();
        $.cookie('domain',$("#domain").val());
        $.cookie('workPlace',$("#workPlace_id").text());
        $.ajax({
            type:'post',
            url:window.location.protocol+'//'+window.location.host+'/webApp/Recruit/search'+'?&p='+(page+1),
            data:{domain:$.cookie('domain'),workPlace:$.cookie('workPlace')},
            cache:false,
            dataType:'json',
            error:function () {
                $("#news_msg").html('<b>数据请求失败,请稍后尝试~~</b>');
            },
            success:function (data) {
                if(data.status==1) {
                    data=data.data;
                    addData(data);
                }
                else{
                    switch (data.info) {
                        case 'No Data':
                            $("#news_msg").html('<b>没有更多内容了o(╯□╰)o</b>');break;
                        default: $("#news_msg").html('<b>发生未知错误,请于管理员联系</b>');
                    }
                }
            }
        })
    }
    $(function () {
        $(window).bind('beforeunload',function(){
            $.cookie('domain',null);
            $.cookie('workPlace',null);
        });
    });

</script><script src="__PUBLIC__/Js/area.js"></script></head><body><div id="search"><div id="select_domain"><span id="sleBG_domain" class="sleBG"><span id="sleHid_domain" class="sleHid"><select id="domain"  name="type" class="recruit_select select"><option value='' style="color: #9c9c9c" selected>选择招聘领域</option><?php echo (buildselect($domain,0)); ?></select></span></span></div><div id="select_workPlace"><span id="sleBG_work" class="sleBG"><span id="sleHid_work" class="sleHid"><div  data-id="0" id="workPlace" name="workPlace" class="recruit_select select"><span id="workPlace_txt">选择工作地点</span><a id="workPlace_id" style="display: none"></a></div></span></span></div><div  onclick="changeData()" id="search_submit"><a id="search_font">搜索职位</a></div></div><div id="region_picker"><a href="javascript:;" class="region_closer" title="cancel">×</a><div class="regions"></div></div><div id="pagewrap" class="clearfix"><div id="recruit_list"><ul id="list_recruit"><?php if(is_array($dataContentList)): $i = 0; $__LIST__ = $dataContentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="row_recruit"><a href="<?php echo U('Recruit/detail',array('item'=>$row['id']));?>" class="href"></a><div class="recruit_left"><a class="job_title" ><?php echo ($row['job_title']); ?></a><span class="companyName" ><?php echo ($row['companyName']); ?></span><span class="education" ><?php echo ($row['education']); ?></span></div><div class="recruit_right"><span class="job_date"><?php echo (date('Y-m-d',$row['update_time'])); ?></span><span class="workPlace" ><?php echo ($row['workPlace']); ?></span></div></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div><div id="news_msg"></div></body></html>