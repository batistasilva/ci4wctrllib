<?php
define('DB_TYPE', 'mysql');
define('DB_HOST', getenv('database.default.hostname'));
define('DB_NAME', getenv('database.default.database'));
define('DB_USER', getenv('database.default.username'));
define('DB_PASS', getenv('database.default.password'));
define('DB_PARAM', getenv('database.default.charset'));

class MDatabase extends PDO {


    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME . ';charset=utf8', $DB_USER, $DB_PASS);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
                return $sth->fetchAll($fetchMode);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * selectobj()
     * @param type $sql
     * @param type $array
     * @param type $class
     * @return array_class[]
     */
    public function selectObjList($sql, $array = array(), $class) {
        $sth = $this->prepare($sql);
        $array_reserves = NULL;

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();

                while ($obj = $sth->fetchObject($class)) {
                    $array_reserves[] = $obj;
                }

                //
                return $array_reserves;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * selectobj()
     * @param type $sql
     * @param type $array
     * @param type $class
     * @return Obj
     */
    public function selectObj($sql, $array = array(), $class) {
        $sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
                //              
                $obj = $sth->fetchObject($class);

                //print_r($obj);
                // exit();

                return $obj;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * selectobj()
     * @param type $sql
     * @param type $class
     * @return Obj
     */
    public function getNextIDObj($sql, $class) {
        $sth = $this->prepare($sql);
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
                //              
                $obj = $sth->fetchObject($class);

                //print_r($obj);
                // exit();

                return $obj;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }    
    
    /**
     * selectNextID()
     * @param type $sql
     * @return int
     */
    public function getNextID($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
                $last_id = $sth->fetchAll($fetchMode);

                return $last_id;
            } catch (PDOException $e) {
                $error = $e->getMessage();
                print_r($error);
                exit();
                return $error;
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            $error = $msg;
            print_r($msg);
            exit();
            //
            return $msg;
        }
    }

    /**
     * selectobj()
     * @param type $sql
     * @param type $array
     * @param type $class
     * @return Obj
     */
    public function SingleObj($sql, $array = array()) {
        $sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
                //              
                $obj = $sth->fetchObject();

                //print_r($obj);
                //exit();

                return $obj;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        // echo "<br/>FieldNames...: .$fieldNames";
        // echo "<br/>FieldValues...: .$fieldValues";

        foreach ($data as $key => $value) {
            //  echo "<br/>Chave..: .$key - Valor..: .$value";
            $sth->bindValue(":$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
            } catch (PDOException $e) {
                $msg = "ERRO NA INCLUSÃO SQL: " . $e->getMessage();
                return $msg;
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            // echo $msg;
            //
            return $msg;
        }
    }

    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        $URL_NAME = "DELETE FROM $table WHERE $where LIMIT $limit";
        return $this->exec($URL_NAME);
    }

}
