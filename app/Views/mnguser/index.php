<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Administração de Usuários</strong></small>
                </span>
                <hr>
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
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center">Usuários Cadastrados</div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Usuário</th>
                                <th>E-mail</th>
                                <th>Nível</th>
                                <th>Status</th>
                                <th>Alterar</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->userList))
                                foreach ($this->userList as $user) {
                                    ?>
                                    <tr>
                                        <td><?php echo $user->getUsername(); ?></td>
                                        <td><?php echo $user->getEmail(); ?></td>
                                        <td><?php echo $user->getRole(); ?></td>
                                        <td><?= $user->getStatus() == '1' ? "Ativo" : "Inativo"; ?></td>
                                        <td><a class="delete" href="<?php echo URL; ?>admuser/update/<?php echo $user->getUserid(); ?>">Alterar</a></td>
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