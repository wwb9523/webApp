/**
 * Created by APTX on 2016/8/25.
 */
$(function () {
    $(document).on("click",".region_li",function(){
        var data_id=$(this).attr('data-id');
        $(this).closest('.region_list').children('li').removeClass('region_selected');
        $(this).addClass('region_selected');
        getArea(data_id);
        showArea();
    });

    $('.region_closer').click(function () {
        $("#region_picker").css('display','none');
    });
    $('#workPlace').click(function () {
        var data_id=$(this).attr('data-id');
        getArea(data_id);
        $("#region_picker").css('display','block');
    });

    function showArea() {
        var txt=new Array();
        var ids=new Array();
        $('.region_selected').each(function () {
            txt.push($(this).text());
            ids.push($(this).attr('data-id'));
        });
        $("#workPlace_txt").text(txt[txt.length-1]);
        $("#workPlace_id").text(ids[ids.length-1]);
    }

    function getArea(data_id) {
        var href=window.location.protocol+'//'+window.location.host+'/webApp/Public/getArea';
        //   var href='http://localhost/webApp/Public/getArea';
        var regions=$(".regions");
        $.ajax({
            type:'post',
            url:href,
            data:{id:data_id},
            cache:false,
            //  async: false,
            dataType:'json',
            error:function(){
                alert('error');
            },
            success:function(data){
                if(data.status==1){
                    var content=data.data;
                    if(data.info=='1'){
                        regions.children('ul').remove();
                        addArea('area_prov',content);
                    }else if(data.info=='2'){
                        regions.children('#area_city').remove();
                        regions.children('#area_district').remove();
                        addArea('area_city',content);
                    }else if(data.info=='3'){
                        regions.children('#area_district').remove();
                        addArea('area_district',content);
                    }else{
                        alert('未知错误!!');
                    }
                }else{

                }
            }
        })
    }

    function addArea(nodeId,data) {
        var ul='<ul class="region_list" id="'+nodeId+'"> </ul>';
        $(".regions").append(ul);
        var node=$('#'+nodeId);
        var li;
        for(var i=0;i<data.length;i++){
            li='<li class="region_li" data-id="'+data[i]['id']+ '">'+ data[i]['title']+'</li>';
            node.append(li);
        }
    }

    
});
