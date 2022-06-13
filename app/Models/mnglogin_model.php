<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

class Mnglogin_Model extends Model {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    public function run() {

        echo '<br><h1>Inside run() login_model!!!</h1><br>';
        echo '<br/>User -->' . $_POST['username'];
        echo '<br/>Pass -->' . $_POST['password'];

        $sth = $this->db->prepare("SELECT user_id, staff_id, cpny_id, cust_id, username, password, role_id, userkey, status 
            FROM users WHERE username = :username AND password = :password");
        //



        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute(array(
                    ':username' => $_POST['username'],
                    ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
                ));
                
                $data = $sth->fetch();
                
            } catch (PDOException $e) {
                $msg = "ERROR SQL: " . $e->getMessage();
                print_r($msg);
                exit();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            print_r($msg);
            exit();
        }

        $count = $sth->rowCount();

        if ($count > 0) {
            // login
            Session::init();
            Session::setSession('role', $data['role']);
            Session::setSession('loggedIn', true);
            Session::setSession('userid', $data['user_id']);
            header('location: ' . URL . 'index');
        } else {
            header('location: ' . URL . 'mnglogin');
        }
    }

    /**
     * Seta um usuário logado no sistema.
     *
     * @param $user
     */
    function setUserInSession($user) {
        $s = serialize($user);
        if ($_SESSION['USER'] == null) {
            $_SESSION['USER'] = $s;
        }
    }

    /**
     * Retorna o usuário da sessão
     *
     * @return $_SESSION['USER']
     */
    function getUserInSession() {
        if ($_SESSION['USER'] != null) {
            return unserialize($_SESSION['USER']);
            //return $_SESSION['USER'];
        } else {
            return null;
        }
    }

}
