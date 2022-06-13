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
                        <form id="RoleForm"  action="<?php echo URL; ?>mngroles/editSave/"  method="POST" >
                            <div class="form-inline center-block" style="width: 900px; border: 0px #b92c28 solid;">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Cadastro de Permissões...</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-inline" style="width: 850px; border: 0px #b92c28 solid;">
                                            <div class="form-group" style="width: 420px;">
                                                <label class="control-label" for="InputRoleName">Nome do Grupo:</label>
                                                <input id="InputRoleName" type="text" readonly name="role_name" value="<?php echo $this->role->getRole_name(); ?>" style="width: 420px;" class="form-control text-center" autofocus >
                                                <input id="InputHRoleID"  type="hidden"        name="role_id"   value="<?php echo $this->role->getRole_id(); ?>">
                                            </div>
                                            <div class="form-group" style="width: 420px;">
                                                <label for="ComboAppName">Aplicação:</label>
                                                <select id="SELUrlID" name="url_id"  onChange="setUrlInField(this.value);"  class="form-control text-center" style=" width: 420px;" >
                                                    <option value="SEL">[Selecione]</option>
                                                    <?php
                                                    if (isset($this->AppList))
                                                        foreach ($this->AppList as $app) {
                                                            ?>
                                                            <option value="<?php echo $app->getUrl_id(); ?>"><?php echo $app->getApp_name(); ?></option>                        
                                                            <?php
                                                        }
                                                    ?>
                                                </select> 
                                            </div> 
                                        </div>
                                        <div class="form-inline" style="width: 850px; margin-bottom: 20px; border: 0px #b92c28 solid;">
                                            <div class="form-group" style="width: 420px; border: 0px #b92c28 solid;">
                                                <label class="control-label" for="InputAppUrl">Página da Aplicação:</label>
                                                <input id="InputAppUrl" type="text" readonly  name="app_url" style="width: 420px;" class="form-control text-center" autofocus >
                                            </div>
                                            <div class="form-group" style="width: 420px; text-align: center; border: 0px #b92c28 solid;">
                                                <button type="submit" disabled id="ButtonAddApp" style="width: 200px; margin-top: 20px;" class="form-control btn btn-danger">Adicionar</button>
                                            </div> 
                                        </div>                                                      
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-inline center-block" style="width: 900px; border: 0px #b92c28 solid;">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Módulo do Grupo...</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-inline" style="width: 850px; border: 0px #b92c28 solid;">
                                            <div id="RolesList" class="scroll-area" data-spy="scroll" data-offset="0" style="width:850px; height:200px; overflow: auto;">
                                                <table cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 260px; text-align: center;">Aplicação</th>
                                                            <th style="width: 260px; text-align: center;">Url</th>
                                                            <th style="width: 260px; text-align: right;">Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($this->RolesList))
                                                            foreach ($this->RolesList as $role) {
                                                                ?>
                                                                <tr>
                                                                    <td  style="width: 260px;">
                                                                        <?php echo $role->getApp_name(); ?>
                                                                    </td>
                                                                    <td  style="width: 260px;">
                                                                        <?php echo $role->getUrl_name(); ?>
                                                                    </td>
                                                                    <td style="width: 260px; text-align: right;"><a href="<?php echo URL; ?>mngroles/rmAppToRole/<?php echo $role->getRole_id(); ?>/<?php echo $role->getUrl_id(); ?>">Remover</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                    </tbody>
                                                </table>
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

    /**
     * Function to get Class Urlpage
     * to set to field url. 
     * @param {type} selected
     * @returns {undefined}     */
    function setUrlInField(selected) {
        //
        if (selected !== 'SEL') {
            //
            $role_id = $('#InputHRoleID').val();
            $url_id = $('#SELUrlID').val();
            //
            var urlapp = "<?php echo URL; ?>mngroles/ValidURLToID/" + $role_id + "/" + $url_id;
            console.log(urlapp);

            $.get(urlapp, function (dataReturn) {
                
                //console.log(dataReturn);
                var obj = $.parseJSON(dataReturn);
                console.log(obj);
                //
                if (obj.url_id == $url_id) {
                    //Disable button to not allow add item
                    $("#ButtonAddApp").prop('disabled', true); //To Disable
                    //Show message
                    $msg = "Item já Pertence ao Grupo!!!";
                    $msg = getMsg($msg);
                    //Show Error
                    $('#DivErroMsg').html($msg);
                    //Clean field
                    $('#InputAppUrl').val('');
                } else {
                    //Enable button to allow add item
                    $("#ButtonAddApp").prop('disabled', false); //To Enable
                    //Call app to get app name to show in field
                    getAppName();
                }
            });
           // console.log(result);
        } else {
            //In not selected item disable button
            $("#ButtonAddApp").prop('disabled', true); //To Disable
            //Clean field app url
            $('#InputAppUrl').val('');
            //console.log("UrlPage Not Selected: " + selected);
        }
        
        /**
         * Function to get app name to show in
         * field to form.
         * @returns {undefined}
         */
        function getAppName() {
            //console.log("Appication Selected: " + selected);
            //
            $url_id = $('#SELUrlID').val();
            //
            var urlapp = "<?php echo URL; ?>mngroles/SearchRoleToID/" + $url_id;
            //console.log(urlapp);
            // 
            $.ajax({
                type: "POST",
                url: urlapp,
                data: $('#RoleForm').serialize()
            }).done(function (data) {
                var obj = $.parseJSON(data);
                //Settin object app name to field
                $('#InputAppUrl').val(obj.page);
                //Enable button to allow add item
                $("#ButtonAddApp").prop('disabled', false); //To Enable
                //
                //console.log(obj);
                //
            }).fail(function (data) {
                //Show error message in window
                $('#DivErroMsg').html(data);
            });

        }

    }
    /**
     * Custom message to show in window. 
     * @param {type} $msg
     * @returns {$strmsg|String}     */ 
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