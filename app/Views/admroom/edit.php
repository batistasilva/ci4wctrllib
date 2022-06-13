<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Alteração de Quartos</strong></small>
                </span>   
                <hr>
                <form method="post" action="<?php echo URL; ?>admroom/editSave/<?php echo $this->rooms->getRoomid(); ?>" class="form-horizontal">
                    <div class="row">
                        <label class="control-label col-xs-2" for="InputDesc">Descrição do Quarto:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" autofocus name="descrip" value="<?php echo $this->rooms->getDescription(); ?>" id="InputDesc" placeholder="Descrição do Quarto" required pattern="[a-zA-Z0-9\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                        <label class="control-label col-xs-1" for="InputTypeBed">Camas:</label>
                        <div class="col-xs-5">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control text-center" name="typebeds" value="<?php echo $this->rooms->getTypebeds(); ?>" id="InputTypeBed" placeholder="Camas: Casal=0, Solteiro=0" required pattern="[a-zA-Z0-9\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputCostType">Descrição de Preço:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" name="costtype" value="<?php echo $this->rooms->getCosttype(); ?>" id="InputCostType" placeholder="Normal ou Promoção" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                        <label class="control-label col-xs-1" for="InputCostRoom">Valor:</label>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" class="form-control text-center" name="costroom" value="<?php echo $this->rooms->getCostroom(); ?>" id="InputCustRoom" placeholder="9,99" required pattern="[0-9,]{0,11}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="SelectStatus">Status do Quarto</label>
                        <div class="col-xs-4">
                            <select name="status" class="form-control text-center">
                                <option value="Livre" <?php if ($this->rooms->getStatus() == 'Livre') echo 'selected'; ?>>Livre</option>
                                <option value="Ocupado" <?php if ($this->rooms->getStatus() == 'Ocupado') echo 'selected'; ?>>Ocupado</option>
                            </select><br />
                        </div>
                    </div>
                    <hr>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="InputComplement">Descrição Complementar:</label>
                        <div class="col-xs-6">
                            <div class="input-group col-xs-12">
                                <textarea class="form-control input-sm text-left" rows="3" name="complement" placeholder="Entre com um Texto" id="InputComplement" required><?= $this->rooms->getComplement();?></textarea>  
                            </div>
                        </div>
                    </div>
                    
                    <hr>                    
                    <?php if (isset($_SESSION['roomsErrorMsg'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-warning alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['roomsErrorMsg']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['roomsErrorMsg']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>                    
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-warning">Confirmar</button>
                        </div>
                    </div>   
                </form>
                <hr />
            </div>
        </div>
    </div>
</div>
</div><!-- /container -->