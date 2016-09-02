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
    </script></head><body><div id="title_select"><a id="link_recruit" class="link_selected" onclick="setSelect('link_recruit','recruit_page','link_company','company_page')">职业信息</a><a id="link_company" class="link_unSelected" onclick="setSelect('link_company','company_page','link_recruit','recruit_page')">公司信息</a></div><div id="recruit_page"><div id="recruit_simple"><div id="recruit_line1"><span id="job_title"><?php echo ($contentDetail['job_title']); ?></span><span id="company_name"><?php echo ($contentDetail['name']); ?></span></div><div  class="recruit_line"><div class="child_flex1"><div class="clearfix recruit_line_out"><span class="form">雇佣形式</span><a class="form_content"><?php echo ($contentDetail['form']); ?></a></div></div><div  class="child_flex1"><span >工作地点</span><a><?php if(is_array($contentDetail['workPlace'])): $i = 0; $__LIST__ = $contentDetail['workPlace'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><?php echo ($row['title']); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?></a></div></div><div  class="recruit_line"><div class="child_flex1"><div class="recruit_line_out"><span>职位类别</span><a><?php echo ($contentDetail['type']); ?></a></div></div><div class="child_flex1"><span >薪资待遇</span><a ><?php echo ($contentDetail['salary']); ?></a></div></div><div  class="recruit_line"><div class="child_flex1"><div class="recruit_line_out"><span>招聘人数</span><a><?php echo ($contentDetail['count']); ?></a></div></div><div class="child_flex1"><span >最低学历</span><a ><?php echo ($contentDetail['education']); ?></a></div></div><div  class="recruit_line"><div class="child_flex1"><div class="recruit_line_out"><span>外语水平</span><a><?php echo ($contentDetail['foreign_language']); ?></a></div></div><div class="child_flex1"><span >计算机水平</span><a ><?php echo ($contentDetail['computer_skill']); ?></a></div></div><div  class="recruit_line"><div class="child_flex1"><div class="recruit_line_out"><span>更新日期</span><a><?php echo (date('Y-m-d',$contentDetail['update_time'])); ?></a></div></div><div class="child_flex1"><span >查看次数</span><a ><?php echo ($contentDetail['view_count']); ?></a></div></div></div><div id="recruit_detail"><div class="detail_wrap"><span class="detail_label">职位描述</span><div class="details_content"><?php echo ($contentDetail['description']); ?></div></div><div class="detail_wrap"><span class="detail_label">任职条件</span><div class="details_content"><?php echo ($contentDetail['condition']); ?></div></div></div><div id="contact_way"><span class="detail_label">联系方式</span><div id="contact_content"><div class="contact_line"><label class="contact_label">所在城市：</label><span ><?php echo ($contentDetail['city']); ?></span></div><div class="contact_line"><label class="contact_label">公司地址：</label><span ><?php echo ($contentDetail['address']); ?></span></div><div class="contact_line"><label class="contact_label">邮政编码：</label><span><?php echo ($contentDetail['postcode']); ?></span></div><div class="contact_line"><label class="contact_label">公司网址：</label><span><?php echo ($contentDetail['website']); ?></span></div><div class="contact_line"><label class="contact_label">联系人：</label><span><?php echo ($contentDetail['contacts']); ?></span></div><div class="contact_line"><label class="contact_label">联系电话：</label><span><?php echo ($contentDetail['phone']); ?></span></div><div class="contact_line"><label class="contact_label">联系传真：</label><span><?php echo ($contentDetail['fax']); ?></span></div><div class="contact_line"><label class="contact_label">电子邮件：</label><span><?php echo ($contentDetail['email']); ?></span></div></div></div><a id="recruit_id" style="display: none"><?php echo ($contentDetail['id']); ?></a></div ><div id="company_page"><div id="company_simply"><div class="company_line1"><span id="company"><?php echo ($contentDetail['name']); ?></span></div><div class="company_line"><div class="child_flex1"><div class="clearfix recruit_line_out"><label >公司性质</label><span><?php echo ($contentDetail['nature']); ?></span></div></div><div class="child_flex1"><div class="clearfix recruit_line_out"><label >公司规模</label><span><?php echo ($contentDetail['scale']); ?>人</span></div></div></div></div><div id="company_detail"><label class='detail_label'>公司简介</label><span><?php echo ($contentDetail['companyIntro']); ?></span></div></div><div id="news_msg"></div><div id="recruit_footer"><div id="recruit_footerIn"><input  type="button" id="apply" data-name="apply" class="recruit_button" value="申请职位" /><input type="button" id="collect" data-name="collect" class="recruit_button" value="收藏职位" /></div></div><script>    $(function () {
       $('.recruit_button').click(function () {
          var mode=$(this).attr('data-name');
           var href="<?php echo U('Person/doRecruit');?>";
           var text=$(this).val();
           var id=$('#recruit_id').text();
           $.ajax({
               type:'post',
               url:href,
               data:{mode:mode,recruitId:id},
               cache:false,
               dataType:'json',
               error:function(){
                   alert('未知错误,请于管理员联系');
               },
               success:function(data){
                   if(data.status==1){
                       alert(text+'成功!');
                   }else{
                       switch(data.info){
                        //   case 'existed data':alert('您已经收藏过该信息了');break;
                           case 'error mode' : alert('模块错误,请于管理员联系');break;
                           case  'Add False' : alert('操作失败,请稍后尝试');break;
                           default:alert('未知错误,请于管理员联系');
                       }
                   }
               }
           })
       });
    });
    function setSelect(selectId,showPage,unSelectId,hidePage) {
        $('#' + selectId).removeClass().addClass('link_selected');
        $('#' + unSelectId).removeClass().addClass('link_unSelected');
        $('#'+showPage).css('display','block');
        $('#'+hidePage).css('display','none');
    }
</script></body></html>