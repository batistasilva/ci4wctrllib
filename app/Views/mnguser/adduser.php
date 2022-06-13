<style>
    .btn-file {
        /* position: relative;
         overflow: visible;*/
    }
    .btn-file input[type=file] {
        top: 0;
        right: 0;
        width: 500px;
        min-height: 100%;
        font-size: 11px;
        text-align: left;
        filter: alpha(opacity=0);
        opacity: 10;
        outline: none;
        cursor: inherit;
        display: block;
    }
</style>
<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Cadastro de Usuário</strong>
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
                        <form id="StaffSearchFormUser" onsubmit="return beforeFormSubmit()" action="<?php echo URL; ?>mnguser/addSave"  method="POST" >
                            <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">
                                <div class="form-group" style="width: 700px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 350px;">
                                        <label for="ComboCompany">Empresa:</label>
                                        <select id="SELCompanyID" name="company_id" class="form-control text-center"style=" width: 350px;" >
                                            <?php
                                            if (isset($this->CpnyList))
                                                foreach ($this->CpnyList as $cpny) {
                                                    ?>
                                                    <option value="<?php echo $cpny->getCompany_id(); ?>"><?php echo $cpny->getLongname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div>

                                    <div class="form-group" style="width: 345px;">
                                        <label for="ComboLocal">Local de Trabalho:</label>
                                        <select id="SELLocal" name="acronym" class="form-control text-center" onChange="changeCustomer(this.value);" style=" width: 345px;" >
                                            <?php
                                            if (isset($this->LocalList))
                                                foreach ($this->LocalList as $local) {
                                                    ?>
                                                    <option value="<?php echo $local->getAcronym(); ?>"><?php echo $local->getShortname(); ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div> 

                                    <div class="form-group" style="width: 350px;">
                                        <label for="ComboCustomer">Cliente:</label>
                                        <input id="InputHCustomerID" type="hidden" name="customer_id"/>
                                        <select id="SELCustomerID" name="customer"  class="form-control text-center"style=" width: 350px;" >
                                            <option value="SEL">[Selecione]</option>
                                            <?php
                                            if (isset($this->CustList))
                                                foreach ($this->CustList as $cust) {
                                                    ?>
                                                    <option value="<?php echo $cust->getCustomer_id(); ?>"><?php echo $cust->getCorpname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                            <option value="WOC">[Todos]</option>  <!-- Without Customer-->       
                                        </select> 
                                    </div> 

                                    <div id="DivJobTitle" class="form-group" style="width: 345px;">
                                        <label for="ComboJobTitle">Função:</label>
                                        <input id="InputHJobtitleID" type="hidden" name="jobtitle_id">
                                        <select id="SELJobtitleID" name="jobtitle" class="form-control text-center" style=" width: 345px;" >
                                            <option value="SEL">[Selecione]</option>
                                            <?php
                                            if (isset($this->JobTitleList))
                                                foreach ($this->JobTitleList as $job) {
                                                    ?>
                                                    <option value="<?php echo $job->getJobtitle_id(); ?>"><?php echo $job->getShortname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                            <option value="WOJ">[Todos]</option><!-- Without Jobtitle-->
                                        </select> 
                                    </div>

                                    <div class="form-group" style="width: 700px; margin-bottom: 20px; text-align: center;">
                                        <button type="button" id="ButtonSearchStaff" style="width: 300px; margin-top: 10px;" class="form-control btn btn-danger">Pesquisar</button>
                                    </div> 

                                    <div id="StaffToUser" class="form-group" style="width: 700px;">
                                        <label for="ComboStaffs">Colaboradores:</label>
                                        <select id="SELStaffID" name="staff_id" onchange="setCustJobID(this.value);" class="form-control text-center" style="width: 700px;" >
                                            <option value="SEL">[Selecione]</option>
                                        </select> 
                                    </div>   

                                    <div class="panel panel-primary"  style="width: 700px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Usuário e Senha...</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-inline" style="width: 700px; border: 0px #b92c28 solid;">
                                                <div class="form-group" style="width: 700px; border: 0px #b92c28 solid;">
                                                    <div class="form-group" style="width: 220px;">
                                                        <label class="control-label" for="InputUsername">Usuário:</label>
                                                        <input type="text" value="<?php echo $this->user->getUsername(); ?>" style="width: 220px;" class="form-control text-center" autofocus name="username" id="InputUsername">
                                                    </div>
                                                    <div class="form-group" style="width: 220px;">
                                                        <label class="control-label" for="InputPassword">Senha:</label>
                                                        <input type="password" value="<?php echo $this->user->getPassword(); ?>" style="width: 220px;" class="form-control text-center" autofocus name="password" id="InputPassword">
                                                    </div>  
                                                    <div class="form-group" style="width: 220px;">
                                                        <label class="control-label" for="InputPasswordRepply">Confirmação:</label>
                                                        <input type="password" value="<?php echo $this->user->getPassword(); ?>" style="width: 220px;" class="form-control text-center" autofocus name="password_repply" id="InputPasswordRepply">
                                                    </div>                                               
                                                </div>
                                            </div>
                                            <div class="form-inline" style="width: 680px; border: 0px #b92c28 solid;">
                                                <div class="form-group" style="width: 335px; margin-top: 10px; margin-bottom: 10px; border: 0px #b92c28 solid;">
                                                    <div class="form-group" style="width: 335px;">
                                                        <label class="control-label" for="InputUserEmail">E-mail:</label>
                                                        <input type="email" value="<?php /* echo $this->user->getPassword(); */ ?>" style="width: 335px;" class="form-control text-center" autofocus name="useremail" id="InputUserEmail">
                                                    </div>                                                
                                                </div>    
                                                <div class="form-group" style="width: 330px; margin-top: 10px; margin-bottom: 10px; border: 0px #b92c28 solid;">
                                                    <div class="form-group" style="width: 330px;">
                                                        <label class="control-label" for="LabelUserType">Tipo de Usuários:</label>
                                                        <select id="UserTypeID" name="user_type_id" class="form-control text-center" style="width: 330px;" >
                                                            <option value="SEL">[Selecione]</option>
                                                        </select>                                                     
                                                    </div>                                                
                                                </div>                                                 
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                                <div class="form-group" style="width: 350px; height: 370px; text-align: center;border: 0px #b92c28 solid;">
                                    <div class="panel panel-primary"  style="width: 350px; margin-top: 5px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Foto do Colaborador...</h3>
                                        </div>
                                        <div class="panel-body">
                                            <img src="<?= $this->userv->getPhoto(); ?>" <?= $this->userv->getPhoto_wh(); ?>/>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="panel panel-primary"  style="width: 1060px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Observações para o Usuário..</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">
                                        <div class="form-group" style="width: 1060px; border: 0px #b92c28 solid;">
                                            <label for="InputNote">Observação:</label>
                                            <div>
                                                <textarea class="form-control left" style="width: 1030px;" name="message" id="InputNote"></textarea>                                        
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
    /**
     * Function to Search Staff to User
     * @param {type} param
     */
    $(document).ready(function () {
        $("#ButtonSearchStaff").click(function () {
            if (beforeSubmit() == true) {
                //
                var urlapp = "<?php echo URL; ?>mnguser/SearchStaff";
                console.log(urlapp);
                // 
                $.ajax({
                    type: "POST",
                    url: urlapp,
                    data: $('#StaffSearchFormUser').serialize()
                }).done(function (data) {
                    // show the response
                    $('#StaffToUser').html(data);
                    console.log("Result....: " + data);
                }).fail(function (data) {
                    $('#DivErroMsg').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed
                });
            }
        });

        //function to check empty field before data send.
        function beforeSubmit() {

            if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
            {
                $msg = "Selecione uma opção na combobox, para cliente!";
                $msg = getMsg($msg);

                $('#DivErroMsg').html($msg);
                return false;
            }

            if ($("#SELJobtitleID").val() == 'SEL') {
                $msg = "Selecion uma opção na combobox, para função!";
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
    });


    function beforeFormSubmit() {
        //
        if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
        {
            $msg = "Selecione uma opção na combobox, para cliente!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            return false;
        }

        if ($("#SELJobtitleID").val() == 'SEL') {
            $msg = "Selecione uma opção na combobox, para função!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#SELStaffID").val() == 'SEL') {
            $msg = "Selecione uma opção na combobox, para colaborador!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputUsername").val() == '' || $("#InputUsername").val() == null) {
            $msg = "Informe o nome de usuário desejado!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputPassword").val() == '' || $("#InputPassword").val() == null) {
            $msg = "Informe uma senha para o usuário!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputPasswordRepply").val() == '' || $("#InputPasswordRepply").val() == null) {
            $msg = "Informe a senha de confirmação!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputPassword").val() !== $("#InputPasswordRepply").val()) {
            $msg = "As senhas digitadas não são iguais!!!";
            $msg = getMsg($msg);

            $('#DivErroMsg').html($msg);
            //
            return false;
        }

        if ($("#InputUserEmail").val() == '' || $("#InputUserEmail").val() == null) {
            $msg = "Informe o e-mail do usuário!!!";
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

    /**
     * Function to search staff to
     * update staff to user 
     * @returns {undefined}     
     */
    function search_staffs() {
        //
        var url = '<?php echo URL; ?>mnguser/updateStaffList';
        //
        $.get(url, function (dataReturn) {
            $('#StaffToUser').html(dataReturn);
        });
        //
    }

    /**
     * Function to search customer_id and jobtitle_id to Staff selected 
     * and setting it to hidden field. 
     * @param {type} result_select
     * @returns {undefined}     
     */
    function setCustJobID(result_select) {
        //
        if (result_select !== 'SEL') {
            console.log("Staff Selected: " + result_select);
            //
            $staff_id = $('#SELStaffID').val();
            //
            var urlapp = "<?php echo URL; ?>mnguser/SearchStaffToID/" + $staff_id;

            console.log(urlapp);
            // 
            $.ajax({
                type: "POST",
                url: urlapp,
                data: $('#StaffSearchFormUser').serialize()
            }).done(function (data) {
                var obj = $.parseJSON(data);
                //
                $('#InputHCustomerID').val(obj.customer_id);
                $('#InputHJobtitleID').val(obj.jobtitle_id);
                $('#InputUserEmail').val(obj.email);
                //
                console.log(obj);
                //
            }).fail(function (data) {
                $('#DivErroMsg').html(data);
            });
        } else {
            //
            console.log("Staff Not Selected: " + result_select);
        }
        //
    }

</script>
</div><!-- /container -->