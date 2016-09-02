<?php
/**
 * 
 * 新闻
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class NewsAction extends HomeAction
{
    public $dao,$category,$id,$type,$parentId;
    function _initialize()
    {
        parent::_initialize();
        if(!isset($_GET['item'])){parent::_empty();exit(404);}
    }
    
    /**
     * 列表
     *
     */
    public function index()
    {
        $this->type = intval($_GET['item']);
        $row=M('Category')->where("id={$this->type}")->field('id,title,parent_id')->select();
        if(!$row){
            $this->error('记录不存在!!!');
        }
        $condition['a.category_id']=array('eq',$this->type);
        $data=parent::getJustList($condition, 'a.id DESC', 10, C('DB_PREFIX').'news a', C('DB_PREFIX').'category b on a.category_id=b.id','a.*,b.parent_id');
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            if(is_array($data)){
                $Info='success';
                $status=1;
            }
            else{
                $Info='No Data';
                $status=0;
            }
            $this->ajaxReturn($data, $Info,$status);
        }
        else {
            $this->assign('dataContentList', $data);
            $this->display();
        }
    }
    
    public function detail(){
        $this->dao=D("News");
        $titleId = intval($_GET['item']);
        parent::getJoinDetail(array("a.id={$titleId}", "id={$titleId}"), 'view_count', C('DB_PREFIX').'news a', C('DB_PREFIX').'category b on a.category_id=b.id','a.*, b.id as categoryId,b.title as categoryName');/* b.title as categoryName 调用当前分类名称 */
    }
    
}