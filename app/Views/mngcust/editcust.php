<?php include('modal/ModalCustType.html'); ?>
<?php include('modal/ModalOCCuType.html'); ?>
<?php include('modal/ModalZipCode.html'); ?>

<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Alteração Cadastral de Clientes</strong>
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
                        <form action="<?php echo URL; ?>mngcust/editSave/<?php echo $this->cust->getCustomer_id(); ?>" method="POST">
                            <br />
                            <div class="form-inline">
                                <div class="form-group" style="width: 570px;">
                                    <label for="ComboCompany">Empresa:</label>
                                    <select name="company_id" class="form-control text-center" style=" width: 550px;" >
                                        <?php
                                        if (isset($this->CpnyList))
                                            foreach ($this->CpnyList as $cpny) {
                                                ?>
                                                <option value="<?php echo $cpny->getCompany_id(); ?>" <?php if ($cpny->getCompany_id() == $this->cust->getCompany_id()) echo 'selected'; ?>><?php echo $cpny->getShortname(); ?></option>                        
                                                <?php
                                            }
                                        ?>
                                    </select> 
                                </div>     
                                <div class="form-group" style="width: 505px;">
                                    <div class="form-group" style="width: 370px;">
                                        <label for="ComboCustType">Tipo de Cliente:</label>
                                        <select name="custtype_id" class="form-control text-center" style=" width: 360px;" >
                                            <?php
                                            if (isset($this->CustTypeList))
                                                foreach ($this->CustTypeList as $ctype) {
                                                    ?>
                                                    <option value="<?php echo $ctype->getCusttype_id(); ?>"  <?php if ($ctype->getCusttype_id() == $this->cust->getCusttype_id()) echo 'selected'; ?>><?php echo $ctype->getShortname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="form-group" style="width: 100px;padding-top: 25px;">
                                        <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalCustType" style="width: 100px;"  >Novo!</a>
                                    </div> 
                                </div>
                            </div>

                            <div class="form-inline">
                                <div class="form-group" style="width: 570px;">
                                    <div>
                                        <input type="hidden" name="nature_indcorp" value="<?php echo $this->cust->getNature_indcorp(); ?>">
                                    </div>               
                                    <div class="form-group" style="width: 135px;">
                                        <label for="ComboCustFJ">Natureza (F/J):</label>
                                        <select disabled id="SelectNatIndCorp" onChange="showDivs(this.value);" class="form-control text-center checkbox" style=" width: 135px;" >
                                            <option value="I" <?php if ($this->cust->getNature_indcorp() == 'I') echo 'selected'; ?>>Física</option>
                                            <option selected="true" value="C" <?php if ($this->cust->getNature_indcorp() == 'C') echo 'selected'; ?>>Jurídica</option>
                                        </select> 
                                    </div>     
                                    <div class="form-group" style="width: 135px;">
                                        <label for="ComboCustGender">Genero:</label>
                                        <select name="gender" disabled class="form-control text-center" style=" width: 135px;" >
                                            <option value="M" <?php if ($this->cust->getGender() == 'M') echo 'selected'; ?>>Masculino</option>
                                            <option value="F" <?php if ($this->cust->getGender() == 'F') echo 'selected'; ?>>Feminino</option>
                                        </select> 
                                    </div>                
                                    <div class="form-group"  style="width: 135px;">
                                        <label for="SelectStatus">Sit.Financeira:</label>
                                        <select name="condtcust" class="form-control text-center"style=" width: 135px;" >
                                            <option value="G" <?php if ($this->cust->getCondtcust() == 'G') echo 'selected'; ?>>Boa</option>
                                            <option value="R" <?php if ($this->cust->getCondtcust() == 'R') echo 'selected'; ?>>Regular</option>
                                            <option value="B" <?php if ($this->cust->getCondtcust() == 'B') echo 'selected'; ?>>Ruim</option>
                                        </select>                                    
                                    </div>
                                    <div class="form-group"  style="width: 135px;">
                                        <label for="SelectStatus">Status Cliente:</label>
                                        <select name="status" class="form-control text-center" style=" width: 135px;" >
                                            <option value="A" <?php if ($this->cust->getStatus() == 'A') echo 'selected'; ?>>Ativo</option>
                                            <option value="I" <?php if ($this->cust->getStatus() == 'I') echo 'selected'; ?>>Inativo</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group" style="width: 505px;">
                                    <div class="form-group" style="width: 370px;">
                                        <label for="ComboOccuType">Área de Atuação:</label>
                                        <select name="custoccutype_id" class="form-control text-center" style=" width: 360px;" >
                                            <?php
                                            if (isset($this->OCCuTypeList))
                                                foreach ($this->OCCuTypeList as $octype) {
                                                    ?>
                                                    <option value="<?php echo $octype->getOccupation_id(); ?>" <?php if ($octype->getOccupation_id() == $this->cust->getOccupation_id()) echo 'selected'; ?>><?php echo $octype->getShortname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="form-group" style="width: 100px;padding-top: 25px;">
                                        <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalOCCuType" style="width: 100px;"  >Novo!</a>
                                        <!--<a href class="btn btn-default btn-lg " ng-click="showComplex()">Show</a>
                                        -->
                                    </div> 
                                </div>
                            </div>

                            <div class="form-inline">                                 
                                <div class="form-group" id="CustDivDesc1PJ">
                                    <div class="form-group" style="width: 570px; border: 0px #b92c28 solid;">
                                        <label for="InputCorpName">Razão Social:</label>
                                        <div>
                                            <input type="text"  style="width: 545px;" class="form-control text-center" autofocus name="corpname" readonly value="<?php echo $this->cust->getCorpname(); ?>" id="InputRazao" placeholder="Razão Social"  pattern="[a-zA-Z\u00C0-\u00ff\s]{0,40}">
                                        </div>
                                    </div>
                                    <div class="form-group" id="CustDivDesc2PJ" style="width: 475px;">
                                        <label for="InputAliasName">Nome Fantasia:</label>
                                        <div>
                                            <input type="text" style="width: 475px;" class="form-control text-center"  name="aliasname" value="<?php echo $this->cust->getAliasname(); ?>" id="InputAliasName" placeholder="Nome Fantasia">
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group hidden" id="CustDivDesc1PF">
                                    <div class="form-group" style="width: 570px;">
                                        <label for="InputLongName">Nome Completo:</label>
                                        <div>
                                            <input type="text"  style="width: 545px;" class="form-control text-center" autofocus name="longname" readonly value="<?php echo $this->cust->getCorpname(); ?>" id="InputLongName" placeholder="Nome Completo" pattern="[a-zA-Z\u00C0-\u00ff\s]{0,40}">
                                        </div>
                                    </div>
                                    <div class="form-group" id="CustDivDesc2PF" style="width: 475px;">
                                        <label for="InputShortName">Nome Curto:</label>
                                        <div>
                                            <input type="text" style="width: 475px;" class="form-control text-center"  name="shortname" value="<?php echo $this->cust->getAliasname(); ?>" id="InputShortName" placeholder="Nome Curto">
                                        </div>
                                    </div>                       
                                </div>
                            </div>

                            <div class="form-inline" id="CustDivPJ">
                                <div class="form-group" style="width: 570px;">
                                    <div class="form-group" style="width: 280px;">                                 
                                        <label for="InputCnpj">CNPJ:</label>
                                        <div>
                                            <input type="text" style="width: 260px;"  class="form-control text-center" autofocus name="numcnpj" readonly value="<?php echo $this->cust->getCnpj(); ?>" id="InputCnpj" placeholder="00.000.000/0000-00" onkeyup="maskIt(this, event, '##.###.###/####-##')" pattern="\d{2}.\d{3}.\d{3}/\d{4}-\d{2}">
                                        </div>
                                    </div>
                                    <div class="form-group" style="width: 280px;">
                                        <label for="InputIE">I.E.:</label>
                                        <div>
                                            <input type="text" style="width: 260px;" class="form-control text-center" autofocus name="numie" readonly value="<?php echo $this->cust->getIe(); ?>" id="InputIE" placeholder="000.000.000.000" onkeyup="maskIt(this, event, '###.###.###.###')" pattern="\d{3}.\d{3}.\d{3}.\d{3}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline">
                                <div class="form-group hidden" id="CustDivPF" style="width: 570px; border: 0px #b92c28 solid;">
                                    <div class="form-group" style="width: 280px;">                                 
                                        <label for="InputCpf">CPF:</label>
                                        <div>
                                            <input type="text" readonly style="width: 260px;"  class="form-control text-center" autofocus name="numcpf"  value="<?php echo $this->cust->getCnpj(); ?>" id="InputCpf" placeholder="000.000.000-00" onkeyup="maskIt(this, event, '###.###.###-##')" pattern="\d{3}.\d{3}.\d{3}-\d{2}">
                                        </div>
                                    </div>
                                    <div class="form-group" style="width: 280px;">
                                        <label for="InputRG">RG.:</label>
                                        <div>
                                            <input type="text" readonly style="width: 260px;" class="form-control text-center" autofocus name="numrg" value="<?php echo $this->cust->getIe(); ?>" id="InputRG" placeholder="00.000.000-00" onkeyup="maskIt(this, event, '##.###.###-##')" pattern="\d{2}.\d{3}.\d{3}-\d{2}">
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <div class="form-inline" style="width: 1070px; margin-top: 30px; margin-bottom: 30px;">
                                <div class="tabbable tabs-below">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#A" data-toggle="tab">Comercial</a></li>
                                        <li><a href="#B" data-toggle="tab">Cobrança</a></li>
                                    </ul>                        
                                    <div class="tab-content" style="border: 1px #DCDCDC solid;">
                                        <div class="tab-pane active" id="A">
                                            <div class="panel panel-primary"  style="width: 1065px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Endereços Comercial:</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 570px;">
                                                            <div class="form-group" style="width: 200px;">
                                                                <label class="control-label" for="InputCommZip">Cep:</label>
                                                                <input type="text" style="width: 195px;" class="form-control text-center" autofocus name="comm_addr_zip" id="InputCommZip" placeholder="Cep" value="<?php echo $this->cust->getComm_addr_zip();?>" onkeyup="maskIt(this, event, '#####-###')" required pattern="[0-9]{5}-[0-9]{3}">
                                                                <input type="hidden" name="comm_addr_id" value="<?php echo $this->cust->getComm_addr_id();?>" id="CommAddrId">
                                                            </div>
                                                            <div class="form-group"  style="width: 350px; margin-top: 18px; border: 0px #b92c28 solid;">
                                                                <div class="form-group" style="width: 150px;">
                                                                    <button type="button" id="buttonSearchCommZip" style="width: 150px;" class="form-control btn btn-warning">Pesquisar</button>
                                                                </div>   
                                                                <div class="form-group" style="width: 150px;">
                                                                    <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalZipCode" style="width: 150px;"  >Cadastrar Novo!</a>
                                                                </div>   
                                                            </div>   
                                                        </div>
                                                        <div class="form-group"  style="width: 450px;">
                                                            <div class="form-group" style="width: 340px;">
                                                                <label class="control-label" for="ForInvAddr">Endereço comercial é o mesmo de Cobrança?</label>
                                                            </div>
                                                            <div class="form-group" style="width: 100px;">
                                                                <label class="control-label" for="CheckBoxYesNo">Sim:</label>
                                                                <input type="checkbox" style="width: 30px;" onchange="sendData();" class="form-control text-center" autofocus id="CheckBoxYesNo">
                                                            </div>
                                                        </div> 
                                                    </div>

                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group" style="width: 400px;">
                                                                <label class="control-label" for="InputCommAddress">Endereço:</label>
                                                                <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="comm_address" value="<?php echo $this->cust->getComm_address();?>" id="InputCommAddress" placeholder="Endereço" required pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,40}">
                                                            </div>
                                                            <div class="form-group" style="width: 100px;">
                                                                <label class="control-label" for="InputCommAddrNumber">Número:</label>
                                                                <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="comm_addr_number" value="<?php echo $this->cust->getComm_addr_number();?>" id="InputCommAddrNumber" placeholder="Número" pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,15}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="width: 510px;">
                                                            <label for="InputCommAddrComp">Complemento:</label>
                                                            <div>
                                                                <input type="text" style="width: 500px;" class="form-control text-center" autofocus name="comm_addr_comp" value="<?php echo $this->cust->getComm_addr_comp();?>" id="InputCommAddrComp" placeholder="Complemento..">
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">                  
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group"  style="width: 400px;">
                                                                <label for="InputCommAddrDist">Bairro:</label>
                                                                <div>
                                                                    <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="comm_addr_dist" value="<?php echo $this->cust->getComm_addr_dist();?>" id="InputCommAddrDist" placeholder="Bairro ou Localidade" required pattern="[a-zA-Z.\u00C0-\u00ff\s]{0,30}">
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group" style="width: 400px;">
                                                                <label for="InputCommAddrCity">Cidade:</label>
                                                                <div>
                                                                    <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="comm_addr_city" value="<?php echo $this->cust->getComm_addr_city();?>" id="InputCommAddrCity" placeholder="Cidade" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,25}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"  style="width: 100px;">
                                                                <label for="InputCommAddrState">Estado:</label>
                                                                <div>
                                                                    <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="comm_addr_state" value="<?php echo $this->cust->getComm_addr_state();?>" id="InputCommAddrState" placeholder="Estado" required pattern="[a-zA-Z]{0,2}">
                                                                </div>
                                                            </div>   
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 510px;">
                                                            <label for="InputCommAddrRef">Ponto de Referência:</label>
                                                            <div>
                                                                <input type="text" style="width: 510px;" class="form-control text-center" autofocus name="comm_addr_ref" value="<?php echo $this->cust->getComm_addr_ref();?>" id="InputCommAddrRef" placeholder="Referência..">
                                                            </div> 
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div> 

                                            <div class="panel panel-primary"  style="width: 1065px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Contato Comercial:</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <div class="form-group" style="width: 500px;">
                                                                <label for="InputCommContact">Contato Comercial:</label>
                                                                <div>
                                                                    <input type="text" style="width: 500px;" class="form-control text-center" autofocus name="commercial_contact_name" value="<?php echo $this->cust->getCommercial_contact_name();?>" id="InputCommContact" placeholder="Contato Comercial">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 500px;">
                                                                <label for="InputCommEmail">Email:</label>
                                                                <div>
                                                                    <input type="email" style="width: 500px;" class="form-control text-center" name="comm_email" value="<?php echo $this->cust->getComm_email();?>" id="InputCommEmail" placeholder="nome@provedora.com.br">
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>

                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px;">
                                                                <label for="InputCommBusinessPhone">Telefone:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="comm_business_phone" value="<?php echo $this->cust->getComm_business_phone();?>" id="InputCommBusinessPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"  style="width: 225px;">
                                                                <label for="InputCommMobilPhone">Telefone Celular:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="comm_mobil_phone" value="<?php echo $this->cust->getComm_mobil_phone();?>" id="InputCommMobilPhone" placeholder="(00)00000-0000" onkeyup="maskIt(this, event, '(##)#####-####')" pattern="\([0-9]{2}\)([0-9\s-]{1})?[0-9]{4}-[0-9]{4}">
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputCommNextelPhone">Nextel Número:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="comm_nextel_phone" value="<?php echo $this->cust->getComm_nextel_phone();?>" id="InputCommNextelPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div>  
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputCommNextelID">Nextel ID:</label>
                                                                <div>
                                                                    <input type="text" style="width: 225px;" class="form-control text-center" autofocus name="comm_nextel_id" value="<?php echo $this->cust->getComm_nextel_id();?>" id="InputCommNextelID" placeholder="0000000" pattern="[0-9*]{0,15}">
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputCommFax">Fax:</label>
                                                                <div>
                                                                    <input type="text" style="width:225px;" class="form-control text-center" autofocus name="comm_fax_phone" value="<?php echo $this->cust->getComm_fax_phone();?>" id="InputCommFax" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 500px; ">
                                                                <label for="InputCommWebPager">Página Web:</label>
                                                                <div>
                                                                    <input type="text" style="width:500px;" class="form-control text-center" autofocus name="comm_webpage" value="<?php echo $this->cust->getComm_webpage();?>" id="InputCommWebpager" placeholder="http://www.site.com.br" pattern="[a-zA-Z\u00C0-\u00ff\s./:]{0,50}">
                                                                </div>
                                                            </div> 
                                                        </div>     
                                                    </div>                                             
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 1000px;">
                                                            <label for="InputCommNote">Observação:</label>
                                                            <div>
                                                                <textarea class="form-control left" style="width: 1030px;" name="comm_note" id="InputCommNote"><?= $this->cust->getComm_note();?></textarea>                                        
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="B">
                                            <div class="panel panel-primary"  style="width:1065px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Endereços de Cobrança:</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="form-inline" style="margin-top: 12px; margin-left: 5px; margin-bottom: 12px;">
                                                        <div class="form-group" style="width: 570px;">
                                                            <div class="form-group" style="width: 200px;">
                                                                <label class="control-label" for="InputInvZipCode">Cep:</label>
                                                                <input type="text" style="width: 195px;" class="form-control text-center" autofocus name="inv_addr_zip" value="<?php echo $this->cust->getInv_addr_zip();?>" id="InputInvZip" placeholder="Cep" onkeyup="maskIt(this, event, '#####-###')" pattern="[0-9]{5}-[0-9]{3}">
                                                                <input type="hidden" name="inv_addr_id" value="<?php echo $this->cust->getInv_addr_id();?>"  id="InvAddrId">
                                                            </div>
                                                            <div class="form-group"  style="width: 350px; margin-top: 18px; border: 0px #b92c28 solid;">
                                                                <div class="form-group" style="width: 150px;">
                                                                  <button type="button" id="buttonSearchInvZip" style="width: 150px;" class="form-control btn btn-warning">Pesquisar</button>
                                                                </div>   
                                                                <div class="form-group" style="width: 150px;">
                                                                    <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalZipCode" style="width: 150px;"  >Cadastrar Novo!</a>
                                                                </div>   
                                                            </div>                                                            
   
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group" style="width: 400px;">
                                                                <label class="control-label" for="InputInvAddress">Endereço:</label>
                                                                <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="inv_address" value="<?php echo $this->cust->getInv_address();?>"  id="InputInvAddress" placeholder="Endereço" required pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,40}">
                                                            </div>
                                                            <div class="form-group" style="width: 100px;">
                                                                <label class="control-label" for="InputInvAddrNumber">Número:</label>
                                                                <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="inv_addr_number" value="<?php echo $this->cust->getInv_addr_number();?>"  id="InputInvAddrNumber" placeholder="Número" pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,15}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="width: 510px;">
                                                            <label for="InputInvAddrComp">Complemento:</label>
                                                            <div>
                                                                <input type="text" style="width: 500px;" class="form-control text-center" autofocus name="inv_addr_comp" value="<?php echo $this->cust->getInv_addr_comp();?>" id="InputInvAddrComp" placeholder="Complemento..">
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">                  
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group"  style="width: 400px;">
                                                                <label for="InputInvAddrDist">Bairro:</label>
                                                                <div>
                                                                    <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="inv_addr_dist" value="<?php echo $this->cust->getInv_addr_dist();?>" id="InputInvAddrDist" placeholder="Bairro ou Localidade" required pattern="[a-zA-Z.\u00C0-\u00ff\s]{0,30}">
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group" style="width: 510px;">
                                                            <div class="form-group" style="width: 400px;">
                                                                <label for="InputInvAddrCity">Cidade:</label>
                                                                <div>
                                                                    <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="inv_addr_city" value="<?php echo $this->cust->getInv_addr_city();?>" id="InputInvAddrCity" placeholder="Cidade" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,25}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"  style="width: 100px;">
                                                                <label for="InputInvAddrState">Estado:</label>
                                                                <div>
                                                                    <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="inv_addr_state" value="<?php echo $this->cust->getInv_addr_state();?>" id="InputInvAddrState" placeholder="Estado" required pattern="[a-zA-Z]{0,2}">
                                                                </div>
                                                            </div>   
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 510px;">
                                                            <label for="InputInvAddrRef">Ponto de Referência:</label>
                                                            <div>
                                                                <input type="text" style="width: 510px;" class="form-control text-center" autofocus name="inv_addr_ref" value="<?php echo $this->cust->getInv_addr_ref();?>" id="InputInvAddrRef" placeholder="Referência..">
                                                            </div> 
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>

                                            <div class="panel panel-primary"  style="width: 1065px; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Contato de Cobrança:</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <div class="form-group" style="width: 500px;">
                                                                <label for="InputInvContact">Contato de Cobrança:</label>
                                                                <div>
                                                                    <input type="text" style="width: 500px;" class="form-control text-center" autofocus name="invoice_contact_name" value="<?php echo $this->cust->getInvoice_contact_name();?>" id="InputInvContact" placeholder="Contato de Cobrança">
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 500px;">
                                                                <label for="InputInvEmail">Email:</label>
                                                                <div>
                                                                    <input type="email" style="width: 500px;" class="form-control text-center" name="inv_email" value="<?php echo $this->cust->getInv_email();?>" id="InputInvEmail" placeholder="nome@provedora.com.br">
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>                                                    

                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px;">
                                                                <label for="InputInvBusinessPhone">Telefone:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="inv_business_phone" value="<?php echo $this->cust->getInv_business_phone();?>" id="InputInvBusinessPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"  style="width: 225px;">
                                                                <label for="InputInvMobilPhone">Telefone Celular:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="inv_mobil_phone" value="<?php echo $this->cust->getInv_mobil_phone();?>" id="InputInvMobilPhone" placeholder="(00)00000-0000" onkeyup="maskIt(this, event, '(##)#####-####')" pattern="\([0-9]{2}\)([0-9\s-]{1})?[0-9]{4}-[0-9]{4}">
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputInvNextelPhone">Nextel Número:</label>
                                                                <div>
                                                                    <input type="tel" style="width: 225px;" class="form-control text-center" autofocus name="inv_nextel_phone" value="<?php echo $this->cust->getInv_nextel_phone();?>"  id="InputInvNextelPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div>  
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputInvNextelID">Nextel ID:</label>
                                                                <div>
                                                                    <input type="text" style="width: 225px;" class="form-control text-center" autofocus name="inv_nextel_id" value="<?php echo $this->cust->getInv_nextel_id();?>" id="InputInvNextelID" placeholder="0000000" pattern="[0-9*]{0,15}">
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 500px;">
                                                            <div class="form-group"  style="width: 225px; ">
                                                                <label for="InputInvFax">Fax:</label>
                                                                <div>
                                                                    <input type="text" style="width:225px;" class="form-control text-center" autofocus name="inv_fax_phone" value="<?php echo $this->cust->getInv_fax_phone();?>" id="InvInputFax" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group"  style="width: 1000px;">
                                                            <label for="InputInvNote">Observação:</label>
                                                            <div>
                                                                <textarea class="form-control left" style="width: 1030px;" name="inv_note" id="InputInvNote"><?= $this->cust->getInv_note();?></textarea>                                        
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                </div> <!-- /tabbable -->
                            </div>
                            <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                <div class="form-group"  style="width: 1000px;">
                                    <label for="InputCustomerNote">Observação:</label>
                                    <div>
                                        <textarea class="form-control left" style="width: 1030px;" name="note" id="InputCustomerNote"><?= $this->cust->getNote();?></textarea>                                        
                                    </div> 
                                </div>
                            </div>
 
                            <div class="form-inline">
                                <div class="form-group" style="width: 1024px; text-align: center; padding-top: 20px; padding-bottom: 20px; border: 0px #b92c28 solid;">
                                    <button type="submit" style="width: 250px;"  class="form-control btn btn-success">Confirmar</button>
                                    <button type="reset" style="width: 250px;"  class="form-control btn btn-danger">Limpar</button>
                                </div>  
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
    /**
     * Function to search address to first postalcode
     * and set data to form. 
     * @param {type} param
     */
    $(document).ready(function () {
        //
        $("#buttonSearchCommZip").click(function () {
            var zipcode = $("#InputCommZip").val();
            var urlapp = "<?php echo URL; ?>mngcust/findZip?zipcode=";
            console.log(urlapp + zipcode);
            // 
            $.ajax({
                url: urlapp + zipcode,
                success: function (result) {
                    //
                    var obj = $.parseJSON(result);
                    console.log(obj);
                    //
                    if (obj !== false) {
                        //
                        $("#CommAddrId").val(obj.id);
                        $("#InputCommAddress").val(obj.street);
                        $("#InputCommAddrComp").val(obj.complement);
                        $("#InputCommAddrDist").val(obj.district);
                        $("#InputCommAddrCity").val(obj.city);
                        $("#InputCommAddrState").val(obj.state);
                        //
                    } else {
                        $('#DivErroMsg').html("<div class='form-group' <div class='error col-xs-offset-1 col-xs-10'><div class='alert alert-warning alert-dismissable' style='text-align: center; background: #F6DFBD;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong  style='color: #CB3E3A;'>Cep não encontrado no cadastro, pesquise nos correios!!!</strong><br/><strong><a href='http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco' target='_blank'>Pesquisar nos Correios...</a></strong></div></div></div>");
                    }
                }});
        });
        //
    });


    /**
     * Function to search address to second postalcode
     * and set data to form.
     * @type type 
     */
    $(document).ready(function () {
        $("#buttonSearchInvZip").click(function () {
            var zipcode = $("#InputInvZip").val();
            var urlapp = "<?php echo URL; ?>mngcust/findZip?zipcode=";
            console.log(urlapp + zipcode);
            // 
            $.ajax({
                url: urlapp + zipcode,
                success: function (result) {
                    //
                    var obj = $.parseJSON(result);
                    console.log(obj);
                    //
                    if (obj !== false) {
                        //
                        $("#InvAddrId").val(obj.id);
                        $("#InputInvAddress").val(obj.street);
                        $("#InputCommAddrComp").val(obj.complement);                        
                        $("#InputInvAddrDist").val(obj.district);
                        $("#InputInvAddrCity").val(obj.city);
                        $("#InputInvAddrState").val(obj.state);
                        //
                    } else {
                        $('#DivErroMsg').html("<div class='form-group' <div class='error col-xs-offset-1 col-xs-10'><div class='alert alert-warning alert-dismissable' style='text-align: center; background: #F6DFBD;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong  style='color: #CB3E3A;'>Cep não encontrado no cadastro, pesquise nos correios!!!</strong><br/><strong><a href='http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco' target='_blank'>Pesquisar nos Correios...</a></strong></div></div></div>");
                    }
                }});
        });
    });

    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function showDivs(resSelect) {
        //
        if (resSelect === 'I') {
            $('#CustDivDesc1PF').removeClass('hidden'); //To Show
            $('#CustDivDesc2PF').removeClass('hidden'); //To Show
            $('#CustDivPF').removeClass('hidden'); //To Show
            //
            $("#CustDivDesc1PJ").addClass('hidden'); //To Hide
            $("#CustDivDesc2PJ").addClass('hidden'); //To Hide
            $("#CustDivPJ").addClass('hidden'); //To Hide
            //
        }
        else if (resSelect === 'C') {
            $('#CustDivDesc1PJ').removeClass('hidden'); //To Show
            $('#CustDivDesc2PJ').removeClass('hidden'); //To Show
            $('#CustDivPJ').removeClass('hidden'); //To Show
            //
            $("#CustDivDesc1PF").addClass('hidden'); //To Hide
            $("#CustDivDesc2PF").addClass('hidden'); //To Hide
            $("#CustDivPF").addClass('hidden'); //To Hide
        }

        console.log("Value of Select: " + resSelect);
    }

    /**
     * If not show data in webpager
     * can be a problem with jquery version.
     * because i was a problem whem i had
     * my test for learn.
     * @returns {undefined}
     */
    function sendData() {
        var vcheck = $("#CheckBoxYesNo").val();
        var vzipid = $("#CommAddrId").val();
        var vzip = $("#InputCommZip").val();
        var vaddr = $("#InputCommAddress").val();
        var vaddrnumber = $("#InputCommAddrNumber").val();
        var vaddrcomp = $("#InputCommAddrComp").val();
        var vdist = $("#InputCommAddrDist").val();
        var vcity = $("#InputCommAddrCity").val();
        var vstate = $("#InputCommAddrState").val();
        var vref = $("#InputCommAddrRef").val();

        /* console.log(vzip);
         console.log(vaddr);
         console.log(vaddrnumber);
         console.log(vdist);
         console.log(vcity);
         console.log(vstate);
         console.log(vref);        */

        // 
        if (vcheck !== '') {
            if (vzipid !== '' &&
                    vzip !== '' &&
                    vaddr !== '' &&
                    vaddrnumber !== '' &&
                    vdist !== '' &&
                    vcity !== '' &&
                    vstate !== '' )
            {
                $("#InvAddrId").val(vzipid);
                $("#InputInvZip").val(vzip);
                $("#InputInvAddress").val(vaddr);
                $("#InputInvAddrNumber").val(vaddrnumber);
                $("#InputInvAddrComp").val(vaddrcomp);
                $("#InputInvAddrDist").val(vdist);
                $("#InputInvAddrCity").val(vcity);
                $("#InputInvAddrState").val(vstate);
                $("#InputInvAddrRef").val(vref);
            } else {
                $('input[name=addrcorpboth]').attr('checked', false);
                $('#DivErroMsg').html("<div class='form-group' <div class='error col-xs-offset-1 col-xs-10'><div class='alert alert-warning alert-dismissable' style='text-align: center; background: #F6DFBD;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong  style='color: #CB3E3A;'>Campos Obrigatórios devem ser Preenchidos, Antes de marcar o Checkbox!!!</strong></div></div></div>");
            }
        } else {
            console.log('Nothing selected...: ' + vcheck);
        }
    }

    /**  
     * Função Principal           * @param w - O elemento que será aplicado (normalmente this).
     * @param e - O evento para capturar a tecla e cancelar o backspace.
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