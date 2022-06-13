<?php
namespace App\Models;

//use App\Models\entity\Company as Cpny;
use CodeIgniter\Model;
use App\Libraries\MModel;  // Library Tmdb

/**
 * Description of CompanyModel
 * Class to control input and output 
 * to database.
 * @author batista
 */
class CompanyModel extends Model {

    protected $DBGroup = 'default';
    protected $primaryKey = 'company_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $table = 'company';
    protected $cpny = 'App\Entities\Company';
    public $mmodel;


    public function __construct() {
parent::__construct();


    }

//    protected $returnType = 'App\Entities\User'; // configure entity to use

    /*     * *
     * Method to get All Company
     * in database and return.
     */

    public function getAllCompany() {
        $query = $this->db->query("SELECT * FROM $this->table");

        $result = $query->getResultObject();

        return $result;
    }

public function getUsers() {
   //     $v = $this->myldb->conn_id->prepare("SELECT * FROM my_table WHERE my_col=?");
//using our mysql db config, like we normally do
        $query = $this->myldb->query("SELECT * FROM users");
        var_dump($query->result());

//load the pdo db config
        $this->pdo = $this->load->database('pdo', true);

//using the pdo config
        $stmt = $this->pdo->query("SELECT * FROM users");
        var_dump($stmt->result());

//using the pdo config with active record
        $stmt = $this->pdo->get("users");
        var_dump($stmt->result());
}
    
    
    
    

    public function getCompany($cpny_id) {

        $this->cpny = new \App\Entities\Company();
        $this->mmodel->connection();

 /*       $this->cpny = $this->db->selectObj('SELECT company_id, cnpj, ie, shortname, longname, '
                . 'bussiness_phone, mobil_phone, nextel_phone, nextelid, email, status, note, date_create, date_change '
                . 'FROM company '
                . 'WHERE company_id = :company_id', array(':company_id' => $cpny_id), "Company");
        //
        $addrcpny = $this->db->selectObj('SELECT company_id, zipcode, zipid, address, addr_number, district, city, state, reference '
                . 'FROM companyaddr '
                . 'WHERE company_id = :company_id', array(':company_id' => $cpny_id), "CompanyAddr");

        //$db->callFunction('some_function', $param1, $param2, etc..);
        // $cpnyModel = new CompanyModel(); //Object of Model class
        // $this->cpny = new \App\Entities\Company();
        // $this->cpny = $cpnyModel->find($cpny_id)->asObject($this->cpny);
// this will return all data into User Entity object, 
// because we have configured Entity in returnType in model class
        //$cpny = new Company();
        //$builder = $db->table('users');
        //$builder->select('title, content, date');
        //$builder->from('mytable');
        //$query = $builder->get();
        // $builder = $db->table('company');
        // $array = ['name !=' => $name, 'id <' => $id, 'date >' => $date];
        // $builder->where($array);
        // $query = $builder->get();  // Produces: SELECT * FROM mytable
        // $result = $this->db->query($sql);
        //$this->cpny = $result->getResultObject($this->cpny);
        // $this->cpny = $this->db->query($sql)->fetchObject($this->cpny);
        /// $this->cpny = $result->callFunction('fetchObject', $this->cpny);
        //$this->cpny = $result->custom_row_object(0, 'entity\Company');

        /*        if (isset($this->cpny)) {
          echo $this->cpny->getCompany_id();   // access attributes
          echo $this->cpny->getLongname();   // access class methods
          }
         */
        print "<pre>";
        print_r($this->cpny);
        print "</pre>";
        exit();

        return $this->cpny;
    }

    function _set_class_vars(&$obj) {
        $class = get_class($this);
        $class_vars = get_class_vars($class);

        // check that each of the passed parameters are valid before setting the
        // appropriate class variable.
        foreach ($obj as $var => $value) {
            if (array_key_exists($var, $class_vars)) {
                $this->$var = $value;
            } else {
                //p('setClassVars: class variable "'.$var.'" does not exist on class "' .$class.'"');
            }
        }
    }

}
