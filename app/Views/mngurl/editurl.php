<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Alteração de Aplicação Cadastrada</strong>
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
                        <form id="StaffSearchFormUser" onsubmit="return beforeFormSubmit()" action="<?php echo URL; ?>mngurls/editSave/<?php echo $this->url->getUrl_id();?>" method="POST" >
                            <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">
                                <div class="form-group" style="width: 1060px; border: 0px #b92c28 solid;">
                                    <div class="panel panel-primary"  style="width: 1060px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Páginas do Sistema...</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">
                                                <div class="form-group" style="width: 1060px; border: 0px #b92c28 solid;">
                                                    <div class="form-group" style="width: 510px;">
                                                        <label class="control-label" for="InputUrl">Página:</label>
                                                        <input type="text" style="width: 510px;" class="form-control text-center" autofocus name="page" value="<?php echo $this->url->getPage();?>" id="InputUrl">
                                                    </div>
                                                    <div class="form-group" style="width: 510px;">
                                                        <label class="control-label" for="InputAppName">Nome da Aplicação:</label>
                                                        <input type="text" style="width: 510px;" class="form-control text-center" autofocus name="app_name" value="<?php echo $this->url->getApp_name();?>" id="InputAppName">
                                                    </div>                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                            <div class="panel panel-primary"  style="width: 1060px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Observação da Aplicação..</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">
                                        <div class="form-group" style="width: 1060px; border: 0px #b92c28 solid;">
                                            <label for="InputNote">Observação:</label>
                                            <div>
                                                <textarea class="form-control left" style="width: 1030px;" name="note" id="InputNote"><?= $this->url->getNote();?></textarea>                                        
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <div class="form-group" style="width: 1024px; text-align: center; padding-top: 20px; padding-bottom: 20px; border: 0px #b92c28 solid;">
                                    <button type="submit" style="width: 250px;"  class="form-control btn btn-success">Confirmar</button>
                                    <button type="reset" style="width: 250px;"  class="form-control btn btn-danger">Limpar</button>
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
    function beforeFormSubmit() {
        //
        if ($("#InputUrl").val() == '' || $("#InputUrl").val() == null) {
            $msg = "Informe a Url!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputAppName").val() == '' || $("#InputAppName").val() == null) {
            $msg = "Informe o nome da Aplicação!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        //
        $('#DivErroMsg').html("");
        //
        return true;
    }

    function getMsg($msg) {
        //
        $strmsg = "<div  style='color: #b92c28; text-align: center;'  class='alert alert-block alert-info fade in'><button type='button' class='close' data-dismiss='alert'>×</button><h5 class='alert-heading'>";
        $strmsg += $msg;
        $strmsg += "</h5></div>";
        //
        return $strmsg;
    }


</script>
</div><!-- /container -->