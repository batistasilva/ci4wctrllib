<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small>
                        <strong>Administração - Cadastro de Clientes</strong>
                    </small>
                </span>
                <?php
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
                    //unset($_SESSION['createCompanyOkay']);
                    //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                    ?>
                <?php endif; ?>    
                <hr>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center"><small><strong>Clientes Cadastrados</strong></small></div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Razão Social</th>
                                <th>Situação Cliente</th>
                                <th>Status</th>
                                <th>Data de Cadastro</th>
                                <th>Alterar</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->CustList))
                                foreach ($this->CustList as $cust) {
                                    $date = date_create($cust->getDate_create());
                                    $date_create = date_format($date, "d-m-Y H:m:s");
                                    //
                                    $status_condt = NULL;
                                    if ($cust->getCondtcust() == 'G') {
                                        $status_condt = "BOA";
                                    } elseif ($cust->getCondtcust() == 'B') {
                                        $status_condt = "RUIM";
                                    } elseif ($cust->getCondtcust() == 'R') {
                                        $status_condt = "REGULAR";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cust->getAliasname(); ?></td>
                                        <td><?php echo $status_condt; ?></td>                                
                                        <td><?= $cust->getStatus() == 'A' ? "Ativo" : "Inativo"; ?></td>
                                        <td><?php echo $date_create; ?></td>
                                        <td><a class="delete" href="<?php echo URL; ?>mngcust/editcust/<?php echo $cust->getCustomer_id(); ?>">Alterar</a></td>
                                        <td><a class="delete" href="<?php echo URL; ?>mngcust/removeCust/<?php echo $cust->getCustomer_id(); ?>">Remover</a></td>
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