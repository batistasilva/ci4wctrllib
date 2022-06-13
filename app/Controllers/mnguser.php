<?php

require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/User.php';
require_once 'models/Staff.php';
require_once 'models/Local.php';
require_once 'models/Department.php';
require_once 'models/TypeAccount.php';
require_once 'models/mnglocal_model.php';
require_once 'models/mngcust_model.php';
require_once 'models/mngcpny_model.php';
require_once 'models/view/UserView.php';
require_once 'models/mngstaff_model.php';
require_once 'models/mngjob_model.php';

/**
 * Description of admuser
 *
 * @author batista
 */
class Mnguser extends Controller {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    public function index() {
        $this->view->title = 'OSSB Solutions - Administração de Usuários';
        $this->view->userList = $this->model->userClassList();
        //
        $this->view->render('header');
        $this->view->render('mnguser/index');
        $this->view->render('footer');
    }

    public function adduser() {
        $cust = new Mngcust_Model();
        $cpny = new Mngcpny_Model();
        $job = new Mngjob_Model();
        $local = new MngLocal_Model();
        $staffmodel = new Mngstaff_Model();
        //
        $this->view->title = 'OSSB Solutions - Administração de Usuários';
        //
        $this->view->CpnyList = $cpny->getCpnyToCombobox();
        $this->view->CustList = $cust->getCustomerToCombox();
        $this->view->JobTitleList = $job->getJobTitleToCombobox();
        $this->view->LocalList = $local->getLocalToCombobox();
        //$this->view->StaffList    = $staffmodel->getStaffList();
        //
        $this->view->user = new User();

        $userview = new UserView();
        $vphoto = "public/images/no_person.png";
        $userview->setPhoto(URL . $vphoto);

        $this->view->userv = $userview;
        //
        $this->view->render('header');
        $this->view->render('mnguser/adduser');
        $this->view->render('footer');
    }

    /**
     * Method to save new user
     * to access system..
     */
    public function addSave() {
        $tools = new Tools();
        $stfmdl = new Mngstaff_Model();
        //
        $vcompany_id  = $tools->clean_int_input($_POST['company_id']);
        $vacronym     = $tools->clean_int_input($_POST['acronym']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle_id']);
        $vstaff_id    = $tools->clean_int_input($_POST['staff_id']);
        //
        $vusername    = $tools->clean_input_date($_POST['username']);
        $vpassword    = $tools->clean_input_date($_POST['password']);
        $vemail       = $tools->clean_input_date($_POST['useremail']);
        $vobs         = $tools->clean_input_date($_POST['message']);
        //                  
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $user = new User();
        $user = $this->model->getUserID();
        //
        $user->setCpny_id($vcompany_id);
        $user->setCust_id($vcustomer_id);
        $user->setStaff_id($vstaff_id);
        $user->setUsername($vusername);
        $user->setPassword($vpassword);
        $user->setEmail($vemail);
        $user->setNote($vobs);   
    }

    /**
     * Method to Search All Staff to
     * Selected Options.
     */
    public function SearchStaff() {
        $tools = new Tools();
        $stfmdl = new Mngstaff_Model();
        //
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vacronym = $tools->clean_int_input($_POST['acronym']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle']);
        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $staff = new Staff();
        //
        $staff->setCompany_id($vcompany_id);
        $staff->setLocal_id($local->getLocal_id());
        $staff->setStatus('A');
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);

        //
        $type_option = $tools->getOptionToQuery($vcustomer_id, $vjobtitle_id);
        //
        $staff_list = $stfmdl->getAllStaffs($staff, $type_option);

        if (isset($staff_list)) {
            $this->ShowComboBox($staff_list);
        } else {
            $this->msg->setMsg("(Pesquisa por Filtros): Colaboradores não Encontrados...!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Search Staff to ID Selected
     * in Combobox for user form add.
     * @param type $staff_id
     */
    public function SearchStaffToID($staff_id) {
        $stfmdl = new Mngstaff_Model();
        //
        $staff = new Staff();
        $staff = $stfmdl->getStaffOnly($staff_id);
        /*print '<pre>';
        print_r($staff);
        print '</pre>';
        exit();*/
        echo json_encode($staff);
    }

    /**
     * Method to Populate All Staff to ComboBox.
     * @param type $staff_list
     */
    private function ShowComboBox($staff_list) {
        //
        echo '<div id="StaffToUser" class="form-group" style="width: 700px;">';
        if (isset($staff_list)) {
            echo '<label for ="ComboStaffs">Colaboradores:</label>';
            echo '<select id="SELStaffID" name="staff_id" onchange="setCustJobID(this.value);" class = "form-control text-center" style="width: 700px;" >';
            echo '<option value="SEL">[Selecione]</option>';
            foreach ($staff_list as $staff) {
                echo '<option value="';
                echo $staff->getStaff_id();
                echo '">';
                echo $staff->getName() . $staff->getSurname();
                echo '</option>';
            }
            echo '</select>';
        }
        echo '</div>';
    }

    public function update($userid) {
        $this->view->title = 'Valentinis Seguranca - Edição de Usuários';
        $this->view->user = $this->model->userClassSingle($userid);

        $this->view->render('header');
        $this->view->render('mnguser/edituser');
        $this->view->render('footer');
    }

    public function updateSave($userid) {
        //
        $tools = new Tools();
        //        
        $vpass = $tools->clean_input($_POST['password']);
        $vuser = $tools->clean_input($_POST['username']);
        $vemail = $tools->clean_input($_POST['email']);
        $vrole = $tools->clean_input($_POST['role']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vnote = $tools->clean_input($_POST['note']);

        $strmsg = '<br/>Pass: ' . $vpass . ' Email: ' . $vemail . ' Role: ' . $vrole . ' Status: ' . $vstatus . ' Note: ' . $vnote;

        //
        if (empty($vpass) || empty($vuser) || empty($vemail) || empty($vrole) || empty($vstatus) || empty($vnote)) {

            $erroFields = "Erro: Todos os campos devem ser preenchidos!! $strmsg";

            Session::set('userErrorMsg', $erroFields);

            header('location: ' . URL . 'mnguser/update/' . $userid);
            exit;
        }
        //
        $user = new Users();

        $user->setUserid($userid);
        $user->setUsername($vuser);
        $user->setEmail($vemail);
        $user->setPassword($vpass);
        $user->setRole($vrole);
        $user->setStatus($vstatus);
        $user->setNote($vnote);
        //
        $result = $this->model->update($user);
        //        

        if (!isset($result)) {
            Session::set('userSucessMsg', "Alteração feita com sucesso!");
            //
            $this->smsg->setApp('mnguser');
            $this->smsg->setMsg("Usuário Alterado com Sucesso!!!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mnguser/index');
            exit();
        } else {
            $erroFields = "Erro: Não foi possível salvar as alterações!!: " . $result;

            Session::set('userErrorMsg', $erroFields);

            header('location: ' . URL . 'mnguser/update/' . $userid);
            exit();
        }
    }

}
