<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Cadastro de Quartos</strong></small>
                </span>
                <hr>
                <form action="<?php echo URL; ?>admroom/create" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputDesc">Descrição:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" autofocus name="descrip" id="InputDesc" placeholder="Descrição do Quarto" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>

                        <label class="control-label col-xs-1" for="InputTypeBed">Camas:</label>
                        <div class="col-xs-5">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control text-center" name="typebeds" id="InputTypeBed" placeholder="Camas do Quarto: Uma de Casal e uma de Solteiro" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputCostType">Descrição de Preço:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" name="costtype" id="InputCostType" placeholder="Normal ou Promoção" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                        <label class="control-label col-xs-1" for="InputCostRoom">Valor:</label>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" class="form-control text-center" name="costroom" id="InputCustRoom" placeholder="9,99" required pattern="[0-9,]{0,11}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-xs-4" for="InputImage">Imagem do Quarto:</label>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <input type="file" name="imagem" id="InputImage" required>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-4" for="InputComplement">Descrição Complementar:</label>
                        <div class="col-xs-6">
                            <div class="input-group col-xs-12">
                                <textarea class="form-control text-left" name="complement" id="InputComplement" placeholder="Descrição complementar do quarto." required></textarea>  
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($_SESSION['roomSucessoMsg'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['roomSucessoMsg']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['roomSucessoMsg']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['roomErroMsg'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['roomErroMsg']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['roomErroMsg']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>                     

                    <div class="form-group">
                        <div class="col-xs-offset-1">
                            <button type="submit" class="btn btn-warning">Confirmar</button>
                        </div>
                    </div>  
                </form>
                <hr />

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Quartos Cadastrados</div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Descrição</th>
                                <th>Camas</th>
                                <th>Tipo Preço</th>
                                <th>Valor R$</th>
                                <th>Status</th>
                                <th>Editar</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if(isset($this->roomsList))
                            foreach ($this->roomsList as $rooms)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $rooms->getDescription(); ?></td>
                                    <td><?php echo $rooms->getTypebeds(); ?></td>
                                    <td><?php echo $rooms->getCosttype(); ?></td>
                                    <td><?php echo $rooms->getCostroom(); ?></td>
                                    <td style="color:<?= $rooms->getStatus() == 'Livre' ? "#009f15;" : "#b92c28;"; ?>"><?php echo $rooms->getStatus(); ?></td>
                                    <td><a href="<?php echo URL; ?>admroom/edit/<?php echo $rooms->getRoomid(); ?>">Editar</a></td>
                                    <td><a class="delete" href="<?php echo URL; ?>admroom/delete/<?php echo $rooms->getRoomid(); ?>">Remover</a></td>
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