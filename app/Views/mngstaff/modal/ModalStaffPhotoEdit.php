<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Foto do Colaborador</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">

            /* Apply these styles only when #preview-pane has
               been placed within the Jcrop widget */
            .jcrop-holder #preview-pane {
                display: block;
                position: absolute;
                z-index: 2000;
                top: 10px;
                right: -280px;
                padding: 6px;
                border: 1px rgba(0,0,0,.4) solid;
                background-color: white;

                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;

                -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            }

            /* The Javascript code will set the aspect ratio of the crop
               area based on the size of the thumbnail preview,
               specified here */
            #preview-pane .preview-container {
                width: 140px;
                height: 200px;
                /* width: 250px;
                 height: 170px;*/
                overflow: hidden;
            }

            form.coords input
            {
                width: 3em;
            }

        </style>       
    </head>
    <body>
        <div class="modal fade" id="ModalStaffPhotoEdit">
            <div class="modal-dialog" style="width: 1000px;">
                <div class="modal-content">
                    <div class="modal-header" style="background: #3072AB; color: #FFFFFF;" >
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Fechar</span>
                        </button>
                        <h3 class="modal-title" id="memberModalLabel">Foto do Colaborador</h3>
                    </div>
                    <div class="modal-body"> 
                        <div class="jc-demo-box" id="DemoBox">
                            <?php
                            //
                            $person_id = $this->staff->getPerson_id();                            //                         
                            //                                                  
                            $image = $this->staff->getImagepath();
                            
                           // print_r($image);

                            $image_path = URL . $image;

                            //
                            $imagesize = getimagesize($image_path);
                            //Width
                            $image_w = $imagesize[0];
                            //Height
                            $image_h = $imagesize[1];
                            
                            //
                            ?>
                            <img src="<?= $image_path; ?>" id="target" <?php echo $imagesize[3]; ?> alt="[Corte da Imagem]" />
                            <div id="preview-pane">
                                <div class="preview-container">
                                    <img src="<?= $image_path; ?>" <?php echo $imagesize[3]; ?> class="jcrop-preview" alt="Pré-Visualizar" />
                                </div>
                            </div>
                            <form id="coords"
                                  class="coords"
                                  onsubmit="return false;"
                                  action="<?php echo URL; ?>mngstaff/UpdateCropImg/<?php echo $person_id; ?>" method="POST">
                                <div class="inline-labels">
                                    <label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
                                    <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
                                    <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
                                    <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
                                    <label>W <input type="text" size="4" id="w" name="w" /></label>
                                    <label>H <input type="text" size="4" id="h" name="h" /></label>
                                </div>
                            </form>

                            <div id="res-staffphoto"></div>
                        </div>                     
                    </div>
                </div>
                <div class="modal-footer" style="background: #FAEBD7; color: #FFFFFF;">
                    <input class="btn btn-success <?php if(($image_w * $image_h) == 63280) echo 'disabled';?>" type="submit" value="Salvar!" id="submitSendPhoto">
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Sair</a>
                </div>
                <!-- where the response will be displayed -->
                <div id='res-department'></div>
                <div class="clearfix"> </div>                
            </div>
        </div>  
    </div>
</body>
<script type="text/javascript">
    jQuery(function ($) {

        // Create variables (in this scope) to hold the API and image size
        var jcrop_api,
                // Grab some information about the preview pane
                $preview = $('#preview-pane'),
                $pcnt = $('#preview-pane .preview-container'),
                $pimg = $('#preview-pane .preview-container img'),
                xsize = $pcnt.width(),
                ysize = $pcnt.height();

        $('#target').Jcrop({
            onChange: updatePreview,
            onRelease: clearCoords,
            onSelect: updatePreview,
            aspectRatio: xsize / ysize
        }, function () {
            // Use the API to get the real image size
            // Store the API in the jcrop_api variable
            jcrop_api = this;

            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });

        function updatePreview(c)
        {
            if (parseInt(c.w) > 0)
            {
                var rx = xsize / c.w;
                var ry = ysize / c.h;

                $pimg.css({
                    width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
                    height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });

                $('#x1').val(parseInt(c.x));
                $('#y1').val(parseInt(c.y));
                $('#x2').val(parseInt(c.x2));
                $('#y2').val(parseInt(c.y2));
                $('#w').val(parseInt(c.w));
                $('#h').val(parseInt(c.h));

            }

        }
        ;

        $('#coords').on('change', 'input', function (e) {
            var x1 = $('#x1').val(),
                    x2 = $('#x2').val(),
                    y1 = $('#y1').val(),
                    y2 = $('#y2').val();
            jcrop_api.setSelect([x1, y1, x2, y2]);
        });

    });


    function clearCoords()
    {
        $('#coords input').val('');
    }
    ;

    /***
     * Funtion to add a new Department for Staff.
     */
    $(document).ready(function () {
        $("#submitSendPhoto").click(function () {
            var person_id = <?php echo $person_id; ?>;
            //
            var urlapp = "<?php echo URL; ?>mngstaff/UpdateCropImg/";
            console.log(urlapp + person_id);

            $.ajax({
                type: "POST",
                url: urlapp + person_id,
                data: $('#coords').serialize()
            }).done(function (data) {
                //var obj = $.parseJSON(data);
                // show the response
                $('#StaffPhotEdit').toggleClass("disabled", true);;
                $('#res-staffphoto').html(data);
                console.log("Result....: " + data);
                $("#x1").val('');
                $("#y1").val('');
                $("#x2").val('');
                $("#y2").val('');
                $("#w").val('');
                $("#h").val('');
                //
                //search_department();

            }).fail(function (data) {
                $('#res-staffphoto').html(data);
                console.log("Falha ao Enviar a Imagem....: " + data);
                // just in case posting your form failed
            });
        });
    });

</script>
</html>


