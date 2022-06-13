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
                    <strong>Alteração para Status - Colaborador</strong>
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
                        <br />   
                        <form class="contact" id="FormStatusStaff" action="<?php echo URL; ?>mngstaff/InactStaff/<?php echo $this->staff->getStaff_id(); ?>" method="POST">
                            <div class="form-inline" style="width: 800px; margin-left: 30%; border: 0px #b92c28 solid;"> 
                                <div class="form-group" style="width: 350px; height: 370px; text-align: center;border: 0px #b92c28 solid;">
                                    <div class="panel panel-primary"  style="width: 350px; margin-top: 15px; margin-bottom: 15px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Foto do Colaborador...</h3>
                                        </div>
                                        <div class="panel-body">
                                            <img src="<?= $this->staff->getPhoto(); ?>" <?= $this->staff->getPhoto_wh(); ?>/>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="form-inline" style="width: 800px; margin-left: 25%; margin-bottom: 10px; border: 0px #b92c28 solid;"> 
                                <div class="form-group">
                                    <input id="InputIDHidden" type="hidden">
                                </div>
                                <div class="form-group" style="width: 450px;">
                                    <label for="InputName">Nome:</label>
                                    <div>
                                        <input type="text" readonly value="<?php echo $this->staff->getName(); ?>" id="InputName" style="width: 450px;" class="form-control text-center" autofocus name="name">
                                    </div>                                
                                </div>
                            </div>
                            <div class="form-inline" style="width: 800px; margin-left: 25%; margin-top: 10px; margin-bottom: 35px; border: 0px #b92c28 solid;">
                                <div class="form-group" style="width: 225px;">
                                    <label for="ComboStaffStatus">Status:</label>
                                    <select name="status" disabled class="form-control text-center" style="width: 225px;" >
                                        <option value="A" <?php if ($this->staff->getStatus() == 'A') echo 'selected'; ?>>Ativo</option>
                                        <option value="I" <?php if ($this->staff->getStatus() == 'I') echo 'selected'; ?>>Inativo</option>
                                    </select> 
                                </div> 
                                <div class="form-group" style="width: 225px;">
                                    <label for="InputDateResignation">Data de Demissão:</label>
                                    <div>
                                        <input type="text" style="width: 225px;" class="form-control text-center"  name="resignation_date" id="InputResignation_date" onkeyup="maskIt(this, event, '##-##-####')" required placeholder="00-00-0000">
                                    </div>                                    
                                </div> 
                            </div>
                            <div class="form-inline" style="width: 800px; margin-left: 25%; margin-top: 10px; margin-bottom: 35px; border: 0px #b92c28 solid;">
                                <input class="btn btn-success" type="submit" value="Confirmar Alteração!" id="submitChangeStatus">
                            </div>                           
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
    /***
     * Funtion to change Status for Staff.
     */
    $(document).ready(function () {
        $("#submitChangeStatus").click(function () {
            //
            if (beforeSubmit() == true) {
                //
                $.ajax({
                    type: "POST",
                    url: "<?php echo URL; ?>mngstaff/ChangeStatus",
                    data: $('#FormStatusStaff').serialize()
                }).done(function (data) {
                    //var obj = $.parseJSON(data);
                    // show the response
                    $('#res-changestatus').html(data);
                    console.log("Result....: " + data);
                    $("#InputResignation_date").val('');

                }).fail(function (data) {
                    $('#res-bankbranch').html(data);
                    console.log("Posting Failed Result....: " + data);
                    // just in case posting your form failed
                });
            }
        });

        //function to check empty field before data send.
        function beforeSubmit() {

            // console.log("Inside beforeSubmit()");

            if (!$("#InputResignation_date").val()) //check empty input filed
            {
                $msg = "Informe a data Saída do Colaborador!";
                $msg = getMsg($msg);

                $("#res-changestatus").html($msg);
                return false;
            }

            $("#res-changestatus").html("");
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