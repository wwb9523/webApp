<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php if(isset($contentDetail)): ?><?php echo ($contentDetail["title"]); ?>-<?php endif; ?><?php if(isset($moduleTitle)): ?><?php echo ($moduleTitle); ?>-<?php endif; ?><?php echo ($sysConfig["site_name"]); ?>-<?php echo ($sysConfig["seo_title"]); ?>-Powered by Y-city</title><meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,maximum-scale=1" /><script src="__PUBLIC__/Js/jquery-1.11.1.js"></script><script src="__PUBLIC__/Js/underscore/underscore.js"></script><link href="__PUBLIC__/Style/style2.css" rel="stylesheet" type="text/css" /><script>    var page=1;
    (function () {
        var scale=1;
        document.querySelector('meta[name="viewport"]').setAttribute('content','initial-scale='+scale+',maximum-scale='+scale+',minimum-scale='+scale+',user-scalable=no');
        var deviceWidth=document.documentElement.clientWidth>970?970:document.documentElement.clientWidth;
        document.documentElement.style.fontSize=(deviceWidth/6.4)+'px';
        window.onresize= _.debounce(function () {
            var deviceWidth=document.documentElement.clientWidth>970?970:document.documentElement.clientWidth;
            document.documentElement.style.fontSize=(deviceWidth/6.4)+'px';
        },50);
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop(),scrollHeight = $(document).height(),windowHeight = $(this).height();
            var positionValue = (scrollTop + windowHeight) - scrollHeight;
            if (positionValue == 0) {
              //  var href="<?php echo U('Index/index');?>";
                $.ajax({
                    type:'post',
                    url:window.location.href+'?&p='+(page+1),
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
                            for (i = 0; i < data.length; i++) {
                                var date = new Date(data[i]['create_time'] * 1000).toLocaleDateString().replace(/[\/]/gm, "-");     //YYYY-M-D
                                date = date.replace(/-(\d)-(\d)/gm, "-0$1-0$2");     //YYYY-MM-DD
                                var li = '<li class="row_news">' + '<a class="news_title">' + data[i].title + "</a><span class='news_date'>" + date + '</span></li>';
                                $("#list_news").append(li);
                            }
                            page = page + 1;
                        }
                        else{
                            switch (data.info) {
                                case 'No Data':
                                    $("#news_msg").html('<b>没有更多内容了o(╯□╰)o</b>');
                                    break;
                                default: alert('未知错误');
                            }
                        }
                    }
                })
            }
        });
    })();
</script></head><body><div id="pagewrap" class="clearfix"><div id="list_content"><ul id="list_news"><?php if(is_array($dataContentList)): $i = 0; $__LIST__ = $dataContentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="row_news"><a class="news_title" href="<?php echo U('News/detail',array('item'=>$row['id']));?>"><?php echo ($row['title']); ?></a><span class="news_date"><?php echo (date('Y-m-d',$row['create_time'])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div><div id="news_msg"></div></div></body></html>