
<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small>
                        <strong>Administração - Aplicações Cadastradas</strong>
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
                    <div class="panel-heading text-center"><small><strong>Aplicações Cadastradas</strong></small></div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Nome da Aplicação</th>
                                <th>Url</th>
                                <th>Data de Cadastro</th>
                                <th>Ação1</th>
                                <th>Ação2</th>                                
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->UrlsList))
                                foreach ($this->UrlsList as $url) {
                                    //
                                    ?>
                                    <tr>
                                        <td><?php echo $url->getApp_name(); ?></td> 
                                        <td><?php echo $url->getPage(); ?></td>  
                                        <td><?php echo $url->getDate_create(); ?></td>                                       
                                        <td><a href="<?php echo URL; ?>mngurls/editurl/<?php echo $url->getUrl_id(); ?>">Alterar</a></td>
                                        <td><a href="<?php echo URL; ?>mngurls/rmApp/<?php echo $url->getUrl_id(); ?>">Remover</a></td>
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