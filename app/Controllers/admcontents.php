<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author batista
 */
class Admroom extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'OSSB Solutions - Cadastro de Conteudos';
        $this->view->roomsList = $this->model->roomsList();

        $this->view->render('header');
        $this->view->render('admcontents/index');
        $this->view->render('footer');
    }

    public function create()
    {
        Session::init();

        $vdescrip = $this->clean_input($_POST['descrip']);
        $vbedstype = $this->clean_input($_POST['typebeds']);
        $vcosttype = $this->clean_input($_POST['costtype']);
        $vcostbeds = $this->clean_input($_POST['costroom']);
        $vimage = $_FILES['imagem']['name'];
        $vcomp = $this->clean_input($_POST['complement']);
        //
        if (empty($vdescrip) || empty($vbedstype) || empty($vcosttype) || empty($vcostbeds) ||
                empty($vimage) || empty($vcomp)) {
            //
            $formErro = "Aviso: Todos os campos devem ser preenchidos!!";
            Session::set('contentsMsg', $formErro);

            header('location: ' . URL . 'admcontents');
            exit();
        }

        //Image name with your path
        $vimage = "public/upload/" . $vimage;

        $rooms = new Rooms();

        $rooms->setDescription($vdescrip);
        $rooms->setTypebeds($vbedstype);
        $rooms->setCosttype($vcosttype);
        $rooms->setCostroom($vcostbeds);
        $rooms->setImagem($vimage);
        $rooms->setComplement($vcomp);
        //
        $result = $this->model->create($rooms);
        //       
        if (empty($result)) {
            Session::set('contentSucessoMsg', "Conteudo Cadastrado com Sucesso! $result");
            header('location: ' . URL . 'admcontents');
            exit();
        } else {
            Session::set('roomErroMsg', "Erro no Cadastrado: $result");
            header('location: ' . URL . 'admcontents');
            exit();
        }
    }

    public function edit($id)
    {
        $this->view->title = 'OSSB Solutions - Edição de Conteudos';
        $this->view->rooms = $this->model->roomsSingleList($id);

        $this->view->render('header');
        $this->view->render('admcontents/edit');
        $this->view->render('footer');
    }

    public function editSave($id)
    {
        Session::init();

        $vdescrip = $this->clean_input($_POST['descrip']);
        $vbedstype = $this->clean_input($_POST['typebeds']);
        $vcosttype = $this->clean_input($_POST['costtype']);
        $vcostbeds = $this->clean_input($_POST['costroom']);
        $vcomp = $this->clean_input($_POST['complement']);
        $vstatus = $_POST['status'];

        //
        if (empty($vdescrip) || empty($vbedstype) || empty($vcosttype) ||
                empty($vcostbeds) || empty($vstatus) || empty($vcomp)) {
            //
            $formErro = "Aviso: Todos os Campos devem ser Preenchidos!!";
            Session::set('contentsMsg', $formErro);

            header('location: ' . URL . 'admcontents/edit/' . $id);
            exit();
        }

        $rooms = new Rooms();

        $rooms->setRoomid($id);
        $rooms->setDescription($vdescrip);
        $rooms->setTypebeds($vbedstype);
        $rooms->setCosttype($vcosttype);
        $rooms->setCostroom($vcostbeds);
        $rooms->setStatus($vstatus);
        $rooms->setComplement($vcomp);
        //
        $result = $this->model->editSave($rooms);
        //      
        if (empty($result)) {
            Session::set('contentsSucessoMsg', "Alteração feita com Sucesso! $result");
            header('location: ' . URL . 'admcontents');
            exit();
        } else {
            Session::set('contentsErrorMsg', "Erro nas Alterações: $result");
            header('location: ' . URL . 'admcontents/edit/' . $id);
            exit();
        }
    }

    public function delete($id)
    {
        Session::init();

        $result = $this->model->delete($id);
        //
        if ($result) {
            Session::set('contentsOkMsg', "Remoção feita com Sucesso!");
            header('location: ' . URL . 'admcontents');
            exit();
        } else {
            Session::set('contentsErrorMsg', "Erro na remoção!, Conteudo nao pode ser removido: $result");
            header('location: ' . URL . 'admcontents');
            exit();
        }
    }

    function clean_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
