<?php
/**
 * Created by PhpStorm.
 * User: lemo
 * Date: 17-5-4
 * Time: 下午3:42
 */
class MessageController extends Yaf_Controller_Abstract {

    /**
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     */
    public function addMessageAction() {
        $param = $this->getRequest()->getParams();
        $this->getView()->assign("userName", $param["userName"]);
        $this->getView()->display("message/addMessage.phtml");
        return FALSE;
    }

    public function updateMessageAction() {

        $param = $this->getRequest()->getParams();
        $this->getView()->assign("userName", $param["userName"]);
        $messageId = $this->getRequest()->getPost("messageId");

        $messageModel = new MessageModel();
        $messageInfo = $messageModel->getMessageInfoById($messageId);

        if (empty($messageInfo)) {
            $this->getView()->display("error/error.phtml");
        } else {
            $this->getView()->assign("messageId", $messageId);
            $this->getView()->assign("messageInfo", $messageInfo);
            $this->getView()->display("message/updateMessage.phtml");
        }
        return FALSE;
    }

    public function selectMessageAction() {
        $param = $this->getRequest()->getParams();
        $this->getView()->assign("userName", $param["userName"]);
        $this->getView()->display("message/selectMessage.phtml");
        return FALSE;
    }

    public function menuAction() {
        $param = $this->getRequest()->getParams();
        $this->getView()->assign("userName", $param["userName"]);
        $this->getView()->display("menu/menu.phtml");
        return FALSE;
    }

    public function submitAddMessageAction() {
        $messageTitle = $this->getRequest()->getPost("messageTitle");
        $coverPic = $this->getRequest()->getPost("coverPic");
        $authorName = $this->getRequest()->getPost("authorName");
        $authorImg = $this->getRequest()->getPost("authorImg");
        $tagId = $this->getRequest()->getPost("tagId");
        $messageContent = $this->getRequest()->getPost("messageContent");

        $messageModel = new MessageModel();
        $res = $messageModel->addMessage($messageTitle, $coverPic, $authorName, $authorImg, $tagId, $messageContent);
        $param = $this->getRequest()->getParams();
        $this->getView()->assign("userName", $param["userName"]);
        if (empty($res)) {
            $this->getView()->display("error/error.phtml");
        } else {
            $this->getView()->display("menu/menu.phtml");
        }
        return FALSE;
    }

    public function submitUpdateMessageAction() {
        $messageTitle = $this->getRequest()->getPost("messageTitle");
        $coverPic = $this->getRequest()->getPost("coverPic");
        $authorName = $this->getRequest()->getPost("authorName");
        $authorImg = $this->getRequest()->getPost("authorImg");
        $tagId = $this->getRequest()->getPost("tagId");
        $weight = $this->getRequest()->getPost("weight");
        $messageContent = $this->getRequest()->getPost("messageContent");

        $param = $this->getRequest()->getParams();
        $messageId = $param["messageId"];

        $messageModel = new MessageModel();
        $res = $messageModel->updateMessage($messageTitle, $coverPic, $authorName, $authorImg, $tagId, $messageContent, $weight, $messageId);

        $this->getView()->assign("userName", $param["userName"]);
        if (empty($res)) {
            $this->getView()->display("error/error.phtml");
        } else {
            $this->getView()->display("menu/menu.phtml");
        }
        return FALSE;
    }

}