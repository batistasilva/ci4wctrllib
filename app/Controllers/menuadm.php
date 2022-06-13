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
 * Description of menuadm
 *
 * @author batista
 */
class MenuAdm  extends Controller {
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }
    
    //
    public function mgrp() {
        $this->view->title = 'Sistema Contabil - Menu Administrativo - Grupos';
        $this->view->smsg = $this->smsg;
        //$this->view->RolesList = $this->model->getRolesToTable();
        //
        $this->view->render('header');
        $this->view->render('menuadm/adm_group');//Menu Administractiv Group
        $this->view->render('footer');
    }    
}
