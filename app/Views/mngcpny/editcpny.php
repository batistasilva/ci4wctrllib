<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small><strong>Alteração Cadastral de Empresa</strong></small>
                </span> 
                <?php
                // $smsg = Session::getSession('smsg');
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
                    //unset($_SESSION['createCompanyOkay']);
                    //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                    ?>
                <?php endif; ?>    
                <hr>                
                <div class="form-group" id="DivErroMsg">

                </div>
                <div class="row">
                    <div style="margin-left: 30px;">
                        <?php
                           echo form_open('ctrlcpny/cpnySave/' . $cpny->getCompany_id());
                        ?>
                            <br />
                            <div class="form-inline">
                                <div class="form-group" style="width: 600px;">
                                    <?php echo form_label('Razão Social:', 'InputRazao')?>
                                    <div>
                                        <input type="text"  style="width: 545px;" readonly="true"  class="form-control text-center" autofocus name="nameraz" value="<?php echo $cpny->getLongname(); ?>" id="InputRazao" placeholder="Razão Social" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,40}">
                                    </div>
                                    <?php echo form_label('Nome Fantasia:', 'InputNomefan')?>
                                    <div>
                                        <input type="text" style="width: 545px;" class="form-control text-center"  name="namefan" value="<?php echo $cpny->getShortname(); ?>" id="InputNomefan" placeholder="Nome Fantasia" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,40}">
                                    </div>
                                </div>                       
                                <div class="form-group"  style="width: 450px;">
                                    <label for="SelectStatus">Status:</label>
                                    <select name="status" class="form-control text-center" id="SelectStatus" style="width: 450px;">
                                        <option value="1"   <?php if ($cpny->getStatus() == '1') echo 'selected'; ?>>Ativo</option>
                                        <option value="0"   <?php if ($cpny->getStatus() == '0') echo 'selected'; ?>>Inativo</option>
                                    </select>                                    
                                    <label for="InputCnpj">CNPJ:</label>
                                    <div>
                                        <input type="text" style="width: 450px;" readonly="true" class="form-control text-center" autofocus name="numcnpj" value="<?php echo $cpny->getCnpj(); ?>" id="InputCnpj" placeholder="000.000.000/0000-00" onkeyup="maskIt(this, event, '###.###.###/####-##')" required pattern="\d{3}.\d{3}.\d{3}/\d{4}-\d{2}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline">
                                <div class="form-group" style="width: 600px; margin-top: 10px; margin-bottom: 10px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 290px; border: 0px #b92c28 solid;">
                                        <label class="control-label" for="InputZipCode">Cep:</label>
                                        <input type="text" style="width: 250px;" class="form-control text-center" autofocus name="zipcode" value="<?php echo $cpny->zipcode; ?>" id="InputZipCode" placeholder="Cep" onkeyup="maskIt(this, event, '#####-###')" required pattern="[0-9]{5}-[0-9]{3}">
                                        <input type="hidden" name="zipid" value="<?php echo $cpny->zipid; ?>" id="UpdtHiddenZipId">
                                    </div>
                                    <div class="form-group" style="width: 250px; border: 0px #b92c28 solid;">
                                        <button type="button" id="buttonZipCode" style="width: 250px;"  class="form-control btn btn-warning">Pesquisar</button>
                                    </div>  
                                </div>
                                <div class="form-group"  style="width: 450px;">
                                    <label for="InputIE">I.E.:</label>
                                    <div>
                                        <input type="text" style="width: 450px;" readonly="true"  class="form-control text-center" autofocus name="numie" value="<?php echo $cpny->getIe(); ?>" id="InputIE" placeholder="000.000.000.000" onkeyup="maskIt(this, event, '###.###.###.###')" required pattern="\d{3}.\d{3}.\d{3}.\d{3}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline">
                                <div class="form-group" style="width: 600px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 440px; border: 0px #b92c28 solid;">
                                        <label class="control-label" for="InputAddress">Endereço:</label>
                                        <input type="text" style="width: 440px;" class="form-control text-center" autofocus name="address" value="<?php echo $cpny->address; ?>" id="InputAddress" placeholder="Endereço" required pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,40}">
                                    </div>
                                    <div class="form-group" style="width: 100px; border: 0px #b92c28 solid;">
                                        <label class="control-label" for="InputNumber">Número:</label>
                                        <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="number"  value="<?php echo $cpny->addr_number; ?>"  id="InputNumber" placeholder="Número" required pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,15}">
                                    </div>
                                </div>
                                <div class="form-group"  style="width: 450px;">
                                    <label for="InputDistrict">Bairro:</label>
                                    <div>
                                        <input type="text" style="width: 450px;" class="form-control text-center" autofocus name="district"  value="<?php echo $cpny->district; ?>" id="InputDistrict" placeholder="Bairro ou Localidade" required pattern="[a-zA-Z.\u00C0-\u00ff\s]{0,30}">
                                    </div>
                                </div>   
                            </div>

                            <div class="form-inline">
                                <div class="form-group" style="width: 600px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 440px; border: 0px #b92c28 solid;">
                                        <label for="InputCity">Cidade:</label>
                                        <div>
                                            <input type="text" style="width: 440px;" class="form-control text-center" autofocus name="city" value="<?php echo $cpny->city; ?>" id="InputCity" placeholder="Cidade" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,25}">
                                        </div>
                                    </div>
                                    <div class="form-group"  style="width: 100px;">
                                        <label for="InputState">Estado:</label>
                                        <div>
                                            <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="state" value="<?php echo $cpny->state; ?>" id="InputState" placeholder="Estado" required pattern="[a-zA-Z]{0,2}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="width: 450px;">
                                    <label for="InputReference">Ponto de Referência:</label>
                                    <div>
                                        <input type="text" style="width: 450px;" class="form-control text-center" autofocus name="reference" value="<?php echo $cpny->reference; ?>" id="InputReference" placeholder="Referência..">
                                    </div> 
                                </div>
                            </div>

                            <div class="form-inline">
                                <div class="form-group"  style="width: 600px;">
                                    <div class="form-group"  style="width: 295px;">
                                        <label for="InputBusinessPhone">Telefone Comercial:</label>
                                        <div>
                                            <input type="tel" style="width: 245px;" class="form-control text-center" autofocus name="business_phone" value="<?php echo $cpny->getBussiness_phone(); ?>" id="InputBusinessPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" required pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                        </div>
                                        <label for="InputMobilPhone">Telefone Celular:</label>
                                        <div>
                                            <input type="tel" style="width: 245px;" class="form-control text-center" autofocus name="mobil_phone" value="<?= $cpny->getMobil_phone() == '0' ? "" : $cpny->getMobil_phone(); ?>" id="InputMobilPhone" placeholder="(00)00000-0000" onkeyup="maskIt(this, event, '(##)#####-####')" pattern="\([0-9]{2}\)([0-9\s-]{1})?[0-9]{4}-[0-9]{4}">
                                        </div> 
                                    </div>
                                    <div class="form-group"  style="width: 295px; ">
                                        <label for="InputNextelPhone">Nextel Número:</label>
                                        <div>
                                            <input type="tel" style="width: 245px;" class="form-control text-center" autofocus name="nextel_phone" value="<?= $cpny->getNextel_phone() == '0' ? "" : $cpny->getNextel_phone(); ?>" id="InputNextelPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                        </div>
                                        <label for="InputNextelID">Nextel ID:</label>
                                        <div>
                                            <input type="text" style="width: 245px;" class="form-control text-center" autofocus name="nextel_id" value="<?= $cpny->getNextelid() == '0' ? "" : $cpny->getNextelid(); ?>" id="InputNextelID" onkeyup="maskIt(this, event, '##*#####')" pattern="[0-9]{2}*[0-9]{6}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"  style="width: 470px;">
                                    <label for="InputEmail">Email:</label>
                                    <div>
                                        <input type="email" style="width: 450px;" class="form-control text-center" name="email" value="<?php echo $cpny->getEmail(); ?>" id="InputEmail1" placeholder="nome@provedora.com.br">
                                    </div>
                                    <label for="InputNote">Observação:</label>
                                    <div>
                                        <textarea class="form-control left" style="width: 450px;" name="message" id="InputNote"><?php echo $cpny->getNote(); ?></textarea>                                        
                                    </div> 
                                </div>
                            </div>  
                            <div class="form-inline">
                                <div class="form-group" style="width: 1024px; text-align: center; padding-top: 20px; padding-bottom: 20px; border: 0px #b92c28 solid;">
                                    <button type="submit" style="width: 250px;"  class="form-control btn btn-success">Confirmar</button>
                                    <button type="reset" style="width: 250px;"  class="form-control btn btn-danger">Limpar</button>
                                </div>  
                            </div>         
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $("#buttonZipCode").click(function () {
                $.ajax({url: "<?php echo base_url(); ?>mngcpny/srchzip?zipcode=" + $("#InputZipCode").val(), success: function (result) {
                        var obj = $.parseJSON(result);
                        if (obj !== false) {
                            //
                            $("#UpdtHiddenZipId").val(obj.id);
                            $("#InputAddress").val(obj.street);
                            $("#InputCity").val(obj.city);
                            $("#InputDistrict").val(obj.district);
                            $("#InputState").val(obj.state);
                            $("#InputReference").val(obj.complement);
                            //
                        } else {
                            $("#UpdtHiddenZipId").val('0');
                            $('#DivErroMsg').html("<div class='form-group' <div class='error col-xs-offset-1 col-xs-10'><div class='alert alert-warning alert-dismissable' style='text-align: center; background: #F6DFBD;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong  style='color: #CB3E3A;'>Cep não encontrado no cadastro, pesquise nos correios!!!</strong><br/><strong><a href='http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco' target='_blank'>Pesquisar nos Correios...</a></strong></div></div></div>");
                        }
                    }});
            });
        });

        /**  
         * Função Principal 
         * @param w - O elemento que será aplicado (normalmente this).
         * @param e - O evento para capturar a tecla e cancelar o backspace.
         * @param m - A máscara a ser aplicada.
         * @param r - Se a máscara deve ser aplicada da direita para a esquerda. Veja Exemplos.
         * @param a - 
         * @returns null  
         */
        function maskIt(w, e, m, r, a) {

            // Cancela se o evento for Backspace
            if (!e)
                var e = window.event
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

            if (code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g, '').length)
                return false;

            // Loop na máscara para aplicar os caracteres
            for (var x = 0, y = 0, z = mask.length; x < z && y < txt.length; ) {
                if (mask.charAt(x) != '#') {
                    ret += mask.charAt(x);
                    x++;
                } else {
                    ret += txt.charAt(y);
                    y++;
                    x++;
                }
            }

            // Retorno da função
            ret = (!r) ? ret : ret.reverse()
            w.value = pre + ret + pos;
        }

        // Novo método para o objeto 'String'
        String.prototype.reverse = function () {
            return this.split('').reverse().join('');
        };
    </script>
</div><!-- /container -->