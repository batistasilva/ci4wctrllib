<?php

/**
 * Description of validkey
 *
 * @author batista
 */
class validkey extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    /**
     * Method responsible for open 
     * index for validkey.
     */
    public function index()
    {
        
        $this->view->title = 'OSSB Solutions - Ativação de Cadastro';

        if ((isset($_GET['email']) || !empty($_GET['email'])) && 
                (isset($_GET['userkey']) || !empty($_GET['userkey']))) {
            //
            $email = strip_tags(trim($_GET['email']));
            $userkey = strip_tags(trim($_GET['userkey']));
            $this->model->validkey ($email, $userkey);
            //           
        }else {           
            Session::init();
            
            Session::set('userkey_error', "Não foi possível encontrar os dados para validação, tente novamente!");
            header('location: ' . URL . 'user/userkeyerror');
            exit();
        }
    }

}
