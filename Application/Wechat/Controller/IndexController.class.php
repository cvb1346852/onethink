<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wechat\Controller;
use OT\DataDictionary;
use Wechat\Controller\WechatController;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends WechatController {


    public function index(){
        $this->display();
    }
    public function article($p = 1){
        $id = I('get.id');
        $size = 1;
        $start = ($p-1)*$size;
        $list = M('Document as d')->join('__PICTURE__ as p ON d.cover_id = p.id')->field('d.*,p.path')->where('category_id='.$id)->limit($start,$size)->select();
        foreach ($list as &$v){
            $v['time'] = date('Y-m-d H:i',$v['create_time']);
        }
        if (IS_AJAX){
            $this->ajaxReturn($list);
        }else{
            $this->assign('list',$list);
//        var_dump($list);exit;
            $this->display();
        }
    }
    public function articleContent(){
        $id = I('get.id');
//        var_dump($id);exit;
        M('Document')->where('id='.$id)->setInc('view');
        $model = M('Document as d')->join('__PICTURE__ as p ON d.cover_id = p.id')->join('__DOCUMENT_ARTICLE__ as a ON d.id = a.id')->field('d.*,p.path,a.content')->where('d.id='.$id)->find();
        $this->assign('model',$model);
        var_dump($model);exit;
        $this->display();
    }
    public function articleDetail(){

    }
   public function my(){
//        var_dump($_SERVER['HTTP_REFERER']);exit;
       $this->login();
       /*if (!is_login()){
           $this->login();
       }*/
        $this->display();
   }

}