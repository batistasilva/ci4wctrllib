<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'User.php';

/**
 * Description of admuser_model
 *
 * @author batista
 */
class Mnguser_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function userClassList() {
        return $this->db->selectObjList('SELECT user_id, username, role, status FROM users', $array = array(), "Users");
    }

    public function userClassSingle($userid) {
        return $this->db->selectObj('SELECT user_id, username, role, note, status FROM users WHERE user_id=:user_id', $array = array(':user_id' => $userid), "Users");
    }

    /**
     * Method to get next id to Class User
     * and set for it.
     * @return type
     */
    public function getUserID() {
         $user = $this->db->getNextIDObj('SELECT getNextSeq("user_seq") as user_id;', "User");
         //
         return $user;
    }

    public function update($user) {
        //
        $sth = $this->db->prepare("UPDATE users SET password=?, role=?, status=?, "
                . "note=?, date_change=NOW() WHERE user_id=?");
        //
        try {
            /**
             * If sql clean from error
             * enter to persist
             */
            if ($sth) {
                try {
                    //
                    $sth->execute(array(
                        Hash::create('sha256', $user->getPassword(), HASH_PASSWORD_KEY),
                        $user->getRole_id(),
                        $user->getStatus(),
                        $user->getNote(),
                        $user->getUser_id()));
                    //
                } catch (PDOException $e) {
                    $msg = "\nPDO::errorInfo():\n" . $e->getMessage();
                    return $e->getMessage();
                }
            } else {
                $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
                return $msg;
            }
            //
        } catch (PDOException $e) {
            $msg = "\nPDO::errorInfo():\n" . $e->getMessage();
            return $e->getMessage();
        }

        $this->getMessageToCostumer($user);
    }

    function getMessageToCostumer($user) {

        $cust = new Customer();
        //
        if ($user->getUsername() == 'admin') {
            $cust->setName('Administrador do Sistema');
        } else {
            $cust = $this->db->selectObj('SELECT *  FROM customers WHERE email = :email', array(':email' => $user->getEmail()), 'Customer');
        }
//        echo '<pre>';
//        print_r($cust);
//        echo '<pre>';
        //Send confirmation code for customer and hotel
        $subject = 'Alteração de Senhas - Pousada Costa & Silva';
        $name = $cust->getName();
        $mail = $cust->getEmail();
        $mes = '
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            table, td, th, p{
                border: 0px solid black;    
            }

            table {
                width: 100%;
                text-align: left;
            }

            th {
                height: 25%;
            }
            p{
                font-family: Arial, Helvetica, sans-serif;
            }

        </style>
    </head>
    <body>
        <p>
            <img src="http://www.grupolseguranca.com.br/public/images/logo.png" />
        </p>
        <p>Foi solicitado uma nova senha para o setor Administrativo da Pousada Costa & Silva!</p>
        <p>Segue abaixo o novo código de acesso.</p> 
        <p>Caso não tenha solicitado a alteração, desconsidere essa mensagem.</p>
        <p>Atenciosamente Site - Mensagem enviada em: (' . date('d/m/Y H:i') . ')</p>
        <hr/>
        <table>  
            <thead>
                <tr> 
                    <th>Pousada Costa & Silva - Alteração de Senhas:</th>
                </tr>
            </thead>
            <thead>
                <tr style="text-align: left;">
                    <th>Nome:</th>
                    <th>Usuário:</th>
                    <th>Senha</th>
                </tr>
            </thead>
            <tbody>  
                <tr>
                    <th>' . $cust->getName() . '</th>
                    <th>' . $user->getUsername() . '</th> 
                    <th>' . $user->getPassword() . '</th>    
                </tr>
            </tbody>
        </table>
        <hr/>
    </body>
</html>';

        $dest = $mail;
        $nome = $name;
        $email = MAIL_USER;
        $ass = 'Alteração de Senha - Site';
        $msg = $mes;
        $cop = $copia;

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf8\r\n";

        //mail($dest, $ass, $mes, $headers);

        $send = $this->SendMail($subject, $mes, $mail, $name);
    }

    // Envia E-mails
    function SendMail($subject, $message, $to, $toName) {
        require_once 'libs/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer();

        // Servidor
        //$mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = false;
        // $mail->Username = MAIL_USER;
        // $mail->Password = MAIL_PASS;
        $mail->Port = MAIL_PORT;
        //$mail->SMTPSecure = MAIL_SECURE;
        // Remetente
        $mail->From = MAIL_USER;
        $mail->FromName = "Administração Pousada Costa & Silva";

        // Destino
        $mail->addAddress($to, $toName);

        // Dados da Mensagem
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        $mail->WordWrap = 70;

        // Mensagem
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);

        $enviado = $mail->Send();

        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        return $enviado;
    }

}
