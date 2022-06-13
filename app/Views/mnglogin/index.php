<!DOCTYPE html>
<html lang="pt-BR" class="no-js">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Importante para habilitar os recursos de Responsividade em conjunto com o CSS -->
        <meta name="keywords" content="HTML5,javascript">
        <title><?= (isset($this->title)) ? $this->title : 'OSSB Solutions Business'; ?></title>
        <meta property="og:title" content="grupolseguranca.com.br">
        <meta property="og:image" content="http://www.grupolseguranca.com.br/public/images/logotipo.jpg">
        <meta property="og:site_name" content="grupolseguranca.com.br">
        <meta property="og:description" content="OSSB Solutions Business">
        <meta content="A OSSB Solutions Business é uma das Lides em Automação e Integração de Sistema no Brasil. 
              Somos conhecidos por ter os melhores preços e serviços." name="description"> 

        <script src="<?php echo URL; ?>public/btan/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo URL; ?>public/btan/js/my-custom.js" type="text/javascript"></script>

        <title>Acesso ao Sistema</title>

        <!-- Custom styles for this template -->
        <link href="<?php echo URL; ?>views/mnglogin/css/signin.css" rel="stylesheet" type="text/css"/>
        <!-- Le styles -->
        <link href="<?php echo URL; ?>public/btan/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL; ?>public/btan/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL; ?>public/btan/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL; ?>public/btan/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL; ?>public/btan/css/my-main.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?php echo URL; ?>views/mnglogin/js/ie-emulation-modes-warning.js" type="text/javascript"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo URL; ?>public/btspa1/ico/logo-vlt.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo URL; ?>public/btspa1/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo URL; ?>public/btspa1/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo URL; ?>public/btspa1/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo URL; ?>public/btspa1/ico/apple-touch-icon-57-precomposed.png">             
    </head>

    <body>
        <div class="container">
            <?php
            $this->smsg = new SMsg();
            $this->smsg = Session::getSession('smsg');
            ?>
            <?php if (isset($this->smsg)): ?>
                <div class="form-group">
                    <div class="error col-xs-offset-1 col-xs-10">
                        <div class="<?php echo $this->smsg->getInfo(); ?>" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><?php echo $this->smsg->getMsg(); ?></strong>
                        </div>
                    </div>
                </div>
                <?php
                $this->smsg->rmSMsg();
                //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                ?>
            <?php endif; ?>      
            <form class="form-signin" role="form" action="mnglogin/runLogin" method="post">
                <h2 class="form-signin-heading">Logar no Sistema...</h2>  
                <label for="inputUser" class="sr-only">Usuário:</label>
                <input id="inputUser" name="username" class="form-control" placeholder="Usuário..." required="" autofocus="" type="text">
                <label for="inputPassword" class="sr-only">Senha</label>
                <input id="inputPassword" name="password" class="form-control" placeholder="Senha..." required="" type="password">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>  
        </div> <!-- /container -->
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo URL; ?>views/mnglogin/js/ie10-viewport-bug-workaround.js" type="text/javascript"></script>
    </body>
</html>