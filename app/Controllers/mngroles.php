<?php

require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/UrlsPage.php';
require_once 'models/mngurls_model.php';
require_once 'models/Roles.php';

/**
 * Description of mngurls
 *
 * @author sistema
 */
class MngRoles extends Controller {

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    //
    public function index() {
        $this->view->title = 'OSSB Solutions - Administração de Permissões';
        $this->view->smsg = $this->smsg;
        $this->view->RolesList = $this->model->getRolesToTable();
        //
        $this->view->render('header');
        $this->view->render('mngroles/index');
        $this->view->render('footer');
    }

    /**
     * Method to AddRole
     */
    public function addrole() {
        $this->view->title = 'OSSB Solutions - Administração de Permissões';
        //
        $this->view->role = $this->model->getRoleID();
        //$role = $this->model->getRoleID();

        $this->view->render('header');
        $this->view->render('mngroles/addrole_main');
        $this->view->render('footer');
    }

    /**
     * Method to add and remove
     * Roles to Group.
     * @param type $role_id
     */
    public function editrole($role_id) {
        $urlmdl = new MngUrls_Model();
        //
        $this->view->title = 'OSSB Solutions - Administração de Permissões';
        //
        $this->view->AppList = $urlmdl->getUrlToCombobox();
        $this->view->role = $this->model->getRoleToID($role_id);
        $this->view->RolesList = $this->model->getRolesToID($role_id);
        //
        //
        $this->view->render('header');
        $this->view->render('mngroles/editrole');
        $this->view->render('footer');
    }

    /**
     * Method to Save a New Role Name
     * to database..
     */
    public function addSave() {
        $tools = new Tools();
        //
        $vrole_id = $tools->clean_int_input($_POST['role_id']);
        $vrole_name = $tools->clean_input_url($_POST['role_name']);

        $role = new Roles();
        //
        $role->setRole_id($vrole_id);
        $role->setRole_name($vrole_name);
        $role->setDate_create(''); //String empty to new date time
        //     

        $result = $this->model->AddAppRole($role);
        //
        if ($result) {
            $this->smsg->setApp('mngroles');
            $this->smsg->setMsg("Erro na inclusão da aplicação: addSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngroles/addrole_main');
            exit();
        } else {
            header('location: ' . URL . 'mngroles/editrole/' . $vrole_id);
            exit();
        }
    }

    /**
     * Method to Add Role Items to Role
     * to database..
     */
    public function editSave() {
        $tools = new Tools();
        //
        $vrole_id = $tools->clean_int_input($_POST['role_id']);
        $vurl_id = $tools->clean_input_date($_POST['url_id']);

        $role = new Roles();
        //
        $role->setRole_id($vrole_id);
        $role->setUrl_id($vurl_id);
        //    
        $result = $this->model->AddAppRoleItem($role);
        //
        if ($result) {
            $this->smsg->setApp('mngroles');
            $this->smsg->setMsg("Erro na inclusão da aplicação: editSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
        }
        //
        header('location: ' . URL . 'mngroles/editrole/' . $vrole_id);
        exit();
    }

    /**
     * Method to remove Aplication
     * Page from database.
     * @param type $url_id
     */
    public function rmAppToRole($role_id, $url_id) {
        //
        $role = new Roles();
        //
        $role->setRole_id($role_id);
        $role->setUrl_id($url_id);
        //
        $result = $this->model->DeleteAppRole($role);

        /*        print "<pre>";
          print_r($result);
          print "</pre>";
          exit(); */

        if ($result !== 'Okay') {
            $this->smsg->setApp('mngroles');
            $this->smsg->setMsg("Erro na exclusão da aplicação: deleteApp(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngroles/editrole/' . $role_id);
            exit();
        } else {
            //
            $this->smsg->setApp('mgnroles');
            $this->smsg->setMsg("Aplicação excluída com sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngroles/editrole/' . $role_id);
            exit();
        }
    }

    /**
     * Method to Remove a Role
     * to specified ID.
     * @param type $role_id
     */
    public function rmRoleID($role_id) {
        //
        //
        //$result = $this->model->DeleteRoleID($role_id);
        //
       $result = $this->model->RemoveRoleID($role_id);
        //
        if ($result !== 'Okay') {
            $this->smsg->setApp('mngroles');
            $this->smsg->setMsg("Erro na exclusão do grupo: rmRoleID(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngroles/');
            exit();
        } else {
            //
            $this->smsg->setApp('mgnroles');
            $this->smsg->setMsg("Grupo excluído com sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngroles/');
            exit();
        }
    }

    /**
     * Metho to url_id to Table urls_page
     * for Single Object PDO Class to Ajax. 
     * @param type $url_id
     */
    public function SearchRoleToID($url_id) {
        $urlmdl = new MngUrls_Model();
        //
        $url = new UrlsPage();
        $url = $urlmdl->getAppUrlSingle($url_id);
        //
        echo json_encode($url);
    }

    /**
     * Method to Verify if url_id exist
     * in roles_items before be added.
     * @param type $role_id
     * @param type $url_id
     */
    public function ValidURLToID($role_id, $url_id) {
        //
        $role = new Roles();
        //
        $role->setRole_id($role_id);
        $role->setUrl_id($url_id);
        //
        /*   print "<pre>";
          print_r($role);
          print "</pre>";
          exit(); */

        $role = $this->model->verifyRolesItems($role);
        //
        echo json_encode($role);
    }

    /**
     * Method to Show data Table
     * to Search List.
     * @param type $data_list
     */
    function ShowDataTable($data_list) {
        //
        echo '<div id="RolesList" class="scroll-area" data-spy="scroll" data-offset="0">';
        echo '<table cellspacing="0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Aplicação</th>';
        echo '<th>Url</th>';
        echo '<th>Ação</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        //
        foreach ($data_list as $role) {
            echo '<tr>';
            echo '<td style="width: 250px;">';
            echo $role->getApp_name();
            echo '</td>';
            echo '<td style="width: 200px;">';
            echo $role->getPage();
            echo '</td>';
            echo "<td><a href='" . URL . 'mngroles/rmRole/' . $role->getRole_id() . "'>Remover</a></td>";
            echo '</tr>';
        }
        //
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        //
    }

}
