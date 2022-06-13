<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Cadastro de Permissões do Sistema</strong>
                </span>  
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
                <hr> 

                <div class="form-group" id="DivErroMsg">
                </div>

                <div class="row">
                    <div style="margin-left: 30px; margin-bottom: 5px;">
                        <form id="RoleForm" action="<?php echo URL; ?>mngroles/addSave"  method="POST" >
                            <div class="form-inline center-block" style="width: 800px; border: 0px #b92c28 solid;">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Cadastro de Permissões...</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-inline" style="width: 700px; margin-bottom: 20px; margin-left: 50px; border: 0px #b92c28 solid;">
                                            <div class="form-group" style="width: 420px;">
                                                <label class="control-label" for="InputRoleName">Nome do Grupo:</label>
                                                <input id="InputRoleName"  type="text"   name="role_name" style="width: 420px;" class="form-control text-center"  placeholder="Nome do Grupo..." required pattern="[0-9a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                                <input id="InputHRoleID"   type="hidden" name="role_id"   value="<?php echo $this->role->getRole_id(); ?>">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin-top: 20px;">
                                                <button type="submit" id="ButtonSaveRole" style="width: 250px;"  class="form-control btn btn-success">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                            <div class="form-inline">
                                <div class="form-group" style="width: 1024px; text-align: center; padding-top: 20px; padding-bottom: 20px; border: 0px #b92c28 solid;">
                                    <a class="form-control btn btn-primary" style="width: 250px;" href="<?php echo URL; ?>index">Voltar ao Início</a>
                                </div>  
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>           
        </div>
    </div>          
</div>
<script>

</script>
</div><!-- /container -->