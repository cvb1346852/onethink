<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6,0006
 * Time: 14:51
 */

namespace Admin\Controller;



class WuyeController extends AdminController
{
    /**
     * 频道列表
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $map  = array('status' => array('gt', -1));
        $count = D('Zushou')->where($map)->count();
        $page = new \Think\Page($count,2);
        $show = $page->show();
        $list = D('Zushou')->where($map)->limit($page->firstRow.','.$page->listRows)->select();

//        $list = $this->parseDocumentList($list);
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->meta_title = '物业管理';
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $Zushou = D('Zushou');
            $data = $Zushou->create();
//            var_dump($data);exit;
            if($data){
                $data['last_time'] = strtotime($data['last_time']);
                $id = $Zushou->add($data);

                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_zushou', 'zushou', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Zushou->getError());
            }
        } else {
            $this->assign('info',null);
            $this->meta_title = '新增导航';
            $this->display('edit');
        }
    }
    public function edit($id = 0){
        if(IS_POST){
            $Zushou = D('Zushou');
            $data = $Zushou->create();
            if($data){
                $data['last_time'] = strtotime($data['last_time']);
                if($Zushou->save($data)){
                    //记录行为
                    action_log('update_zushou', 'zushou', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Zushou->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Zushou')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }


            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            $this->display();
        }
    }
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id) );
        if(M('Zushou')->where($map)->delete()){
            //记录行为
            action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}