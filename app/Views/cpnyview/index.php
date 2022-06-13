<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                    <small>
                        <strong>Administração - Cadastro de Empresa</strong>
                    </small>
                </span>
                <?php
                ?>
                <hr>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading text-center"><small><strong>Empresas Cadastradas</strong></small></div>
                    <div style="border: solid #0E3B8C 2px; overflow: scroll; height: 250px;">
                        <!-- Table -->
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr style="text-align: left;">
                                    <th>Razão Social</th>
                                    <th>Nome Fantasia</th>
                                    <th>Status</th>
                                    <th>Data de Cadastro</th>
                                    <th>Alterar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php if (!empty($cpny_list) && is_array($cpny_list)) : ?>
                                    <?php foreach ($cpny_list as $cpny): ?>
                                    <?php
                                    $date = date_create($cpny->date_create);
                                    $date_new_create = date_format($date, "d-m-Y H:m:s");
                                    ?>
                                    <tr>
                                        <td><?= esc($cpny->longname) ?></td>
                                        <td><?= esc($cpny->shortname) ?></td>
                                        <td><?= esc($cpny->status) == '1' ? "Ativo" : "Inativo"?></td>
                                        <td><?php echo $date_new_create; ?></td>
                                        <td><a class="delete" href="<?= site_url('cpnyedit') ?>/<?= esc($cpny->company_id, 'url')?>">Alterar</a></td>
                                        <td><a class="delete" href="/cpnydel/<?= esc($cpny->company_id, 'url')?>">Remover</a></td>
                                    </tr>                           
                                    <?php endforeach; ?>
                                <?php else :?>
                                    <h3>No Company</h3>
                                    <p>Unable to find any Company for you.</p>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- /container -->