<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;

/**
 * Description of UserCtrl
 *
 * @author batista
 */
class UserCtrl extends BaseController {

    public function index() {
        $model = new NewsModel();
        print_r('Inside News::Index().....!!!');

        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
    }

    public function getUserID() {
        //$slug = new Slug();
        $mymodel = new UserModel();
        //$user = new User();
        $user = $mymodel->getUser();
        //
        echo 'Id: ' . $user->getId() . '</br>';
        echo 'User: ' . $user->getUsername() . '</br>';
        /*
          print "<pre>";
          print_r($user);
          print "</pre>"; */
        //       
    }

    /***
     * Method responsible for displaying the user 
     * registration form, for add new user. .
     */
    public function addUser() {

        return view('add-user');
    }

    /***
     * Method responsible for save new user to database table.
     */
    public function saveUserAdd() {
        $userModel = new UserModel();
        $encrypter = \Config\Services::encrypter();

        if ($this->request->getMethod() == "post") {

            $rules = [
                "username" => "required|min_length[3]|max_length[15]",
                "password" => "required|min_length[6]|max_length[8]",
                "email" => "required|valid_email",
            ];

            if (!$this->validate($rules)) {

                return view('add-user', [
                    "validation" => $this->validator,
                ]);
            } else {
//                $plainText = 'This is a plain-text message!';
//                $ciphertext = $encrypter->encrypt($plainText);
//                // Outputs: This is a plain-text message!
//                echo $encrypter->decrypt($ciphertext);

                $encoded_passwd = base64_encode($encrypter->encrypt($this->request->getVar("password")));

                $user_data = [
                    'username' => $this->request->getVar("username"),
                    'password' => $encoded_passwd,
                    'passwd_hint' => "Anything...",
                    'email' => $this->request->getVar("email"),
                    'status' => $this->request->getVar("Status"),
                    'allow_access' => 'N',
                    'note' => $this->request->getVar("note")];

                $result = $userModel->insertUser($user_data);
                /*  print "<pre>";
                  print_r($result);
                  print "</pre>"; */

                $session = session();
                if (!isset($result)) {
                    $session->setFlashdata("success", "User created successfully");
                } else {
                    $session->setFlashdata("error", $result);
                }
                return redirect()->to(base_url('list-users'));
            }
        }        
    }


    /***
     * Method responsible to show all user from database table.
     */
    public function listUsers() {
        $userModel = new UserModel();

        $users = $userModel->getUsers();

        return view('list-users', [
            "users" => $users,
        ]);
    }

    
    /***
     * Method responsible to show form to update 
     * selected user on list-users.
     */
    public function editUser($id = null) {
        $userModel = new UserModel();

        $user = $userModel->getUser($id);

        return view('edit-user', [
            "user" => $user,
        ]);
    }

    /***
     * Method responsible to save user update to database table.
     */
    public function saveUserUpdt($id = null) {
        $userModel = new UserModel();

        //$user = $userModel->where("id", $id)->first();

        if ($this->request->getMethod() == "post") {

            $rules = [
                "username" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "status" => "required|min_length[1]|max_length[1]",
            ];

            if (!$this->validate($rules)) {

                return view('edit-user', [
                    "validation" => $this->validator,
                    "user" => $user,
                ]);
            } else {
                $datetoday = date_create(date('Y/m/d H:i'));
                $date_today = date_format($datetoday, "Y-m-d H:i");
                
                $user_data = [
                    'username' => $this->request->getVar("username"),
                    'password' => $encoded_passwd,
                    'passwd_hint' => "Anything...",
                    'email' => $this->request->getVar("email"),
                    'status' => $this->request->getVar("Status"),
                    'allow_access' => 'N',
                    'note' => $this->request->getVar("note"),
                    'updated_at' => $date_today];

                $userModel->updateUser($id, $user_data);

                $session = session();
                $session->setFlashdata("success", "User updated successfully");
                return redirect()->to(base_url('list-users'));
            }
        }

        return view('edit-user', [
            "user" => $user,
        ]);
    }    
    
    
    public function deleteUser($id = null) {
        $userModel = new UserModel();
        $user = $userModel->delete($id);

        $session = session();
        $session->setFlashdata("success", "User deleted successfully");

        return redirect()->to(base_url('list-users'));
    }

}
