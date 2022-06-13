<title>"<?php $this->view->title = 'Área do Usuário' ?>"</title>
<div class="container">

    <h1>Dashboard Logged.........!!</h1>      

    <br />
    <?php

    
    if (isset($_SESSION['user_ar'])) {
        $user_ar = $_SESSION['user_ar'];
        //
        print_r($user_ar);
        echo '<br/>';
        echo "User ID: ".$user_ar['userid'];
        echo '<br/>';
        echo "User Name: " .$user_ar['username'];
    }
    ?>


</div>
