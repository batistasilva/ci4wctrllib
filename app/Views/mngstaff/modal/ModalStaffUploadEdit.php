<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Enviar Foto do Colaborador</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <script src="<?php echo URL; ?>views/mngstaff/modal/js/jquery.form.min.js"></script>     
        <link href="<?php echo URL; ?>views/mngstaff/modal/css/style.css" rel="stylesheet" type="text/css">      
    </head>
    <body>
        <div class="modal fade" id="ModalEditUpload">
            <div class="modal-dialog" style="width: 650px;">
                <div class="modal-content">
                    <div class="modal-header" style="background: #3072AB; color: #FFFFFF;" >
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Fechar</span>
                        </button>
                        <h3 class="modal-title" id="memberModalLabel">Foto do Colaborador</h3>
                    </div>
                    <div class="modal-body">
                        <div id="upload-wrapper">
                            <div align="center">
                                <form action="<?php echo URL; ?>mngstaff/UploadFileUpdate" method="post" enctype="multipart/form-data" id="MyEditUploadForm">
                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group" style="width: 350px;">
                                            <input name="image_file" id="imageInput" type="file" />
                                        </div>
                                        <div class="form-group" style="width: 150px;">
                                            <input type="submit"  id="submit-btn" value="Enviar Imagem" />
                                        </div>
                                        <input type="hidden" id="PersonID" name="person_id"     value="<?php echo $this->staff->getPerson_id(); ?>"/>
                                        <input type="hidden" id="InputName" name="name"  value="<?php echo $this->staff->getName(); ?>"/>
                                        <input type="hidden" id="InputSurname" name="surname"  value="<?php echo $this->staff->getSurname(); ?>"/>
                                        <input type="hidden" id="InputAcronym" name="local_id"  value="<?php echo $this->staff->getLocal_id(); ?>"/>
                                        <input type="hidden" id="Customer_id" name="customer_id"  value="<?php echo $this->staff->getCustomer_id(); ?>"/>
                                        <input type="hidden" id="Company_id" name="company_id"  value="<?php echo $this->staff->getCompany_id(); ?>"/>
                                    </div>
                                    <div class="form-inline" style="margin-top: 10px; margin-left: 5px; margin-bottom: 10px;">
                                        <div class="form-group" style="width: 500px;">
                                            <img src="<?php echo URL; ?>views/mngstaff/modal/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                                        </div>
                                    </div> 
                                </form>
                                <div id="output"></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Sair</a>
                    </div>
                    <!-- where the response will be displayed -->
                    <div id='res-department'></div>
                </div>
            </div>  
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            var options = {
                target: '#output', // target element(s) to be updated with server response 
                beforeSubmit: beforeSubmit, // pre-submit callback 
                success: afterSuccess, // post-submit callback 
                resetForm: true        // reset the form after successful submit 
            };

            $('#MyEditUploadForm').submit(function () {
                $(this).ajaxSubmit(options);
                // always return false to prevent standard browser submit and page navigation 
                return false;
            });
        });

        function afterSuccess()
        {
            $('#submit-btn').show(); //hide submit button
            $('#loading-img').hide(); //hide submit button
            $("#OpenModalPhotoEdit").toggleClass("disabled", false);
            $('#OpenModalUpload').toggleClass("disabled", true);

            console.log('Sucesso no Upload!!');
        }

        //function to check file size before uploading.
        function beforeSubmit() {
            //check whether browser fully supports all File API
            if (window.File && window.FileReader && window.FileList && window.Blob)
            {

                if (!$('#imageInput').val()) //check empty input filed
                {
                    $("#output").html("Selecione uma Imagem!");
                    return false;
                }

                var fsize = $('#imageInput')[0].files[0].size; //get file size
                var ftype = $('#imageInput')[0].files[0].type; // get file type

                //allow only valid image file types 
                switch (ftype)
                {
                    case 'image/png':
                    case 'image/gif':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                        break;
                    default:
                        $("#output").html("<b>" + ftype + "</b> Tipo de Arquivo não Suportado!");
                        return false
                }

                //Allowed file size is less than 2 MB (2097152)
                if (fsize > 2097152)
                {
                    $("#output").html("<b>" + bytesToSize(fsize) + "</b> Tamanho de Imagem acima do Permitido! <br />Por favor reduza a imagem.");
                    return false
                }

                $('#submit-btn').hide(); //hide submit button
                $('#loading-img').show(); //hide submit button
                $("#output").html("");
            }
            else
            {
                //Output error to older browsers that do not support HTML5 File API
                $("#output").html("Por favor atualize seu navegador de internet para um que der suporte ao html5!");
                return false;
            }
        }

        //function to format bites bit.ly/19yoIPO
        function bytesToSize(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0)
                return '0 Bytes';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }
    </script>
</html>

