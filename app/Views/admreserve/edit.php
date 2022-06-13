<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Alteração de Reservas</strong></small>
                </span>
                <form method="post" name="EditFormRsv"  action="<?php echo URL; ?>admreserve/saveEdit/<?php echo $this->rsv->getRsvid(); ?>" class="form-horizontal">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="thumbnail">
                                <div class="caption text-center">
                                    <h3><?php echo $this->rsv->getDescription(); ?></h3>
                                </div>
                                <img src="<?php echo URL . $this->rsv->getImagem(); ?>" width="200" height="100" alt="" class="img-thumbnail">
                                <div class="caption text-center">
                                    <h4><?php echo $this->rsv->getTypebeds(); ?></h4>
                                    <p><?php echo $this->rsv->getComplement(); ?></p>
                                    <h3><?php echo $this->rsv->getCosttype(); ?></h3>
                                    <h3><?php echo 'R$ ' . $this->rsv->getCostroom(); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="InputDateCheckIn">Data do Check-In:</label>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <input type="text" class="form-control text-center" name="date_checkin" value="<?php echo $this->rsv->getCheckin(); ?>" id="InputDateCheckIn" onkeyup="maskIt(this, event, '##-##-####')" placeholder="99-99-9999" required pattern="[0-9]{2}-[0-9,]{2}-[0-9,]{4}">
                            </div>
                        </div>          
                        <label class="control-label col-xs-2" for="InputDateCheckOut">Data do Check-Out:</label>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <input type="text" class="form-control text-center" name="date_checkout" value="<?php echo $this->rsv->getCheckout(); ?>" id="InputDateCheckOut" onkeyup="maskIt(this, event, '##-##-####')" placeholder="99-99-9999" required pattern="[0-9]{2}-[0-9,]{2}-[0-9,]{4}">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <input type="button" class="form-control text-center btn btn-default" id="ButtonCheckDates" onclick="CalcDaysDate();"  value="Calcular Reserva">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-9">Valor Total: R$</label>
                        <div class="col-xs-2">
                            <div class="input-group">
                                <label class="control-label text-center" id="LabelTotalCost" style="font-size:xx-large;">0,00</label>
                                <input type="hidden" id="InputCostRoom"     name="costroom"     value="<?php echo $this->rsv->getCostroom(); ?>" >
                                <input type="hidden" id="InputTotalReserve" name="totalreserve" value="" >
                                <input type="hidden" id="InputDaysQty"      name="daysqty"      value="" >
                                <input type="hidden" id="InputCustId"       name="custid"       value="<?php echo $this->rsv->getCustid(); ?>" >
                                <input type="hidden" id="InputRoomId"       name="roomid"       value="<?php echo $this->rsv->getRoomid(); ?>" >
                                <input type="hidden" id="InputDescription"  name="description"  value="<?php echo $this->rsv->getDescription(); ?>" >
                                <input type="hidden" id="InputImagem"       name="imagem"       value="<?php echo URL . $this->rsv->getImagem(); ?>" >
                                <input type="hidden" id="InputTypeBeds"     name="typebeds"     value="<?php echo $this->rsv->getTypebeds(); ?>" >
                                <input type="hidden" id="InputComplement"   name="complement"   value="<?php echo $this->rsv->getComplement(); ?>" >
                                <input type="hidden" id="InputCostType"     name="costtype"     value="<?php echo $this->rsv->getCosttype(); ?>" >
                            </div>
                        </div>
                    </div>

                    <hr>
                    <?php if (isset($_SESSION['updtErrorRsvCust'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-warning alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['updtErrorRsvCust']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['updtErrorRsvCust']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>                     
                    <div class="form-group">
                        <div class="col-xs-offset-1">
                            <button type="submit" class="btn btn-warning">Confirmar</button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        function getElementDateByid(element) {
            return document.getElementById(element);
        }

        function CalcDaysDate() {
            var getDate1 = getElementDateByid('InputDateCheckIn').value;
            var getDate2 = getElementDateByid('InputDateCheckOut').value;
            //
            var errodate = false;
            //
            if (getDate1.length == 10 && getDate2.length == 10) {
                //
                var date1_arr = getDate1.split('-');
                var date2_arr = getDate2.split('-');

                var date1str = date1_arr[1] + '/' + date1_arr[0] + '/' + date1_arr[2];
                var date2str = date2_arr[1] + '/' + date2_arr[0] + '/' + date2_arr[2];

                var myDate1 = new Date(date1str);//'06-05-2014 21,07,00'
                var myDate2 = new Date(date2str);//'06-05-2014 21,07,00'

                if (myDate1 <= new Date()) {
                    alert('Data de Check-In: ('+ getDate1+ ') deve ser maior que a data de hoje: '+ new Date());
                    errodate = true;
                }

                if (myDate1 > myDate2) {
                    alert('Data de CheckIn: ('+ getDate1+ ') deve ser inferior a do CheckOut: (' + getDate2+')');
                    errodate = true;
                }
                //
            } else {
                alert('Os Campos datas (CheckIn e CheckOut) precisam ser preenchidos');
                errodate = true;
            }

            if (!errodate) {
                var getCostRoom = getElementDateByid('InputCostRoom').value.replace(',', '.');
                var result = (myDate2 - myDate1) / (1000 * 60 * 60 * 24);

                //
                console.log(getCostRoom);
                console.log(result);
                console.log(myDate1);
                console.log(myDate2);

                var value = parseFloat(getCostRoom);
                var calc = parseFloat(result * value);

                console.log(calc.toFixed(2));

                getElementDateByid('InputTotalReserve').value = calc.toFixed(2);
                getElementDateByid('InputDaysQty').value = result;
                document.getElementById("LabelTotalCost").innerHTML = calc.toFixed(2);
            }
        }

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
        String.prototype.reverse = function() {
            return this.split('').reverse().join('');
        };

    </script>  
</div><!-- /container -->