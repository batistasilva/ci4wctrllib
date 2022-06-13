<?php

require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/UrlsPage.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mngurls
 *
 * @author sistema
 */
class MngUrls extends Controller {

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    //
    public function index() {
        $this->view->title = 'OSSB Solutions - Administração de Páginas';
        $this->view->UrlsList = $this->model->getUrlToTable();
        //Class to be user for finish object session
        $this->view->smsg         = $this->smsg;        
        //
        $this->view->render('header');
        $this->view->render('mngurl/index');
        $this->view->render('footer');
    }

    //
    public function addurl() {
        $this->view->title = 'OSSB Solutions - Administração de Páginas';
        //
        $this->view->render('header');
        $this->view->render('mngurl/addurl');
        $this->view->render('footer');
    }

    //
    public function editurl($url_id) {
        $this->view->title = 'OSSB Solutions - Administração de Páginas';
        $this->view->url   = $this->model->getAppUrl($url_id);

       /*  $url = $this->model->getAppUrl($url_id);
          print "<pre>";
          print_r($url);
          print "</pre>";
          exit(); */
        //
        $this->view->render('header');
        $this->view->render('mngurl/editurl');
        $this->view->render('footer');
    }

    /**
     * Method to Save a new url page
     * to database..
     */
    public function addSave() {
        $tools = new Tools();
        //
        $vurl_page = $tools->clean_input_url($_POST['page']);
        $vapp_name = $tools->clean_input_date($_POST['app_name']);
        $vnote = $tools->clean_input_date($_POST['note']);
        //
        $url = new UrlsPage();
        //
        //Get UrlPage with next id to add..
        $url = $this->model->getUrlID();
        //
        //$vurl_page = URL . $vurl_page;//Url with full path to application

        $url->setPage($vurl_page);
        $url->setApp_name($vapp_name);
        $url->setNote($vnote);
        $url->setDate_create(''); //String empty to new date time
        //
        $result = $this->model->AddAppUrl($url);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngurls');
            $this->smsg->setMsg("Erro na Inclusão: addSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/addurl');
            exit();
        } else {
            //
            $this->smsg->setApp('mgnurls');
            $this->smsg->setMsg("Página Cadastrada com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/addurl');
            exit();
        }
    }

    /**
     * Method to Save Edit to Url Page
     * to database..
     */
    public function editSave($url_id) {
        $tools = new Tools();
        //
        $vurl_page = $tools->clean_input_url($_POST['page']);
        $vapp_name = $tools->clean_input_date($_POST['app_name']);
        $vnote = $tools->clean_input_date($_POST['note']);
        //
        $url = new UrlsPage();
        //
        $url->setUrl_id($url_id);
        $url->setPage($vurl_page);
        $url->setApp_name($vapp_name);
        $url->setNote($vnote);
        $url->setDate_change(''); //String empty to new date time
        //
        /*print "<pre>";
        print_r($url);
        print "</pre>";
        exit();*/

        $result = $this->model->EditAppUrl($url);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngurls');
            $this->smsg->setMsg("Erro na Alteração da Aplicação: editSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/editurl/' . $url_id);
            exit();
        } else {
            //
            $this->smsg->setApp('mgnurls');
            $this->smsg->setMsg("Aplicação Alterada com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/index');
            exit();
        }
    }
    
    /**
     * Method to remove Aplication
     * Page from database.
     * @param type $url_id
     */
    public function rmApp($url_id){
        //
        $result = $this->model->DeleteAppUrl($url_id);
        //
        if ($result !== 'Okay') {
            $this->smsg->setApp('mngurls');
            $this->smsg->setMsg("Erro na Exclusão da Aplicação: deleteApp(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/index');
            exit();
        } else {
            //
            $this->smsg->setApp('mgnurls');
            $this->smsg->setMsg("Aplicação Excluída com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngurls/index');
            exit();
        }        
    }

}
