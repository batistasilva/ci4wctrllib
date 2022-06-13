<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'util/Tools.php';

/**
 * Description of contact
 *
 * @author batista
 */
class Contact extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        //echo 'Bem vindo ao (Index Controle) do Contact!!!';
        $this->view->title = 'OSSB Solutions - Formulário de Contato';
        $this->view->render('header');
        $this->view->render('contact/index');
        $this->view->render('footer');
    }

    function datasend() {
        //
        $tools = new Tools();
        //
        // echo 'Enviando dados do form para e-mail!!!';
// Passando os dados obtidos pelo formulário para as variáveis abaixo
        $nomeremetente  = $tools->clean_input($_POST['name']);
        $emailremetente = $tools->clean_input($_POST['email']);
        $emaildestinatario = 'ti@lseguranca.com.br'; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
        $telefone       = $tools->clean_input($_POST['telphone']);
        $assunto        = 'Solicitação de Informação pelo Site';
        $mensagem       = $tools->clean_input($_POST['message']);


        /* Montando a mensagem a ser enviada no corpo do e-mail. */
        $mensagemHTML = '<P>Formulário preenchido em www.lseguranca.com.br</P>
<p><b>Nome:</b> ' . $nomeremetente . '
<p><b>E-Mail:</b> ' . $emailremetente . '
<p><b>Telefone:</b> ' . $telefone . '
<p><b>Assunto:</b> ' . $assunto . '
<p><b>Mensagem:</b> ' . $mensagem . '</p>
<hr>';


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
        $headers = "MIME-Version: 1.1\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $nomeremetente\r\n"; // remetente
        $headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
        $enviado = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

        $this->view->render('header');
        $this->view->render('contact/sentokay');
        $this->view->render('footer');
    }
    //put your code here
}
