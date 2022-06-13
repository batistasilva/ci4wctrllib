<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Cadastro de Images Carrossel</strong></small>
                </span>
                <hr>
                <form action="<?php echo URL; ?>admcontents/create" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputDesc1">Descrição1:</label>
                        <div class="col-xs-8">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" autofocus name="desc1" id="InputDesc1" placeholder="Descrição Curta" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputDesc2">Descrição2:</label>
                        <div class="col-xs-8">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" name="desc2" id="InputDesc2" placeholder="Decrição Longa da Imagem" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-xs-4" for="InputImage">Imagem do Quarto:</label>
                            <div class="col-xs-8">
                                <div class="input-group">
                                    <input type="file" name="imagem" id="InputImage" required>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if (isset($_SESSION['erroimgMsg'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['erroimgMsg']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['erroimgMsg']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['msgImagem'])): ?>
                        <div class="form-group col-xs-12">
                            <div class="error">
                                <div class="alert alert-success alert-dismissable" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong><?php echo $_SESSION['msgImagem']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <?php
                        unset($_SESSION['msgImagem']);
                        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
                        ?>
                    <?php endif; ?>                     

                    <div class="form-group">
                        <div class="col-xs-offset-1">
                            <button type="submit" class="btn btn-warning">Confirmar</button>
                        </div>
                    </div>  
                </form>
                <hr />

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center">Images Cadastradas</div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="text-align: left;">
                                <th>Descrição1</th>
                                <th>Descrição2</th>
                                <th>Imagem</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php
                            if (isset($this->imgList))
                                foreach ($this->imgList as $img)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $img->getDesc1(); ?></td>
                                        <td><?php echo $img->getDesc2(); ?></td>
                                        <td><?php echo $img->getImagem(); ?></td>
                                        <td><a class="delete" href="<?php echo URL; ?>admcontents/delete/<?php echo $img->getImgid(); ?>">Remover</a></td>
                                    </tr>                           
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- /container -->