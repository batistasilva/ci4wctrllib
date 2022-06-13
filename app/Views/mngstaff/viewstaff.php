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
                    <strong>Ficha do Colaborador</strong>
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
                        <div class="form-inline" style="width: 1060px; border: 0px #b92c28 solid;">

                            <div class="form-group" style="width: 700px; border: 0px #b92c28 solid;">
                                <div class="form-group" style="width: 670px;">
                                    <div class="form-group" style="width: 500px;">
                                        <label for="InputCompanyName">Empresa:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getCompany_name(); ?>"  style="width: 500px;" class="form-control text-center" autofocus name="company_name" id="InputCompanyName">
                                        </div>
                                    </div>     
                                    <div class="form-group" style="width: 165px;">
                                        <label for="InputLocalName">Local:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getLocal_name(); ?>"  style="width: 165px;" class="form-control text-center" autofocus name="local_name" id="InputLocalName">
                                        </div>
                                    </div> 
                                </div> 
                                <div class="form-group" style="width: 670px;">
                                    <div class="form-group" style="width: 670px;">
                                        <label for="InputCustomerName">Cliente:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getCustomer_name(); ?>"  style="width: 670px;" class="form-control text-center" autofocus name="customer_name" id="InputCustomerName">
                                        </div>
                                    </div>       
                                </div>                                 
                                <div class="form-group" style="width: 670px;">
                                    <div class="form-group" style="width: 500px;">
                                        <label for="StaffName">Nome:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getName(); ?>"  style="width: 500px;" class="form-control text-center" autofocus name="name" id="InputStaffName">
                                        </div>
                                    </div>     
                                    <div class="form-group" style="width: 165px;">
                                        <label for="InputDateBirth">Nascimento:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getDate_birth(); ?>"  style="width: 165px;" class="form-control text-center" autofocus name="date_birth" id="InputDateBirth">
                                        </div>
                                    </div> 
                                </div>

                                <div class="form-group" style="width: 670px;">
                                    <div id="DivJobTitle" class="form-group" style="width: 500px;">
                                        <label for="StaffJobTitle">Função:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getJobtitle(); ?>" style="width: 670px;" class="form-control text-center"  name="jobtitle_id" id="InputJobTitleID">
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group" style="width: 670px; border: 0px #b92c28 solid;">
                                    <div class="panel panel-primary"  style="width: 670px; margin-top: 15px; margin-bottom: 15px;">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Admissão e Saída da Empresa...</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group" style="width: 670px;">
                                                <div class="form-group" style="width: 220px;">
                                                    <label for="InputDateAdm">Data de Admissão:</label>
                                                    <div>
                                                        <input type="text" readonly value="<?php echo $this->staff->getDate_admis(); ?>" style="width: 150px;" class="form-control text-center"  name="dateadm" id="InputDateAdm">
                                                    </div>                                    
                                                </div>
                                                <div class="form-group" style="width: 220px;">
                                                    <label for="InputDateResignation">Data de Demissão:</label>
                                                    <div>
                                                        <input type="text" readonly value="<?php echo $this->staff->getResignation_date(); ?>" style="width: 150px;" class="form-control text-center"  name="resignation_date" id="InputResignation_date">
                                                    </div>                                    
                                                </div> 
                                                <div class="form-group" style="width: 220px;">
                                                    <label for="StaffStatus">Status:</label>
                                                    <div>
                                                        <input type="text" readonly value="<?= $this->staff->getStatus() == 'A' ? 'Ativo' : 'Inativo'; ?>"  style="width: 150px;" class="form-control text-center" autofocus name="status" id="InputStatus">
                                                    </div>
                                                </div>                                                
                                            </div>                                       
                                        </div>
                                    </div>    
                                </div>                                

                                <div class="panel panel-primary"  style="width: 670px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Meio de Transporte para o Trabalho...</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group" style="width: 670px;">
                                            <div id="DivJobTitle" class="form-group" style="width: 150px;">
                                                <label for="TransportTicketYN">Vale Transporte(S/N):</label>
                                                <div>
                                                    <input type="text" readonly value="<?= $this->staff->getTransp_ticket() == 'Y' ? 'SIM' : 'NÃO'; ?>" style="width: 150px;" class="form-control text-center"  name="transp_ticket" id="TransportTicketYN">
                                                </div>                                            
                                            </div>
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTQt1">Quant-1:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkqt1(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkqt1" id="InputTPTQt1">
                                                </div>                                    
                                            </div> 
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTVl1">Valor-1:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkvl1(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkvl1" id="InputTPTVl1">
                                                </div>                                    
                                            </div>   
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTQt2">Quant-2:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkqt2(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkqt2" id="InputTPTQt2">
                                                </div>                                    
                                            </div> 
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTVl2">Valor-2:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkvl2(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkvl2" id="InputTPTVl2">
                                                </div>                                    
                                            </div>  
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTQt3">Quant-3:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkqt3(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkqt3" id="InputTPTQt3">
                                                </div>                                    
                                            </div> 
                                            <div class="form-group" style="width: 80px;">
                                                <label for="InputTPTVl3">Valor-3:</label>
                                                <div>
                                                    <input type="text" readonly value="<?php echo $this->staff->getTransptkvl3(); ?>" style="width: 80px;" class="form-control text-center"  name="transptkvl3" id="InputTPTVl3">
                                                </div>                                    
                                            </div>                                      
                                        </div>    
                                    </div>
                                </div>
                            </div>

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
                        <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Carga Horária e Salário...</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-inline" style="width: 1045px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 1045px; border: 0px #b92c28 solid;">
                                        <div class="form-group" style="width: 255px;">
                                            <label class="control-label" for="InputWorkload">Carga Horária:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getWorkload(); ?>" style="width: 255px;" class="form-control text-center" autofocus name="workload" id="InputWorkload">
                                        </div>
                                        <div class="form-group" style="width: 255px;">
                                            <label class="control-label" for="InputStartTime">Hora de Entrada:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getStarttime(); ?>" style="width: 255px;" class="form-control text-center" autofocus name="starttime" id="InputStartTime">
                                        </div>
                                        <div class="form-group"  style="width: 255px;">
                                            <label for="InputEndTime">Hora de Saída:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getEndtime(); ?>" style="width: 255px;" class="form-control text-center" autofocus name="endtime" id="InputEndTime">
                                            </div>
                                        </div> 
                                        <div class="form-group"  style="width: 255px;">
                                            <label for="InputSalary">Salário:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getSalary(); ?>" style="width: 255px;" class="form-control text-center" autofocus name="salary" id="InputSalary">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dados Bancários...</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-inline" style="width: 1045px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 730px; border: 0px #b92c28 solid;">
                                        <div class="form-group" style="width: 230px;">
                                            <label class="control-label" for="InputBankName">Banco:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getBank_name(); ?>" style="width: 230px;" class="form-control text-center" autofocus name="bank_name" id="InputBankName">
                                        </div>
                                        <div class="form-group" style="width: 100px;">
                                            <label class="control-label" for="InputTypeAccountAcronym">Tipo de Conta:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getAcronym(); ?>" style="width: 100px;" class="form-control text-center" autofocus name="acronym" id="InputTypeAccountAcronym">
                                        </div>
                                        <div class="form-group"  style="width: 110px;">
                                            <label for="InputOperation">Operação:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getOperation(); ?>" style="width: 110px;" class="form-control text-center" autofocus name="operation" id="InputOperation">
                                            </div>
                                        </div>                                        
                                        <div class="form-group"  style="width: 110px;">
                                            <label for="InputAgency">Agência:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getAgency(); ?>" style="width: 110px;" class="form-control text-center" autofocus name="agency" id="InputAgency">
                                            </div>
                                        </div> 
                                        <div class="form-group"  style="width: 150px;">
                                            <label for="InputAccount">Conta-Corrente:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getAccount(); ?>" style="width: 150px;" class="form-control text-center" autofocus name="account" id="InputAccount">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group" style="width: 300px; border: 0px #b92c28 solid;">
                                        <label for="InputAccountHolder">Titular da Conta:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getAccount_holder(); ?>" style="width: 300px;" class="form-control text-center" autofocus name="account_holder" id="InputAccountHolder">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Endereço...</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                    <div class="form-group" style="width: 510px;">
                                        <div class="form-group" style="width: 400px;">
                                            <label class="control-label" for="InputFirstAddress">Endereço:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getAddress(); ?>" style="width: 440px;" class="form-control text-center" autofocus name="address" id="InputAddress">
                                        </div>
                                        <div class="form-group" style="width: 100px;">
                                            <label class="control-label" for="InputFirstAddrNumber">Número:</label>
                                            <input type="text" readonly value="<?php echo $this->staff->getAddr_number(); ?>" style="width: 100px;" class="form-control text-center" autofocus name="addr_number" id="InputAddrNumber">
                                        </div>
                                    </div>
                                    <div class="form-group"  style="width: 510px;">
                                        <label for="InputAddrComp">Complemento:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getComplement(); ?>" style="width: 510px;" class="form-control text-center" autofocus name="complement" id="InputAddrComp">
                                        </div>
                                    </div>   
                                </div>
                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                    <div class="form-group"  style="width: 510px;">
                                        <label for="InputAddrDist">Bairro:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getDistrict(); ?>" style="width: 500px;" class="form-control text-center" autofocus name="addr_dist" id="InputAddrDist">
                                        </div>
                                    </div> 
                                    <div class="form-group" style="width: 510px;">
                                        <div class="form-group" style="width: 400px;">
                                            <label for="InputAddrCity">Cidade:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getCity(); ?>" style="width: 400px;" class="form-control text-center" autofocus name="addr_city" id="InputAddrCity" >
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 100px;">
                                            <label for="InputAddrState">Estado:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getState(); ?>" style="width: 100px;" class="form-control text-center" autofocus name="addr_state" id="InputAddrState" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contato...</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                    <div class="form-group"  style="width: 510px;">
                                        <div class="form-group"  style="width: 160px;">
                                            <label for="InputHomePhone">Telefone:</label>
                                            <div>
                                                <input type="tel" readonly value="<?php echo $this->staff->getHome_phone(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="home_phone" id="InputHomePhone">
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 160px;">
                                            <label for="InputMobilPhone">Celular:</label>
                                            <div>
                                                <input type="tel" readonly value="<?php echo $this->staff->getMobil_phone(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="mobil_phone" id="InputMobilPhone">
                                            </div> 
                                        </div>
                                        <div class="form-group"  style="width: 160px; ">
                                            <label for="InputNextelPhone">Nextel Número:</label>
                                            <div>
                                                <input type="tel" readonly value="<?php echo $this->staff->getNextel_phone(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="nextel_phone" id="InputNextelPhone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"  style="width: 510px;">
                                        <div class="form-group"  style="width: 160px;">
                                            <label for="InputNextelID">Nextel ID:</label>
                                            <div>
                                                <input type="text" readonly value="<?php echo $this->staff->getNextel_id(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="nextel_id" id="InputNextelID">
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 160px;">
                                            <label for="InputContactPhone">Telefone de Contato:</label>
                                            <div>
                                                <input type="tel" readonly value="<?php echo $this->staff->getContact_phone(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="contact_phone" id="InputContactPhone">
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 160px;">
                                            <label for="InputContactMobil">Celular de Contato:</label>
                                            <div>
                                                <input type="tel" readonly value="<?php echo $this->staff->getContact_mobil(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="contact_mobil" id="InputContactMobil">
                                            </div> 
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                    <div class="form-group"  style="width: 510px;">
                                        <label for="InputContactName">Nome de Contato:</label>
                                        <div>
                                            <input type="text" readonly value="<?php echo $this->staff->getContact_name(); ?>" style="width: 500px;" class="form-control text-center" name="contact_name" id="InputContactName">
                                        </div>                                             
                                    </div>
                                    <div class="form-group"  style="width: 510px;">
                                        <label for="InputEmail">Email:</label>
                                        <div>
                                            <input type="email" readonly value="<?php echo $this->staff->getEmail(); ?>" style="width: 500px;" class="form-control text-center" name="email" id="InputEmail">
                                        </div>                                             
                                    </div>
                                </div>
                            </div>
                        </div>
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

</div><!-- /container -->