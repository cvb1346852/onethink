<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7,0007
 * Time: 16:53
 */

namespace Wechat\Controller;


class ZushouController extends WechatController
{
    public function index(){

        $rents = M('Zushou')->where('type=1')->select();
        $sells = M('Zushou')->where('type=0')->select();
        $this->assign('rents',$rents);
        $this->assign('sells',$sells);
        $this->display();
    }
   /* public function __construct(){
        parent::__construct();
        $this->login();
    }*/

}