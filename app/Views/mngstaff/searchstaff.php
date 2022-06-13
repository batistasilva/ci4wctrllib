<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Pesquisa de Colaboradores</strong>
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
                        <form id="StaffSearchForm">
                            <br />
                            <div class="form-inline" style="width: 1065px; border: 0px #009f15 solid;">

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
                                <div class="form-group" style="width: 350px;">
                                    <label for="ComboLocal">Local de Trabalho:</label>
                                    <select id="SELLocal" name="acronym" class="form-control text-center" onChange="changeCustomer(this.value);" style=" width: 350px;" >
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
                                    <label for="ComboStaffStatus">Status:</label>
                                    <select name="status" class="form-control text-center"style="width: 350px;" >
                                        <option value="A">Ativo</option>
                                        <option value="I">Inativo</option>
                                    </select> 
                                </div>                                    
                            </div>

                            <div class="form-inline" style="width: 1065px; border: 0px #009f15 solid;">
                                <div class="form-group" style="width: 350px;">
                                    <label for="ComboCustomer">Filtro por Cliente:</label>
                                    <select id="SELCustomerID"  name="customer_id" class="form-control text-center"style=" width: 350px;" >
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
                                <div id="DivJobTitle" class="form-group" style="width: 350px;">
                                    <label for="ComboJobTitle">Filtro por Função:</label>
                                    <select id="SELJobtitleID" name="jobtitle_id" class="form-control text-center" style=" width: 350px;" >
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
                                <div class="form-group" style="width: 350px;">
                                    <label for="ComboFilters">Outros Filtros:</label>
                                    <select name="filter" class="form-control text-center" onChange="showDivs(this.value);" style="width: 350px;" >
                                        <option value="SEL">[Selecione]</option>
                                        <option value="NME">Nome</option>
                                        <option value="ADM">Admissão</option>
                                        <option value="CPF">CPF</option>
                                        <option value="RG">RG</option>
                                    </select> 
                                </div>                                 
                            </div>                                                   

                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Pesquisa...</h3>
                                </div>
                                <div class="panel-body">
                                    <!-- Start Search by Name -->
                                    <div id="SearchByName" class="form-inline hidden" style="width: 1040px; border: 0px #009f15 solid;">
                                        <div class="form-group" style="width: 340px;">
                                            <label for="InputName">Nome/Nome do Meio:</label>
                                            <div>
                                                <input type="text"  style="width: 340px;" class="form-control text-center" autofocus name="name" id="InputName" placeholder="Nome/Nome do Meio..." required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                            </div>
                                        </div>
                                        <div class="form-group" id="StaffName" style="width: 340px;">
                                            <label for="InputSurname">Sobrenome:</label>
                                            <div>
                                                <input type="text" style="width: 340px;" class="form-control text-center"  name="surname" id="InputSurname" placeholder="Sobrenome..." required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 340px; text-align: center;">
                                            <button type="button" id="ButtonSearchByName" style="width: 300px; margin-top: 20px;" class="form-control btn btn-warning">Pesquisar</button>
                                        </div>    
                                    </div>
                                    <!-- End Search by name -->
                                    <!--
                                    ||
                                    -->
                                    <!-- Start Search by Date Admission -->
                                    <div id="SearchByDateAdmission" class="form-inline hidden" style="width: 1040px; border: 0px #009f15 solid;">
                                        <div class="form-group" id="StaffDateAdm" style="width: 170px;">
                                            <label for="InputDateAdmission">Data de Admissão:</label>
                                            <div>
                                                <input type="text" style="width: 165px;" class="form-control text-center"  name="dateadm" id="InputDateAdmission" onkeyup="maskIt(this, event, '##-##-####')" required placeholder="00-00-0000">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 200px; text-align: center;">
                                            <button type="button" id="ButtonSearchByDateAdmis" style="width: 200px; margin-top: 20px;" class="form-control btn btn-warning">Pesquisar</button>
                                        </div>  
                                    </div>
                                    <!-- End Search by Date Admission -->

                                    <!-- Start Search by CPF -->
                                    <div id="SearchByCpf" class="form-inline hidden" style="width: 1040px; border: 0px #009f15 solid;">
                                        <div class="form-group" id="StaffCpf" style="width: 170px;">
                                            <label for="InputCpf">Cpf:</label>
                                            <div>
                                                <input type="text" style="width: 150px;"  class="form-control text-center" autofocus name="numcpf" id="InputCpf" placeholder="000.000.000-00" onkeyup="maskIt(this, event, '###.###.###-##')" required x-moz-errormessage="Preencha o campo com o CPF!" pattern="\d{3}.\d{3}.\d{3}-\d{2}">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 200px; text-align: center;">
                                            <button type="button" id="ButtonSearchByCpf" style="width: 200px; margin-top: 20px;" class="form-control btn btn-warning">Pesquisar</button>
                                        </div>  
                                    </div>
                                    <!-- End Search by Cpf -->

                                    <!-- Start Search by RG -->
                                    <div id="SearchByRG" class="form-inline hidden" style="width: 1040px; border: 0px #009f15 solid;">
                                        <div class="form-group" id="StaffRG" style="width: 170px;">
                                            <label for="InputRg">RG:</label>
                                            <div>
                                                <input type="text" style="width: 160px;" class="form-control text-center" autofocus name="numrg" id="InputRG" placeholder="00000000-00" required pattern="[0-9a-zA-Z-]{0,12}">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 200px; text-align: center;">
                                            <button type="button" id="ButtonSearchByRG" style="width: 200px; margin-top: 20px;" class="form-control btn btn-warning">Pesquisar</button>
                                        </div>  
                                    </div>
                                    <!-- End Search by RG -->                                    

                                </div>     
                                <!-- End Doc/Information -->                              
                            </div>

                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Dados Encontrados...</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table" id = "TableSearch">
                                    </table>
                                </div>
                            </div>     <!-- End Doc/Information -->                       
                        </form>  
                    </div>
                </div>
            </div>           
        </div>
        <div class="form-inline">
            <div class="form-group" style="width: 1024px; padding-top: 20px; padding-bottom: 20px; text-align: center; border: 0px #b92c28 solid;">
                <a class="form-control btn btn-primary" style="width: 250px;" href="<?php echo URL; ?>index">Voltar ao Início</a>
            </div>  
        </div>
    </div>          
</div>

<script>
    /**
     * Function to Search Staff to Filter Name
     * @param {type} param
     */
    $(document).ready(function () {
        $("#ButtonSearchByName").click(function () {
            if (beforeSubmit() == true) {
                //
                var urlapp = "<?php echo URL; ?>mngstaff/SearchByName";
                console.log(urlapp);
                // 
                $.ajax({
                    type: "POST",
                    url: urlapp,
                    data: $('#StaffSearchForm').serialize()
                }).done(function (data) {
                    // show the response
                    $('#TableSearch').html(data);
                    console.log("Result....: " + data);
                }).fail(function (data) {
                    $('#TableSearch').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed
                });
            }
        });

        //function to check empty field before data send.
        function beforeSubmit() {

            if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
            {
                $msg = "Selecione uma Opção na Combobox, para Cliente!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                return false;
            }

            if ($("#SELJobtitleID").val() == 'SEL') {
                $msg = "Selecion uma Opção na Combobox, para Função!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            if (!$("#InputName").val()) {
                $msg = "Informe o Nome do Colaborador, Nome/Nome do Meio!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            if (!$("#InputSurname").val()) {
                $msg = "Informe o Sobrenome!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }
            //
            $('#TableSearch').html("");
            //
            return true;
        }

        function getMsg($msg) {
            //
            $strmsg = "<div class='alert alert-block alert-danger fade in'><button type='button' class='close' data-dismiss='alert'>×</button><h4 class='alert-heading'>";
            $strmsg += $msg;
            $strmsg += "</h4></div>";
            //
            return $strmsg;
        }
    });

    /**
     * Function to Search Staff to Filter Date Admission 
     */
    $(document).ready(function () {
        $('#ButtonSearchByDateAdmis').click(function () {
            if (beforeSubmit() == true) {
                var urlapp = "<?php echo URL; ?>mngstaff/SearchByDateAdmis";
                console.log(urlapp);
                $.ajax({
                    type: 'POST',
                    url: urlapp,
                    data: $('#StaffSearchForm').serialize()
                }).done(function (data) {
                    // show the response
                    $('#TableSearch').html(data);
                    console.log("Result....: " + data);
                }).fail(function (data) {
                    $('#TableSearch').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed           
                });
            }
        });

        //function to check empty field before data send.
        function beforeSubmit() {

            if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
            {
                $msg = "Selecione uma Opção na Combobox, para Cliente!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                return false;
            }

            if ($("#SELJobtitleID").val() == 'SEL') {
                $msg = "Selecion uma Opção na Combobox, para Função!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            if (!$("#InputDateAdmission").val()) {
                $msg = "Informe a data de Admissão do Colaborador!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            //
            $('#TableSearch').html("");
            //
            return true;
        }

        function getMsg($msg) {
            //
            $strmsg = "<div class='alert alert-block alert-danger fade in'><button type='button' class='close' data-dismiss='alert'>×</button><h4 class='alert-heading'>";
            $strmsg += $msg;
            $strmsg += "</h4></div>";
            //
            return $strmsg;
        }
    });

    /**
     * Function to Search Staff to Filter Cpf
     */
    $(document).ready(function () {
        $('#ButtonSearchByCpf').click(function () {
            //
            if (beforeSubmit() == true) {
                var urlapp = "<?php echo URL; ?>mngstaff/SearchByCpf";
                console.log(urlapp);
                $.ajax({
                    type: 'POST',
                    url: urlapp,
                    data: $('#StaffSearchForm').serialize()
                }).done(function (data) {
                    // show the response
                    $('#TableSearch').html(data);
                    console.log("Result....: " + data);
                }).fail(function (data) {
                    $('#TableSearch').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed              
                });
            }
        });
        //
        //function to check empty field before data send.
        function beforeSubmit() {

            if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
            {
                $msg = "Selecione uma Opção na Combobox, para Cliente!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                return false;
            }

            if ($("#SELJobtitleID").val() == 'SEL') {
                $msg = "Selecion uma Opção na Combobox, para Função!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            if (!$("#InputCpf").val()) {
                $msg = "Informe o CPF do Colaborador!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            //
            $('#TableSearch').html("");
            //
            return true;
        }

        function getMsg($msg) {
            //
            $strmsg = "<div class='alert alert-block alert-danger fade in'><button type='button' class='close' data-dismiss='alert'>×</button><h4 class='alert-heading'>";
            $strmsg += $msg;
            $strmsg += "</h4></div>";
            //
            return $strmsg;
        }

    });

    /**
     * Function to Staff Search by RG. 
     */
    $(document).ready(function () {
        $('#ButtonSearchByRG').click(function () {
            //
            if (beforeSubmit() == true) {
                var urlapp = "<?php echo URL; ?>mngstaff/SearchByRG";
                console.log(urlapp);
                $.ajax({
                    type: 'POST',
                    url: urlapp,
                    data: $('#StaffSearchForm').serialize()
                }).done(function (data) {
                    // show the response
                    $('#TableSearch').html(data);
                    console.log("Result....: " + data);
                }).fail(function (data) {
                    $('#TableSearch').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed              
                });
            }
            //
        });

        //function to check empty field before data send.
        function beforeSubmit() {

            if ($("#SELCustomerID").val() == 'SEL') //check empty input filed
            {
                $msg = "Selecione uma Opção na Combobox, para Cliente!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                return false;
            }

            if ($("#SELJobtitleID").val() == 'SEL') {
                $msg = "Selecion uma Opção na Combobox, para Função!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            if (!$("#InputRG").val()) {
                $msg = "Informe o RG do Colaborador!";
                $msg = getMsg($msg);

                $('#TableSearch').html($msg);
                //
                return false;
            }

            //
            $('#TableSearch').html("");
            //
            return true;
        }

        function getMsg($msg) {
            //
            $strmsg = "<div class='alert alert-block alert-danger fade in'><button type='button' class='close' data-dismiss='alert'>×</button><h4 class='alert-heading'>";
            $strmsg += $msg;
            $strmsg += "</h4></div>";
            //
            return $strmsg;
        }
    });


    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function showDivs(resSelect) {
        //
        if (resSelect === 'NME') {
            $('#SearchByName').removeClass('hidden'); //To Show
            ///
            $('#SearchByDateAdmission').addClass('hidden'); //To Hide
            $('#SearchByCpf').addClass('hidden'); //To Hide
            $('#SearchByRG').addClass('hidden'); //To Hide
            //
        }
        else if (resSelect === 'ADM') {
            $('#SearchByDateAdmission').removeClass('hidden'); //To Show  
            //
            $('#SearchByName').addClass('hidden'); //To Hide       
            $('#SearchByCpf').addClass('hidden'); //To Hide
            $('#SearchByRG').addClass('hidden'); //To Hide
        }
        else if (resSelect === 'CPF') {
            $('#SearchByCpf').removeClass('hidden'); //To Show    
            //
            $('#SearchByDateAdmission').addClass('hidden'); //To Hide        
            $('#SearchByName').addClass('hidden'); //To Hide       
            $('#SearchByRG').addClass('hidden'); //To Hide
        }
        else if (resSelect === 'RG') {
            $('#SearchByRG').removeClass('hidden'); //To Show    
            //
            $('#SearchByCpf').addClass('hidden'); //To Hide      
            $('#SearchByDateAdmission').addClass('hidden'); //To Hide        
            $('#SearchByName').addClass('hidden'); //To Hide       

        }
        else if (resSelect === 'SEL') {
            $('#SearchByRG').addClass('hidden'); //To Hide      
            $('#SearchByCpf').addClass('hidden'); //To Hide      
            $('#SearchByDateAdmission').addClass('hidden'); //To Hide        
            $('#SearchByName').addClass('hidden'); //To Hide       
        }

        //
        console.log("Value of Select: " + resSelect);
    }


    /* Version 0.27 */

    /**  
     * Função Principal           * @param w - O elemento que será aplicado (normalmente this).      * @param e - O evento para capturar a tecla e cancelar o backspace.
     * @param m - A máscara a ser aplicada.
     * @param r - Se a máscara deve ser aplicada da direita para a esquerda. Veja Exemplos.
     * @param a - 
     * @returns null  
     */
    function maskIt(w, e, m, r, a) {

// Cancela se o evento for Backspace
        if (!e)
            var e = window.event;
        if (e.keyCode)
            code = e.keyCode;
        else if (e.which)
            code = e.which;
        // Variáveis da função             
        var txt = (!r) ? w.value.replace(/[^\d]+/gi, '') : w.value.replace(/[^\d]+/gi, '').reverse();
        var mask = (!r) ? m : m.reverse();
        var pre = (a) ? a.pre : "";
        var pos = (a) ? a.pos : "";
        var ret = "";
        if (code === 9 || code === 8 || txt.length === mask.replace(/[^#]+/g, '').length)
            return false;
// Loop na máscara para aplicar os caracteres
        for (var x = 0, y = 0, z = mask.length; x < z && y < txt.length; ) {
            if (mask.charAt(x) !== '#') {
                ret += mask.charAt(x);
                x++;
            } else {
                ret += txt.charAt(y);
                y++;
                x++;
            }
        }

// Retorno da função
        ret = (!r) ? ret : ret.reverse();
        w.value = pre + ret + pos;
    }
// Novo método para o objeto 'String'
    String.prototype.reverse = function () {
        return this.split('').reverse().join('');
    };


</script>
</div><!-- /container -->