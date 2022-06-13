
<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small>
                        <strong>Administração - Cadastro de Colaboradores</strong>
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
                    //unset($_SESSION['createCompanyOkay']);
                    //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                    ?>
                <?php endif; ?>    
                <hr>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center"><small><strong>Colaboradores Cadastrados</strong></small></div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Nome</th>
                                <th>Função</th>
                                <th>Admissão</th>
                                <th>Local</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Ação1</th>
                                <th>Ação2</th>                                
                                <th>Ação3</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->StaffList))
                                foreach ($this->StaffList as $staff) {
                                    //
                                    ?>
                                    <tr>
                                        <td><?php echo $staff->getName(); ?></td> 
                                        <td><?php echo $staff->getLongname(); ?></td>  
                                        <td><?php echo $staff->getDate_admis(); ?></td>
                                        <td><?php echo $staff->getShortname(); ?></td>  
                                        <td><?php echo $staff->getHome_phone(); ?></td>
                                        <td><?= $staff->getStatus() == 'A' ? "Ativo" : "Inativo"; ?></td>                                        
                                        <td><a href="<?php echo URL; ?>mngstaff/editstaff/<?php echo $staff->getStaff_id(); ?>">Alterar</a></td>
                                        <td><a href="<?php echo URL; ?>mngstaff/viewstaff/<?php echo $staff->getStaff_id(); ?>">Exibir</a></td>
                                        <td><a onclick="<?php if($staff->getStatus() == 'I') echo 'return false;';?>" href="<?php echo URL; ?>mngstaff/changestaff/<?php echo $staff->getStaff_id(); ?>">Mudar Status</a></td>
                                     </tr>                           
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div><!-- /container -->