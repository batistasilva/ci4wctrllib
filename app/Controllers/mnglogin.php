<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
/**
 * Description of login
 *
 * @author batista
 */
class Mnglogin extends Controller {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    function index() {
        $this->view->title = 'OSSB Solutions - Autenticação de Usuários';
        //
        $this->view->render('mnglogin/index');
    }

    function runLogin() {
        //
        $result = $this->model->run();
        //
        if (isset($result)) {

            header('location: ' . URL . 'mnglogin');
        }
    }


    //put your code here
}
