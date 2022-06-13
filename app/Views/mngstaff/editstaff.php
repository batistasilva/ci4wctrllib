<?php include('modal/ModalBankBranch.html'); ?>
<?php include('modal/ModalDepartment.html'); ?>
<?php include('modal/ModalJobTitle.html'); ?>
<?php include('modal/ModalTypeAccount.html'); ?>
<?php include('modal/ModalStaffUploadEdit.php'); ?>
<?php include('modal/ModalStaffPhotoEdit.php'); ?>
<?php include('modal/ModalZipCode.html'); ?>

<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background: #3072AB; font-weight: bold; color: #FFFFFF;">
                    <strong>Alteração Cadastral de Colaboradores</strong>
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
                        <form action="<?php echo URL; ?>mngstaff/editSave/<?php echo $this->staff->getStaff_id(); ?>" method="POST">
                            <br />
                            <div class="form-inline">
                                <div class="form-group" style="width: 570px;">
                                    <label for="ComboCompany">Empresa:</label>
                                    <select id="SELCompanyID" name="company_id" class="form-control text-center" style=" width: 550px;" >
                                        <?php
                                        if (isset($this->CpnyList))
                                            foreach ($this->CpnyList as $cpny) {
                                                ?>
                                                <option value="<?php echo $cpny->getCompany_id(); ?>" <?php if ($cpny->getCompany_id() == $this->staff->getCompany_id()) echo 'selected'; ?>><?php echo $cpny->getLongname(); ?></option>                        
                                                <?php
                                            }
                                        ?>
                                    </select> 
                                </div>     
                                <div class="form-group" style="width: 505px;">
                                    <div class="form-group" style="width: 360px;">
                                        <label for="ComboLocal">Local de Trabalho:</label>
                                        <select id="SELLocal" name="acronym" class="form-control text-center" onChange="changeCustomer(this.value);" style=" width: 360px;" >
                                            <?php
                                            if (isset($this->LocalList))
                                                foreach ($this->LocalList as $local) {
                                                    ?>
                                                    <option value="<?php echo $local->getAcronym(); ?>" <?php if ($local->getLocal_id() == $this->staff->getLocal_id()) echo 'selected'; ?>><?php echo $local->getShortname(); ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                    <div class="form-group" style="width: 105px; margin-left: 10px;">
                                        <label for="ComboStaffStatus">Status:</label>
                                        <select name="status" class="form-control text-center" style="width: 105px;" >
                                            <option value="A" <?php if ($this->staff->getStatus() == 'A') echo 'selected'; ?>>Ativo</option>
                                            <option value="I" <?php if ($this->staff->getStatus() == 'I') echo 'selected'; ?>>Inativo</option>
                                        </select> 
                                    </div>                                    
                                </div>
                            </div>

                            <div class="form-inline">
                                <div>
                                    <input id="InputHPersonID" type="hidden" name="person_id" value="<?php echo $this->staff->getPerson_id(); ?>">     
                                </div>                                    
                                <div class="form-group" id="CustDivDesc1PJ">
                                    <div class="form-group" style="width: 570px;">
                                        <label for="ComboCustomer">Cliente:</label>
                                        <select id="SELCustomerID"  name="customer_id" class="form-control text-center" style=" width: 550px;" >
                                            <?php
                                            if (isset($this->CustList))
                                                foreach ($this->CustList as $cust) {
                                                    ?>
                                                    <option value="<?php echo $cust->getCustomer_id(); ?>" <?php if ($cust->getCustomer_id() == $this->staff->getCustomer_id()) echo 'selected'; ?>><?php echo $cust->getCorpname(); ?></option>                        
                                                    <?php
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                    <div class="form-group" style="width: 505px;">
                                        <div id="DivJobTitle" class="form-group" style="width: 370px;">
                                            <label for="ComboJobTitle">Função:</label>
                                            <select name="jobtitle_id" class="form-control text-center" style=" width: 360px;" >
                                                <?php
                                                if (isset($this->JobTitleList))
                                                    foreach ($this->JobTitleList as $job) {
                                                        ?>
                                                        <option value="<?php echo $job->getJobtitle_id(); ?>" <?php if ($job->getJobtitle_id() == $this->staff->getJobtitle_id()) echo 'selected'; ?>><?php echo $job->getShortname(); ?></option>                        
                                                        <?php
                                                    }
                                                ?>
                                            </select> 
                                        </div>
                                        <div class="form-group" style="width: 100px;padding-top: 25px;">
                                            <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalJobTitle" style="width: 105px;">Novo!</a>
                                        </div> 
                                    </div>
                                </div>
                            </div>                                                   

                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Dados Pessoais...</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="tabbable tabs-below">
                                        <ul class="nav nav-tabs">

                                            <li class="active"><a href="#PersonalData1" data-toggle="tab">Dados Pessoais-I</a></li><!--Inicio da Aba Dados Pessoais -->
                                            <li><a href="#PersonalDada2" data-toggle="tab">Dados Pessoais-II</a></li><!--Inicio da Aba Dados Pessoais -->
                                            <li><a href="#FamilyData" data-toggle="tab">Dados Familiar</a></li>
                                        </ul>                        
                                        <div class="tab-content" style="border: 1px #DCDCDC solid;">

                                            <!--Inicio da Aba Dados Pessoais - 1 -->

                                            <div class="tab-pane active" id="PersonalData1">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 510px;">
                                                        <label for="InputName">Nome/Nome do Meio:</label>
                                                        <div>
                                                            <input type="text" value="<?php echo $this->staff->getName(); ?>"  style="width: 500px;" class="form-control text-center" autofocus name="name" id="InputName" placeholder="Nome/Nome do Meio..." required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                        </div>
                                                    </div>                                    

                                                    <div class="form-group" id="StaffName" style="width: 510px;">
                                                        <label for="InputSurname">Sobrenome:</label>
                                                        <div>
                                                            <input type="text" value="<?php echo $this->staff->getSurname(); ?>" style="width: 500px;" class="form-control text-center"  name="surname" id="InputSurname" placeholder="Sobrenome..." required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                                        </div>
                                                    </div>  
                                                </div>                                                  
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" id="BirthDate" style="width: 165px;">
                                                            <label for="InputBirthDate">Data de Nascimento:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getBirthdate(); ?>" style="width: 165px;" class="form-control text-center"  name="birthdate" id="InputBirthDate" onkeyup="maskIt(this, event, '##-##-####')" required placeholder="00-00-0000" pattern="\d{2}-\d{2}-\d{4}">
                                                            </div>
                                                        </div> 
                                                        <div class="form-group" style="width: 165px;">
                                                            <label for="ComboCustGender">Sexo:</label>
                                                            <select name="gender" onchange="changeForFemale(this.value)" class="form-control text-center"style=" width: 165px;" >
                                                                <option value="M" <?php if ($this->staff->getGender() == 'M') echo 'selected'; ?>>Masculino</option>
                                                                <option value="F" <?php if ($this->staff->getGender() == 'F') echo 'selected'; ?>>Feminino</option>
                                                            </select> 
                                                        </div> 
                                                        <div class="form-group" style="width: 165px;">
                                                            <label for="ComboNationality">Nacionalidade:</label>
                                                            <select name="nationality" onchange="changeForNationality(this.value)" class="form-control text-center"style=" width: 165px;" >
                                                                <option value="B" <?php if ($this->staff->getNationality() == 'B') echo 'selected'; ?>>Brasileira</option>
                                                                <option value="E" <?php if ($this->staff->getNationality() == 'E') echo 'selected'; ?>>Estrangeira</option>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" id="StaffName" style="width: 380px;">
                                                            <label for="InputCountryState">[ País ] / [ Estado ] / [ Cidade ]:</label>
                                                            <div>
                                                                <input type="text" style="width: 380px;" class="form-control text-center"  name="country_city_state" id="InputCountryState" placeholder="País/Estado/Cidade...">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="width: 120px;">
                                                            <label for="ComboMaritalState">Estado Civil:</label>
                                                            <select name="maritalstate" onchange="changeForMaritalState(this.value)" class="form-control text-center" style=" width: 120px;" >
                                                                <option value="SG" <?php if ($this->staff->getMarital_state() == 'SG') echo 'selected'; ?>>Solteiro(a)</option>
                                                                <option value="MR" <?php if ($this->staff->getMarital_state() == 'MR') echo 'selected'; ?>>Casado(a)</option>
                                                                <option value="ST" <?php if ($this->staff->getMarital_state() == 'ST') echo 'selected'; ?>>União Estável</option><!--Stable Union -->
                                                                <option value="SP" <?php if ($this->staff->getMarital_state() == 'SP') echo 'selected'; ?>>Separado(a)</option><!--Separeted -->
                                                                <option value="WD" <?php if ($this->staff->getMarital_state() == 'WD') echo 'selected'; ?>>Viuvo(a)</option>                                            
                                                            </select> 
                                                        </div>
                                                    </div>

                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" id="DivStaffNaturality" style="width: 510px;">
                                                            <div class="form-group" id="DivNaturality" style="width: 320px;">
                                                                <label for="InputNaturality">Naturalidade:</label>
                                                                <div>
                                                                    <input type="text" style="width: 320px;" value="<?php echo $this->staff->getNaturality(); ?>" class="form-control text-center"  name="naturality" id="InputNaturality" placeholder="Naturalidade" required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="StaffNaturalityState" style="width: 90px;">
                                                                <label for="InputNaturalityState">Estado:</label>
                                                                <div>
                                                                    <input type="text" style="width: 90px;" value="<?php echo $this->staff->getNaturality_state(); ?>" class="form-control text-center"  name="naturality_state" id="InputNaturalityState" placeholder="Estado" required pattern="[a-z\u00C0-\u00ffA-Z]{0,2}">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group" id="StaffNaturalityState" style="width: 90px;">
                                                                <label for="InputBloodPerson">Raça:</label>
                                                                <div>
                                                                    <input type="text" style="width: 90px;" value="<?php echo $this->staff->getBloodperson(); ?>" class="form-control text-center"  name="blood_person" id="InputBloodPerson" placeholder="Raça" required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                                                </div>
                                                            </div>                                                                
                                                        </div>
                                                        <div class="form-group" id="StaffNaturality" style="width: 510px;">
                                                            <div class="form-group" id="StaffNaturality" style="width: 165px;">
                                                                <label for="InputColorPerson">Cor:</label>
                                                                <div>
                                                                    <input type="text" style="width: 165px;" value="<?php echo $this->staff->getColorperson(); ?>" class="form-control text-center"  name="color_person" id="InputColorPerson" placeholder="Cor" required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,20}">
                                                                </div>
                                                            </div>                                                                
                                                        </div>                                                        
                                                    </div>
                                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                        <div class="form-group" id="StaffFirstJob" style="width: 510px;">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <label style="width: 330px;">Primeiro Emprego (Sim/Não)?</label>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="form-group" style="width: 330px;">                                                                      
                                                                        <div>
                                                                            <label for="InputStaffFirstJob">Sim:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getFirstjob() == 'Y') echo 'checked'; ?> class="form-control text-center" autofocus name="firstjob" value="Y" id="InputStaffFirstJob">
                                                                            <label for="InputStaffSecondJob">Não:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getFirstjob() == 'N') echo 'checked'; ?> class="form-control text-center" autofocus name="firstjob" value="N" id="InputStaffSecondJob">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group" id="StaffSpecialNeeds" style="width: 400px;">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <label style="width: 400px;">Portador de Necessidades Especias: (Sim/Não)?</label>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="form-group" style="width: 400px;">                                                                      
                                                                        <div>
                                                                            <label for="InputStaffSpecialNeedsBearerYes">Sim:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getSpecialnbearer() == 'Y') echo 'checked'; ?>  class="form-control text-center" autofocus name="special_nebe" value="Y" required id="InputStaffSpecialNeedsBearerYes">
                                                                            <label for="InputStaffSpecialNeedsBearerNo">Não:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getSpecialnbearer() == 'N') echo 'checked'; ?>  class="form-control text-center" autofocus name="special_nebe"  value="N" required id="InputStaffSpecialNeedsBearerNo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                              
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim da Aba Dados Pessoais-I -->

                                            <!--Inicio da Aba Dados Pessoais-2 -->

                                            <div class="tab-pane" id="PersonalDada2">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 1010px;">  
                                                        <div class="form-group" style="width: 300px;">
                                                            <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalEditUpload" title="Enviar uma Imagem do Computador!">
                                                                Enviar Imagem!!
                                                            </a>   
                                                        </div>
                                                        <div class="form-group" style="width: 300px;">
                                                            <a data-toggle="modal" id="StaffPhotEdit" class="btn btn-success btn-large <?php if (!$this->staff->getImagepath()) echo 'disabled'; ?>" title="Editar Imagem Atual!" data-target="#ModalStaffPhotoEdit">
                                                                Edita Imagem!!                                                                                                            
                                                            </a>  
                                                        </div>                                                        
                                                        <div class="form-group" style="width: 300px;">
                                                            <a data-toggle="modal" class="btn btn-warning btn-large disabled" id="OpenModalCapturePhoto" title="Capturar uma Imagem da WebCam!" href="#ModalStaffCapture">
                                                                Capturar da WebCam!!                                                                                                            
                                                            </a>  
                                                        </div>
                                                    </div>                                                                                                                                      
                                                </div>
                                            </div>
                                            <!-- Fim da Aba Dados Pessoais-II -->                                            

                                            <!--Inicio da Aba Dados Familia -->                                          
                                            <div class="tab-pane" id="FamilyData">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 335px;">
                                                        <label for="InputFatherName">Nome do Pai:</label>
                                                        <div>
                                                            <input type="text" value="<?php echo $this->staff->getFathername(); ?>" style="width: 335px;" class="form-control text-center" autofocus name="fathername" id="InputFatherName" placeholder="Nome do Pai..." pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                        </div>
                                                    </div>   
                                                    <div class="form-group" id="StaffName" style="width: 335px;">
                                                        <label for="InputMotherName">Nome da Mãe:</label>
                                                        <div>
                                                            <input type="text" value="<?php echo $this->staff->getMothername(); ?>" style="width: 335px;" class="form-control text-center"  name="mothername" id="InputMotherName" placeholder="Nome da Mãe..." pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                        </div>
                                                    </div>                                     
                                                    <div class="form-group" id="WifesName" style="width: 335px;">
                                                        <label for="InputWifesName">Nome do Cônjuge:</label>
                                                        <div>
                                                            <input type="text" value="<?php echo $this->staff->getWifesname(); ?>" style="width: 335px;" class="form-control text-center"  name="wifesname" id="InputWifesName" placeholder="Nome do Cônjuge..." pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- Fim da Aba Dados Familia -->

                                        </div> <!-- /tabbable -->
                                    </div>
                                </div>     <!-- End Doc/Information -->                              
                            </div>

                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Documentos...</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="tabbable tabs-below">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#Doc" data-toggle="tab">Documentos</a></li><!--Inicio da Aba Documentos -->
                                            <li><a href="#Adm" data-toggle="tab">Admissional</a></li>
                                            <li><a href="#Bank" data-toggle="tab">Bancários</a></li>
                                            <li><a href="#Ref" data-toggle="tab">Referências</a></li>
                                            <li><a href="#Educ" data-toggle="tab">Escolaridade</a></li>
                                        </ul>                        
                                        <div class="tab-content" style="border: 1px #DCDCDC solid;">

                                            <!--Inicio da Aba Documentos -->

                                            <div class="tab-pane active" id="Doc">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="form-group" style="width: 150px;">                                 
                                                            <label for="InputCpf">CPF:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getCpf(); ?>" style="width: 150px;"  class="form-control text-center" autofocus name="numcpf" id="InputCpf" placeholder="000.000.000-00" onkeyup="maskIt(this, event, '###.###.###-##')" required x-moz-errormessage="Preencha o campo com o CPF!" pattern="\d{3}.\d{3}.\d{3}-\d{2}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">RG:</label>
                                                                <label style="width: 160px;">Ôrgão Emissor:</label>
                                                                <label style="width: 150px;">Data de Expedição:</label>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;">
                                                                    <div class="form-group" style="width: 160px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getRg(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="numrg" id="InputRG" placeholder="00000000-00" required pattern="[0-9a-zA-Z-]{0,12}">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group" style="width: 160px;"> 
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getRg_organissuer(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="organissuer" id="InputRGOrganIssuer" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 160px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getRg_dateofchip(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="dateofchip" id="InputRGDateOfChipment" onkeyup="maskIt(this, event, '##-##-####')" required placeholder="00-00-0000" pattern="\d{2}-\d{2}-\d{4}">
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="DivCrsm" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">Cert. Resevista:</label>
                                                            </div>
                                                            <div class="panel-body" id="DicCr">
                                                                <div class="form-group" style="width: 495px; height: 50px;">
                                                                    <div class="form-group" style="width: 160px;">                                 
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getCrsm(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="numcrsm" id="InputCrsm" placeholder="000.000.000.000" onkeyup="maskIt(this, event, '###.###.###.###')" pattern="\d{3}.\d{3}.\d{3}.\d{3}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">Carteira de Trabalho:</label>
                                                                <label style="width: 160px;">Série:</label>
                                                                <label style="width: 150px;">Data de Emissão:</label>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;">
                                                                    <div class="form-group" style="width: 160px;">                                 
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getCtps(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="ctps" id="InputCtps" placeholder="0000000" onkeyup="maskIt(this, event, '#######')" required pattern="[0-9]{0,7}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 160px;">      
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getCtpsserie(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="ctpsserie" id="InputCtpsSerie" placeholder="0000000" onkeyup="maskIt(this, event, '#######')" required pattern="[0-9]{0,7}">
                                                                        </div>
                                                                    </div>                                                        
                                                                    <div class="form-group" style="width: 160px;">                                 
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getCtps_dateofissuer(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="dateofissue" id="InputDateOfIssue" placeholder="00-00-0000" onkeyup="maskIt(this, event, '##-##-####')" required pattern="\d{2}-\d{2}-\d{4}">
                                                                        </div>
                                                                    </div>                                                                                                              
                                                                </div>
                                                            </div>                                                        
                                                        </div> 
                                                    </div>
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">Pis / Pasep:</label>
                                                                <label style="width: 160px;">Últ.Cont.Sindical:</label>
                                                                <label style="width: 150px;">Cert.Nasc./Casamento:</label>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;"> 
                                                                    <div class="form-group" style="width: 160px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getPispasep(); ?>" style="width: 160px;" class="form-control text-center" autofocus name="pispasep" id="InputPisPasep" required pattern="[0-9]{0,15}">
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group" id="CustDivPF" style="width: 160px; border: 0px #b92c28 solid;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getYearlastcontrib(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="yearlastcontrib" id="InputDateLastContrib" placeholder="0000" onkeyup="maskIt(this, event, '####')" pattern="\d{4}">
                                                                        </div>                                                       
                                                                    </div>
                                                                    <div class="form-group" id="CustDivPF" style="width: 160px; border: 0px #b92c28 solid;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getBirthormary_certif(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="certnascmaryd" id="InputCertNascMaryd" placeholder="0000000" onkeyup="maskIt(this, event, '######')" pattern="[0-9]{0,7}">
                                                                        </div>                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                   
                                                </div>

                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">Cart.de Habilitação:</label>
                                                                <label style="width: 160px;">Categoria:</label>
                                                                <label style="width: 150px;">Data de Validade:</label>
                                                            </div>                                                            
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;">  
                                                                    <div class="form-group" style="width: 160px;">                                 
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getCnh(); ?>" style="width: 160px;"  class="form-control text-center" autofocus name="numcnh" id="InputCnh" placeholder="000.000.000.000" onkeyup="maskIt(this, event, '###.###.###.###')" pattern="\d{3}.\d{3}.\d{3}.\d{3}">
                                                                        </div>
                                                                    </div>  
                                                                    <div class="form-group" style="width: 160px;"> 
                                                                        <div class="form-group" style="width: 160px;">  
                                                                            <input type="text" value="<?php echo $this->staff->getCnh_cat(); ?>"  style="width: 160px;"  class="form-control text-center" autofocus name="cnhcat" id="InputCnhCat">
                                                                        </div> 
                                                                    </div> 
                                                                    <div class="form-group" style="width: 160px;"> 
                                                                        <div class="form-group" style="width: 160px;">  
                                                                            <input type="text" value="<?php echo $this->staff->getCnh_dateofexpire(); ?>"  style="width: 160px;"  class="form-control text-center" autofocus name="cnhdateexpire" id="InputCnhDateExpire" onkeyup="maskIt(this, event, '##-##-####')" placeholder="00-00-0000" pattern="\d{2}-\d{2}-\d{4}">
                                                                        </div> 
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>                                                          
                                                    </div>
                                                    <div class="form-group" id="CustDivPF" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 160px;">Titulo de Eleitor:</label>
                                                                <label style="width: 160px;">Seção:</label>
                                                                <label style="width: 150px;">Zona:</label>
                                                            </div>                                                             
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;">                                                                      
                                                                    <div class="form-group" style="width: 160px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getTitlevote(); ?>"   style="width: 160px;" class="form-control text-center" autofocus name="titlevote" required id="InputTitleVote" pattern="[0-9]{0,12}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 160px;">     
                                                                        <div class="form-group" style="width: 160px;">                                                               
                                                                            <input type="text" value="<?php echo $this->staff->getTitlevote_sec(); ?>"  style="width: 160px;"  class="form-control text-center" autofocus name="titlevotesec" required id="InputTitleVoteSec" pattern="[0-9]{0,5}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 160px;"> 
                                                                        <div class="form-group" style="width: 160px;">  
                                                                            <input type="text" value="<?php echo $this->staff->getTitlevote_zone(); ?>"  style="width: 160px;"  class="form-control text-center" autofocus name="titlevotezn" required id="InputTitleVoteZone" pattern="[0-9]{0,5}">
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                                                                             
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim da Aba Documentos -->

                                            <!--Inicio da Aba Admissional -->                                          
                                            <div class="tab-pane" id="Adm">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 500px; border: 0px #b92c28 solid;"> 
                                                        <div class="form-group" id="StaffDivDateAdm" style="width: 170px; border: 0px #b92c28 solid;">
                                                            <label for="InputDateAdm">Data de Admissão:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getDate_admis(); ?>" style="width: 165px;" class="form-control text-center"  name="dateadm" id="InputDateAdm" onkeyup="maskIt(this, event, '##-##-####')" required placeholder="00-00-0000">
                                                            </div>
                                                        </div> 
                                                        <div class="form-group" style="width: 325px;  border: 0px #b92c28 solid;">
                                                            <div id="DivDepartment" class="form-group" style="width: 210px;">
                                                                <label for="InputDepart">Departamento:</label>
                                                                <select name="department_id" class="form-control text-center" style=" width: 210px;" >
                                                                    <?php
                                                                    if (isset($this->DepartList))
                                                                        foreach ($this->DepartList as $depart) {
                                                                            ?>
                                                                            <option value="<?php echo $depart->getDepartment_id(); ?>" <?php if ($depart->getDepartment_id() == $this->staff->getDepartment_id()) echo 'selected'; ?>><?php echo $depart->getShortname(); ?></option>                        
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                            <div class="form-group" style="width: 100px;padding-top: 25px;">
                                                                <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalDepartment" style="width: 105px;"  >Novo!</a>
                                                                <!--<a href class="btn btn-default btn-lg " ng-click="showComplex()">Show</a>
                                                                -->
                                                            </div> 
                                                        </div>                                                        
                                                    </div>
                                                    <div class="form-group" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="form-group" style="width: 165px;">
                                                            <label class="control-label" for="InputWorkload">Carga Horária:</label>
                                                            <input type="text" value="<?php echo $this->staff->getWorkload(); ?>" style="width: 165px;" class="form-control text-center" autofocus name="workload" required id="InputWorkload">
                                                        </div>
                                                        <div class="form-group" style="width: 165px;">
                                                            <label class="control-label" for="InputStartTime">Hora de Entrada:</label>
                                                            <input type="text" value="<?php echo $this->staff->getStarttime(); ?>" style="width: 165px;" class="form-control text-center" autofocus name="starttime" required id="InputStartTime" placeholder="00:00" onkeyup="maskIt(this, event, '##:##')"  pattern="[0-9:\u00C0-\u00ff]{0,5}">
                                                        </div>
                                                        <div class="form-group"  style="width: 165px;">
                                                            <label for="InputEndTime">Hora de Saída:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getEndtime(); ?>" style="width: 165px;" class="form-control text-center" autofocus name="endtime" required id="InputEndTime" placeholder="00:00" onkeyup="maskIt(this, event, '##:##')" pattern="[0-9:\u00C0-\u00ff]{0,5}">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 500px;">
                                                        <div class="form-group" style="width: 195px;">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading" style="height: 30px;">
                                                                    <label style="width: 100px;">Salário:</label>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="form-group" style="width: 195px; height: 50px;">                                                                      
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getSalary(); ?>" style="width: 170px;" class="form-control text-center" autofocus name="salary" required id="InputSalary" placeholder="0,00"  pattern="[0-9,]{0,15}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                              
                                                        </div>
                                                        <div class="form-group" id="StaffTransportTicket" style="width: 290px;">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading" style="height: 30px;">
                                                                    <label style="width: 290px;">Vale Transportes: (Sim/Não)?</label>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="form-group" style="width: 290px; height: 50px;">                                                                      
                                                                        <div>
                                                                            <label for="InputStaffTranportTicketYes">Sim:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getTransp_ticket() == 'Y') echo 'checked'; ?>  class="form-control text-center" autofocus name="transpticket" value="Y" required id="InputStaffTranportTicketYes">
                                                                            <label for="InputStaffTransportTicketNo">Não:</label>
                                                                            <input type="radio" style="width: 100px;" <?php if ($this->staff->getTransp_ticket() == 'N') echo 'checked'; ?>  class="form-control text-center" autofocus name="transpticket" value="N" required id="InputStaffTransportTicketNo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                               
                                                    </div>
                                                    <div class="form-group" style="width: 510px;">

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="height: 30px;">
                                                                <label style="width: 60px;">Quant-1:</label>
                                                                <label style="width: 90px;">Valor-1:</label>
                                                                <label style="width: 60px;">Quant-2:</label>
                                                                <label style="width: 90px;">Valor-2:</label>
                                                                <label style="width: 60px;">Quant-3:</label>
                                                                <label style="width: 90px;">Valor-3:</label>                                                                    
                                                            </div>                                                             
                                                            <div class="panel-body">
                                                                <div class="form-group" style="width: 495px; height: 50px;">                                                                      
                                                                    <div class="form-group" style="width: 60px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkqt1(); ?>" style="width: 60px;" class="form-control text-center" autofocus name="transptkqt1" placeholder="00" id="InputTranspTkQt1" pattern="[0-9]{0,15}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 90px;">     
                                                                        <div class="form-group" style="width: 90px;">                                                               
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkvl1(); ?>" style="width: 90px;"  class="form-control text-center" autofocus name="transptkvl1" placeholder="0,00" onkeyup="maskIt(this, event, '#,##')" id="InputTranspTkVl1" pattern="[0-9,.]{0,15}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 60px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkqt2(); ?>" style="width: 60px;" class="form-control text-center" autofocus name="transptkqt2" placeholder="00" id="InputTranspTkQt2" pattern="[0-9,.]{0,2}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 90px;">     
                                                                        <div class="form-group" style="width: 90px;">                                                               
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkvl2(); ?>" style="width: 90px;"  class="form-control text-center" autofocus name="transptkvl2" placeholder="0,00" onkeyup="maskIt(this, event, '#,##')" id="InputTranspTkVl2" pattern="[0-9,.]{0,15}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 60px;">
                                                                        <div>
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkqt3(); ?>" style="width: 60px;" class="form-control text-center" autofocus name="transptkqt3" placeholder="00" id="InputTranspTkQt3" pattern="[0-9]{0,2}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group" style="width: 90px;">     
                                                                        <div class="form-group" style="width: 90px;">                                                               
                                                                            <input type="text" value="<?php echo $this->staff->getTransptkvl3(); ?>" style="width: 90px;"  class="form-control text-center" autofocus name="transptkvl3" placeholder="0,00" onkeyup="maskIt(this, event, '#,##')" id="InputTranspTkVl3" pattern="[0-9,.]{0,15}">
                                                                        </div>
                                                                    </div>                                                                        
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- Fim da Aba Admissional -->

                                            <!--Inicio da Aba Bancários --> 
                                            <div class="tab-pane" id="Bank">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 510px;  border: 0px #b92c28 solid;">
                                                        <div class="form-group" style="width: 500px;  border: 0px #b92c28 solid;">
                                                            <div id="DivTypeAccount" class="form-group" style="width: 390px;">
                                                                <label for="InputAccountType">Tipo de Conta:</label>
                                                                <select name="typeaccount_id" class="form-control text-center" style=" width: 390px;" >
                                                                    <?php
                                                                    if (isset($this->TypeAccountList))
                                                                        foreach ($this->TypeAccountList as $type) {
                                                                            ?>
                                                                            <option value="<?php echo $type->getTypeaccount_id(); ?>" <?php if ($type->getTypeaccount_id() == $this->staff->getTypeaccount_id()) echo 'selected'; ?>><?php echo $type->getDescription(); ?></option>                        
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                            <div class="form-group" style="width: 100px; margin-top: 25px;">
                                                                <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalTypeAccount" style="width: 105px;"  >Novo!</a>
                                                                <!--<a href class="btn btn-default btn-lg " ng-click="showComplex()">Show</a>
                                                                -->
                                                            </div>
                                                        </div>     
                                                    </div>  
                                                    <div class="form-group" style="width: 510px;  border: 0px #b92c28 solid;">
                                                        <div class="form-group" style="width: 500px;  border: 0px #b92c28 solid;">
                                                            <div id="BankBranch" class="form-group" style="width: 390px;">
                                                                <label for="InputBanks">Bancos:</label>
                                                                <select name="bank_id" class="form-control text-center" style=" width: 390px;" >
                                                                    <?php
                                                                    if (isset($this->BankList))
                                                                        foreach ($this->BankList as $bank) {
                                                                            ?>
                                                                            <option value="<?php echo $bank->getBankbranch_id(); ?>" <?php if ($bank->getBankbranch_id() == $this->staff->getBank_id()) echo 'selected'; ?>><?php echo $bank->getDescription(); ?></option>                        
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select> 
                                                            </div>
                                                            <div class="form-group" style="width: 100px; margin-top: 25px;">
                                                                <a data-toggle="modal" class="btn btn-primary btn-large" data-target="#ModalBankBranch" style="width: 105px;"  >Novo!</a>
                                                                <!--<a href class="btn btn-default btn-lg " ng-click="showComplex()">Show</a>
                                                                -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">  
                                                    <div class="form-group" style="width: 510px;  border: 0px #b92c28 solid;">
                                                        <div class="form-group"  style="width: 150px;">
                                                            <label for="InputOperation">Operação:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getOperation(); ?>" style="width: 150px;" class="form-control text-center" autofocus name="operation" id="InputOperation" placeholder="000000" pattern="[0-9]{0,10}">
                                                            </div>
                                                        </div>                                   
                                                        <div class="form-group"  style="width: 150px;">
                                                            <label for="InputAgency">Agência - Digito:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getAgency(); ?>" style="width: 150px;" class="form-control text-center" autofocus name="agency" id="InputAgency" placeholder="000000-00" pattern="[0-9-]{0,10}">
                                                            </div>
                                                        </div>                                                          
                                                        <div class="form-group"  style="width: 200px;">
                                                            <label for="InputCurrentAccount">Conta Corrente - Digito:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getAccount(); ?>" style="width: 200px;" class="form-control text-center" autofocus name="currentaccount" id="InputCurrentAgency" placeholder="00000-0/000" pattern="[0-9-/]{0,15}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="width: 510px;  border: 0px #b92c28 solid;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <label for="InputAccountHolder">Titular da Conta:</label>
                                                            <div>
                                                                <input type="text" value="<?php echo $this->staff->getAccount_holder(); ?>" style="width: 500px;" class="form-control text-center" autofocus name="account_holder" id="InputAccountHolder" placeholder="Titular da Conta.." pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim da Aba Bancários -->

                                            <!--Inicio da Aba Referência -->                                             
                                            <div class="tab-pane" id="Ref">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">  
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <label class="control-label" for="InputRefName">Nome da Referência:</label>
                                                            <input type="text" value="<?php echo $this->staff->getRefname(); ?>" style="width: 500px;" class="form-control text-center" autofocus name="refname" id="InputRefName" placeholder="Nome da Referência" pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
                                                        </div>   
                                                    </div>
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <label class="control-label" for="InputRefAddress">Endereço:</label>
                                                            <input type="text" value="<?php echo $this->staff->getRefaddress(); ?>"  style="width: 500px;" class="form-control text-center" autofocus name="refaddress" id="InputRefAddress" placeholder="Endereço da Referência" pattern="[0-9a-z\u00C0-\u00ffA-Z,._-\s]{0,40}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <label class="control-label" for="InputPhoneRef">Telefone:</label>
                                                            <input type="text" value="<?php echo $this->staff->getRefphone(); ?>"  style="width: 200px;" class="form-control text-center" autofocus name="refphone" id="InputPhoneRef" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                        </div>
                                                    </div>  
                                                    <div class="form-group" style="width: 510px;">
                                                        <div class="form-group" style="width: 500px;">
                                                            <label class="control-label" for="InputEmailRef">E-mail:</label>
                                                            <input type="email" value="<?php echo $this->staff->getRefemail(); ?>"  style="width: 300px;" class="form-control text-center" autofocus name="refemail" id="InputEmailRef" placeholder="E-mail" pattern="[a-z\u00C0-\u00ffA-Z._-@]{0,30}">
                                                        </div>
                                                    </div>                                                      
                                                </div>
                                            </div> 
                                            <!-- Fim da Aba Referência -->

                                            <!--Inicio da Aba Graduação -->                                             
                                            <div class="tab-pane" id="Educ">
                                                <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">  
                                                    <div class="form-group" style="width: 510px;">    
                                                        <div class="form-group" style="width: 350px; border: 0px #b92c28 solid; ">
                                                            <label for="ComboEducation">Escolaridade:</label>
                                                            <select name="education_id" class="form-control text-center"style="width: 350px;" >
                                                                <option value="13" <?php if ($this->staff->getEducation_id() == '13') echo 'selected'; ?>>Doutorado Completo</option>
                                                                <option value="12" <?php if ($this->staff->getEducation_id() == '12') echo 'selected'; ?>>Doutorado Incompleto</option>
                                                                <option value="11" <?php if ($this->staff->getEducation_id() == '11') echo 'selected'; ?>>Mestrado Completo</option>
                                                                <option value="10" <?php if ($this->staff->getEducation_id() == '10') echo 'selected'; ?>>Mestrado Incompleto</option>
                                                                <option value="9" <?php if ($this->staff->getEducation_id() == '9') echo 'selected'; ?>>Pós-graduação Completa</option>
                                                                <option value="8" <?php if ($this->staff->getEducation_id() == '8') echo 'selected'; ?>>Pós-graduação Incompleta</option>
                                                                <option value="7" <?php if ($this->staff->getEducation_id() == '7') echo 'selected'; ?>>Superior Completo</option>
                                                                <option value="6" <?php if ($this->staff->getEducation_id() == '6') echo 'selected'; ?>>Superior Incompleto</option>
                                                                <option value="15" <?php if ($this->staff->getEducation_id() == '15') echo 'selected'; ?>>Ensino Médio Técnico (2º Grau) Completo</option>
                                                                <option value="5" <?php if ($this->staff->getEducation_id() == '5') echo 'selected'; ?>>Ensino Médio (2º Grau) Completo</option>
                                                                <option value="14" <?php if ($this->staff->getEducation_id() == '14') echo 'selected'; ?>>Ensino Médio Técnico (2º Grau) Incompleto</option>
                                                                <option value="4" <?php if ($this->staff->getEducation_id() == '4') echo 'selected'; ?>>Ensino Médio (2º Grau) Incompleto</option>
                                                                <option value="3" <?php if ($this->staff->getEducation_id() == '3') echo 'selected'; ?>>Ensino Fundamental (1º Grau) Completo</option>
                                                                <option value="2" <?php if ($this->staff->getEducation_id() == '2') echo 'selected'; ?>>Ensino Fundamental (1º Grau) Incompleto</option>
                                                                <option value="1" <?php if ($this->staff->getEducation_id() == '1') echo 'selected'; ?>>Não Alfabetizado</option>
                                                            </select> 
                                                        </div>
                                                        <div class="form-group" style="width: 150px;"> 
                                                            <label for="InputYearCompletion">Ano da Conclusão:</label>
                                                            <div class="form-group" style="width: 150px;">  
                                                                <input type="text" value="<?php echo $this->staff->getYear_completion(); ?>" style="width: 150px;"  class="form-control text-center" autofocus name="yearcompletion" id="InputYearCompletion" placeholder="0000" onkeyup="maskIt(this, event, '####')" pattern="\d{4}">
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                    <div class="form-group" id="StaffDivOtherEducation" style="width: 510px; border: 0px #b92c28 solid;">
                                                        <div class="form-group"  style="width: 500px;">
                                                            <label for="InputOtherEducation">Outras Graduações/Cursos:</label>
                                                            <div>
                                                                <textarea class="form-control left" style="width: 500px; height: 80px;" name="othereducation" id="InputOtherEducation"><?= $this->staff->getOthereducation(); ?></textarea>                                        
                                                            </div> 
                                                        </div>
                                                    </div>                                                                                 
                                                </div>
                                            </div> 
                                            <!-- Fim da Aba Graduação -->
                                        </div>
                                    </div> <!-- /tabbable -->
                                </div>
                            </div>     <!-- End Doc/Information -->                       


                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Endereço...</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group" style="width: 570px;">
                                            <div class="form-group" style="width: 200px;">
                                                <label class="control-label" for="InputZipCode">Cep:</label>
                                                <input type="text" style="width: 195px;" class="form-control text-center" autofocus name="zipcode" value="<?php echo $this->staff->getZipcode();?>" id="InputZipCode" placeholder="Cep" onkeyup="maskIt(this, event, '#####-###')" required pattern="[0-9]{5}-[0-9]{3}">
                                                <input type="hidden" name="zipid" value="<?php echo $this->staff->getZipid();?>" id="AddHiddenZipId">
                                            </div>
                                            <div class="form-group"  style="width: 350px; margin-top: 18px; border: 0px #b92c28 solid;">
                                                <div class="form-group" style="width: 150px;">
                                                    <button type="button" id="buttonSearchZip" style="width: 150px;" class="form-control btn btn-warning">Pesquisar</button>
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
                                                <label class="control-label" for="InputAddress">Endereço:</label>
                                                <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="address" value="<?php echo $this->staff->getAddress();?>" id="InputAddress" placeholder="Endereço" required pattern="[0-9a-z\u00C0-\u00ffA-Z,._-\s]{0,40}">
                                            </div>
                                            <div class="form-group" style="width: 100px;">
                                                <label class="control-label" for="InputAddrNumber">Número:</label>
                                                <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="addr_number" value="<?php echo $this->staff->getAddr_number();?>"  id="InputAddrNumber" placeholder="Número" pattern="[a-zA-Z0-9,\u00C0-\u00ff\s]{0,15}">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 510px;">
                                            <label for="InputAddrComp">Complemento:</label>
                                            <div>
                                                <input type="text" style="width: 500px;" class="form-control text-center" autofocus name="addr_comp" value="<?php echo $this->staff->getComplement();?>"  id="InputAddrComp" placeholder="Complemento.." pattern="[0-9a-z\u00C0-\u00ffA-Z,._-\s]{0,40}">
                                            </div>                                                        
                                        </div>                                          
                                    </div>

                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group" style="width: 510px;">
                                            <label for="InputAddrDist">Bairro:</label>
                                            <div>
                                                <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="addr_dist" value="<?php echo $this->staff->getDistrict();?>"  id="InputAddrDist" placeholder="Bairro ou Localidade" required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,30}">
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 510px;">
                                            <div class="form-group" style="width: 400px;">
                                                <label for="InputAddrCity">Cidade:</label>
                                                <div>
                                                    <input type="text" style="width: 400px;" class="form-control text-center" autofocus name="addr_city" value="<?php echo $this->staff->getCity();?>"  id="InputAddrCity" placeholder="Cidade" required pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,25}">
                                                </div>
                                            </div>
                                            <div class="form-group"  style="width: 100px;">
                                                <label for="InputAddrState">Estado:</label>
                                                <div>
                                                    <input type="text" style="width: 100px;" class="form-control text-center" autofocus name="addr_state" value="<?php echo $this->staff->getState();?>"  id="InputAddrState" placeholder="Estado" required pattern="[a-zA-Z]{0,2}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group" style="width: 510px;">
                                            <label for="InputAddrRef">Ponto de Referência:</label>
                                            <div>
                                                <input type="text" style="width: 510px;" class="form-control text-center" autofocus name="addr_ref" value="<?php echo $this->staff->getReference();?>"  id="InputAddrRef" placeholder="Referência.." pattern="[a-z\u00C0-\u00ffA-Z._-\s]{0,40}">
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
                                            <div class="form-group"  style="width: 250px;">
                                                <label for="InputHomePhone">Telefone:</label>
                                                <div>
                                                    <input type="tel" style="width: 250px;" class="form-control text-center" autofocus name="home_phone" value="<?php echo $this->staff->getHome_phone();?>"  id="InputHomePhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" required pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                </div>
                                            </div>
                                            <div class="form-group"  style="width: 250px;">
                                                <label for="InputMobilPhone">Celular:</label>
                                                <div>
                                                    <input type="tel" style="width: 250px;" class="form-control text-center" autofocus name="mobil_phone" value="<?php echo $this->staff->getMobil_phone();?>"  id="InputMobilPhone" placeholder="(00)00000-0000" onkeyup="maskIt(this, event, '(##)#####-####')" pattern="\([0-9]{2}\)([0-9\s-]{1})?[0-9]{4}-[0-9]{4}">
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 510px;">
                                            <div class="form-group"  style="width: 250px; ">
                                                <label for="InputNextelPhone">Nextel Número:</label>
                                                <div>
                                                    <input type="tel" style="width: 250px;" class="form-control text-center" autofocus name="nextel_phone" value="<?php echo $this->staff->getNextel_phone();?>"  id="InputNextelPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                </div>
                                            </div>
                                            <div class="form-group"  style="width: 250px;">
                                                <label for="InputNextelID">Nextel ID:</label>
                                                <div>
                                                    <input type="text" style="width: 250px;" class="form-control text-center" autofocus name="nextel_id" value="<?php echo $this->staff->getNextel_id();?>"  id="InputNextelID" placeholder="99*999999" pattern="[0-9*]{0,9}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group"  style="width: 510px;">
                                            <div class="form-group"  style="width: 250px;">
                                                <label for="InputContactPhone">Telefone Para Contato:</label>
                                                <div>
                                                    <input type="tel" style="width: 250px;" class="form-control text-center" autofocus name="contact_phone" value="<?php echo $this->staff->getContact_phone();?>"  id="InputContactPhone" placeholder="(00)0000-0000" onkeyup="maskIt(this, event, '(##)####-####')" required pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                                </div>
                                            </div>
                                            <div class="form-group"  style="width: 250px;">
                                                <label for="InputContactMobil">Celular Para Contato:</label>
                                                <div>
                                                    <input type="tel" style="width: 250px;" class="form-control text-center" autofocus name="contact_mobil" value="<?php echo $this->staff->getContact_mobil();?>"  id="InputContactMobil" placeholder="(00)00000-0000" onkeyup="maskIt(this, event, '(##)#####-####')" pattern="\([0-9]{2}\)([0-9\s-]{1})?[0-9]{4}-[0-9]{4}">
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group"  style="width: 510px; ">
                                            <label for="InputContactName">Pessoa de Contato:</label>
                                            <div>
                                                <input type="text" style="width: 505px;" class="form-control text-center" autofocus name="contact_name" value="<?php echo $this->staff->getContact_name();?>" id="InputContactName" placeholder="Nome para Contato..."  pattern="[a-z\u00C0-\u00ffA-Z,._-\s]{0,40}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group"  style="width: 510px;">
                                            <label for="InputEmail">Email:</label>
                                            <div>
                                                <input type="email" style="width: 510px;" class="form-control text-center" name="email" value="<?php echo $this->staff->getEmail();?>"  id="InputEmail" placeholder="nome@provedora.com.br">
                                            </div>                                            
                                        </div>
                                        <div class="form-group"  style="width: 510px;">
                                            <label for="InputNote">Observação:</label>
                                            <div>
                                                <textarea class="form-control left" style="width: 510px;" name="staff_msg" id="InputNote"><?= $this->staff->getContact_msg();?></textarea>                                        
                                            </div>                                             
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary"  style="width: auto; margin-top: 15px; margin-bottom: 15px; margin-right: 20px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Outros...</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-inline" style="margin-top: 5px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group"  style="width: 1030px; height: 150px;">
                                            <label for="InputStaffNote">Observação Sobre o Colaborador:</label>
                                            <div>
                                                <textarea class="form-control left" style="width: 1030px; height: 130px;" name="contact_msg" id="InputStaffNote"><?= $this->staff->getStaff_msg(); ?></textarea>                                        
                                            </div>                                             
                                        </div>
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
     * Function send file
     * and set data to form. 
     * @param {type} param
     */
    $(document).ready(function () {
        $("#buttonSearchZip").click(function () {
            var zipcode = $("#InputZipCode").val();
           // console.log('Zip Code:....' + zipcode);
            var urlapp = "<?php echo URL; ?>mngstaff/findZip?zipcode=";
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
                        $("#AddHiddenZipId").val(obj.id);
                        $("#InputAddress")  .val(obj.street);
                        $("#InputAddrComp") .val(obj.complement);
                        $("#InputAddrDist") .val(obj.district);
                        $("#InputAddrCity") .val(obj.city);
                        $("#InputAddrState").val(obj.state);
                        //
                    } else {
                        $('#DivErroMsg').html("<div class='form-group' <div class='error col-xs-offset-1 col-xs-10'><div class='alert alert-warning alert-dismissable' style='text-align: center; background: #F6DFBD;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong  style='color: #CB3E3A;'>Cep não encontrado no cadastro, pesquise nos correios!!!</strong><br/><strong><a href='http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco' target='_blank'>Pesquisar nos Correios...</a></strong></div></div></div>");
                    }
                }});
        });
    });

    /**
     * @param {type} param1
     * @param {type} param2
     * @param {type} param3     
     **/
    $(document).on("click", "#OpenModalUpload", function () {
        //

        //
    });

    /**
     * @param {type} param1
     * @param {type} param2
     * @param {type} param3     
     **/
    $(document).on("click", "#OpenModalEditPhoto", function () {
        //

        //
    });

    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function changeCustomer(resSelect) {
        //
        if (resSelect === 'CM') {
            $('#SELCustomer').prop('disabled', false); //To Show
            //
        }
        else if (resSelect === 'CP') {
            //
            $("#SELCustomer").prop('disabled', true); //To Hide
        }

        console.log("Value of Select: " + resSelect);
    }

    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function changeForFemale(resSelect) {
        //
        if (resSelect === 'M') {
            $('#InputCrsm').prop('disabled', false); //To Show
            $('#InputCrsmSerie').prop('disabled', false);
            $('#InputCrsmCat').prop('disabled', false);

        }
        else if (resSelect === 'F') {
            //
            $("#InputCrsm").prop('disabled', true); //To Hide
            $('#InputCrsmSerie').prop('disabled', true);
            $('#InputCrsmCat').prop('disabled', true);
        }

        console.log("Value of Select: " + resSelect);
    }


    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function changeForNationality(resSelect) {
        //
        if (resSelect === 'E') {
            $('#InputCountryState').prop('disabled', false); //To Enable           
        }
        else if (resSelect === 'B') {
            //
            $("#InputCountryState").prop('disabled', true); //To Disable
        }

        console.log("Value of Select: " + resSelect);
    }


    /**
     * Function to control hidden or show div's to 
     * customer Individual or Corporate. 
     * @param {type} resSelect
     * @returns {undefined}     
     */
    function changeForMaritalState(resSelect) {
        //
        if (resSelect === 'SG' || resSelect === 'SP' || resSelect === 'WD') {
            $('#InputWifesName').prop('disabled', true); //To Disable           
        }
        else if (resSelect === 'MR' || resSelect === 'ST') {
            //
            $("#InputWifesName").prop('disabled', false); //To Enable
        }

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