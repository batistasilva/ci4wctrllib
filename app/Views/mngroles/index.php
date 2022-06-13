
<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small>
                        <strong>Administração - Grupos Cadastrados</strong>
                    </small>
                </span>
                <?php
                $smsg = Session::getSession('smsg');
                ?>
                <?php if (isset($smsg)): ?>
                    <div class="form-group">
                        <div class="error col-xs-offset-1 col-xs-10">
                            <div class="<?php echo $smsg->getInfo(); ?>" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo $smsg->getMsg(); ?></strong>
                            </div>
                        </div>
                    </div>
                    <?php
                    $this->smsg->rmSMsg();
                    //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                    ?>
                <?php endif; ?>    
                <hr>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-contact-list-32x32"></span>
                        <strong>Grupos Cadastrados...</strong>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Nome do Grupo</th>
                                <th>Data de Cadastro</th>
                                <th>Ação1</th>
                                <th>Ação2</th>                                
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->RolesList))
                                foreach ($this->RolesList as $role) {
                                    //
                                    ?>
                                    <tr>
                                        <td><?php echo $role->getRole_name(); ?></td>  
                                        <td><?php echo $role->getDate_create(); ?></td>                                       
                                        <td><a href="<?php echo URL; ?>mngroles/editrole/<?php echo $role->getRole_id(); ?>">Alterar</a></td>
                                        <td ><a onclick="<?php if ($role->getStatus() == 'A') echo 'return false;'; ?>"  href="<?php echo URL; ?>mngroles/rmRoleID/<?php echo $role->getRole_id(); ?>">Remover</a></td>
                                    </tr>                           
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-inline">
                <div class="form-group" style="width: 1024px; text-align: center; padding-top: 20px; padding-bottom: 20px; border: 0px #b92c28 solid;">
                    <a class="form-control btn btn-primary" style="width: 250px;" href="<?php echo URL; ?>menuadm/mgrp">Voltar ao Menu Anterior</a>
                </div>  
            </div> 
        </div>
    </div>
</div>

</div><!-- /container -->