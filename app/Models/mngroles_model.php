<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Roles.php';
require_once 'view/RoleView.php';

/**
 * Description of mngroles_model
 *
 * @author sistema
 */
class MngRoles_Model extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method to get next id to Class Roles
     * and set for it.
     * @return type
     */
    public function getRoleID() {
        $role = $this->db->getNextIDObj('SELECT getNextSeq("role_seq") as role_id;', "Roles");
        //
        return $role;
    }

    /**
     * Method to get Object Roles
     * for id Addeded
     * @param type $role_id
     * @return type
     */
    public function getRoleToID($role_id) {
        //
        $role = $this->db->selectObj('SELECT role_id, role_name '
                . 'FROM roles '
                . 'WHERE role_id = :role_id', array(':role_id' => $role_id), "Roles");
        //
        return $role;
    }

    /**
     * Method to Add New Application
     * to UrlsPage.
     * @param type $url
     * @return type
     */
    public function AddAppRole($role) {
        $approle = new Roles();
        $approle = $role;
        //
        /*
         * Add new address to state_sp
         */
        $result = $this->db->insert('roles', array(
            'role_id' => $approle->getRole_id(),
            'role_name' => $approle->getRole_name(),
            'status' => 'I',
            'date_create' => $approle->getDate_create()
        ));
        //
        return $result;
    }

    /**
     * Method to Add New Application
     * to UrlsPage.
     * @param type $url
     * @return type
     */
    public function AddAppRoleItem($role) {
        $approle = new Roles();
        $approle = $role;
        //
        //Verify if last item is 0, and return it.
        $result_item = $this->validLastItem($role->getRole_id());

        /*
         * Add new address to state_sp
         */
        $result = $this->db->insert('roles_items', array(
            'role_id' => $approle->getRole_id(),
            'url_id' => $approle->getUrl_id()
        ));

        if (!isset($result)) {
            if ($result_item = TRUE)
                $this->updateRoleStatus($role->getRole_id(), 'A');
        }

        //
        return $result;
    }

    
    /**
     * Method to get all roles added
     * to show in a table to
     * view or remove.
     * @return type
     */
    public function getRolesToID($role_id) {
        return $this->db->selectObjList('
            SELECT ri.role_id as role_id, ri.url_id as url_id, up.app_name as app_name, up.page as url_name  
            FROM roles_items ri, urls_page up 
            WHERE ri.role_id = :role_id
            AND   ri.url_id  = up.url_id  
            ORDER BY app_name;', array(':role_id' => $role_id), "RoleView");
    }

    
    /**
     * Method to get all roles added
     * to show in a table to
     * view or remove.
     * @return type
     */
    public function verifyRolesItems($role) {
        return $this->db->SingleObj('
            SELECT url_id  FROM roles_items 
            WHERE role_id = :role_id
            AND   url_id  = :url_id', array(
                    ':role_id' => $role->getRole_id(),
                    ':url_id' => $role->getUrl_id()));
    }

    
    /**
     * Method to get a list from object
     * Roles for list in a table to
     * edit or update.
     * @return type
     */
    public function getRolesToTable() {
        return $this->db->selectObjList('
            SELECT role_id, role_name, status, DATE_FORMAT(date_create,"%d-%m-%Y %H:%i:%s") as date_create 
            FROM roles 
            ORDER BY role_name;', $array = array(), "Roles");
    }

    
    /**
     * Method to Delete a Role to ID
     * from Roles when is free item and empty 
     * and Inactiv.
     * @param type $role_id
     */
    public function RemoveRoleID($role_id) {
        //Remove UrlPage
        $result = $this->db->delete('roles', "role_id='{$role_id}'");

        if ($result == 1)
            return 'Okay';

        return $result;
    }

    
    /**
     * Method to Delete App Role
     * from roles_items.
     * @param type $role
     */
    public function DeleteAppRole($role) {
        //Remove UrlPage
        $result = $this->db->delete('roles_items', "role_id='{$role->getRole_id()}' AND url_id='{$role->getUrl_id()}'");

        if ($result == 1) {
            //
            if ($this->validLastItem($role->getRole_id())) {
                echo 'Change Status!!';
                $this->updateRoleStatus($role->getRole_id(), 'I');
            } else {
                echo 'Not Yet Change Status!!';
            }
            //
            return 'Okay';
        }

        return $result;
    }

    
    /**
     * Valid if roles_items table is empty
     * to item to role_id;
     * @param type $role_id
     * @return boolean
     */
    public function validLastItem($role_id) {
        //
        $obj = $this->db->SingleObj('
            SELECT count(url_id) as url_id  
            FROM roles_items 
            WHERE role_id = :role_id;', array(':role_id' => $role_id));
        //
        if ($obj->url_id > 0) {
            echo '-->' . $obj->url_id;
            return FALSE;
        } else {
            echo '-->' . $obj->url_id;
            return TRUE;
        }
    }

    
    /**
     * Update Status to Role, to Active or Inactiv
     * @param type $role_id
     * @param type $status
     */
    private function updateRoleStatus($role_id, $status) {
        //Person Reference
        $rs_role = $this->db->update('roles', array(
            'status' => $status), " role_id = {$role_id}");
    }

}
