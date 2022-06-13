<?php

class Error extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->title = 'OSSB Solutions - Erro 404';
        $this->view->msg = 'Página não encontrada, por favor entre em contato com à Administração do Sistema!';
       
        $this->view->render('header');
        $this->view->render('error/index');
        $this->view->render('footer');        
    }

}
