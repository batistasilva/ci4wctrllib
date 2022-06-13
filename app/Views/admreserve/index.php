<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Administração de Reservas</strong></small>
                </span>
                <hr>
                <div class="panel panel-default">
                    <?php if (isset($_SESSION['delRsvCust'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-warning alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['delRsvCust']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['delRsvCust']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>  
                    <?php if (isset($_SESSION['updtSucessRsvCust'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-warning alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['updtSucessRsvCust']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['updtSucessRsvCust']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>                     
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center">Reservas Ativas</div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Quarto</th>
                                <th>CheckIn</th>
                                <th>CheckOut</th>
                                <th>Dias</th>
                                <th>Valor R$</th>
                                <th>Ação1</th>
                                <th>Ação2</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if(isset($this->rsvClassList))
                            foreach ($this->rsvClassList as $rsv)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $rsv->getRsvcode(); ?></td>
                                    <td><?php echo $rsv->getName(); ?></td>
                                    <td><?php echo $rsv->getDescription(); ?></td>
                                    <td><?php echo $rsv->getCheckin(); ?></td>
                                    <td><?php echo $rsv->getCheckout(); ?></td>
                                    <td><?php echo $rsv->getDaysqty(); ?></td>
                                    <td><?php echo $rsv->getTotalcost(); ?></td>
                                    <td><a href="<?php echo URL; ?>admreserve/edit/<?php echo $rsv->getRsvid(); ?>">Editar</a></td>
                                    <td><a class="delete" href="<?php echo URL; ?>admreserve/delete/<?php echo $rsv->getRsvid(); ?>">Remover</a></td>
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