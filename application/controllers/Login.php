<?php
/**
 * Created by PhpStorm.
 * User: lemo
 * Date: 17-5-4
 * Time: 下午12:23
 */
class LoginController extends Yaf_Controller_Abstract {

    /**
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     */
    public function loginAction() {

        $phoneNumber = $this->getRequest()->getPost("phoneNumber");
        $password = $this->getRequest()->getPost("password");

        $loginModel = new LoginModel();
        $userName = $loginModel->getUserNameByPhoneAndPwd($phoneNumber, $password);

        if (empty($userName)) {
            $this->getView()->display("home/home.phtml");
        } else {
            $this->getView()->assign("userName", $userName);
            $this->getView()->display("menu/menu.phtml");
        }
        return FALSE;
    }
}