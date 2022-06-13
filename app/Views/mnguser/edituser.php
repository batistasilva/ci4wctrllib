<div class="container">
    <div class="col-lg-12">
        <div class="row-fluid well" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 5px; background-color: #88394e; font-weight: bold; color: #FFFFFF; text-align: center;">
                    <small><strong>Alteração de Usuário</strong></small>
                </span>   
                <hr>
                <form method="post" action="<?php echo URL; ?>mnguser/updateSave/<?php echo $this->user->getUserid(); ?>" class="form-horizontal">
                    <div class="row">
                        <label class="control-label col-xs-2" for="InputUsername">Usuário:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="text" class="form-control text-center" name="username" readonly value="<?php echo $this->user->getUsername(); ?>" id="InputUsername">
                            </div>
                        </div>
                        <label class="control-label col-xs-1" for="InputPassword">Senha:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="password" class="form-control text-center" name="password" value="" id="InputPassword" required pattern="[a-zA-Z0-9\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="InputEmail">E-mail:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <input type="email" class="form-control text-center" name="email" readonly value="<?php echo $this->user->getEmail(); ?>" id="InputEmail" placeholder="Email" required pattern="[a-zA-Z0-9,.\u00C0-\u00ff\s]{0,40}">
                            </div>
                        </div>
                        <label class="control-label col-xs-1" for="SelectRole">Nível:</label>
                        <div class="col-xs-4">
                            <div class="input-group col-xs-10">
                                <select name="role" class="form-control text-center">
                                    <option value="owner"   <?php if ($this->user->getRole() == 'owner') echo 'selected'; ?>>Dono</option>
                                    <option value="admin"   <?php if ($this->user->getRole() == 'admin') echo 'selected'; ?>>Administrativo</option>
                                    <option value="default" <?php if ($this->user->getRole() == 'default') echo 'selected'; ?>>Padrão</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="SelectStatus">Status</label>
                        <div class="col-xs-4">
                            <select name="status" class="form-control text-center">
                                <option value="A" <?php if ($this->user->getStatus() == 'A') echo 'selected'; ?>>Ativo</option>
                                <option value="I" <?php if ($this->user->getStatus() == 'I') echo 'selected'; ?>>Inativo</option>
                            </select><br />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="InputComplement">Informativo:</label>
                        <div class="col-xs-6">
                            <div class="input-group col-xs-12">
                                <textarea class="form-control text-left" name="note" placeholder="Entre com algum informativo!" id="InputNote" required><?= $this->user->getNote(); ?></textarea>  
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>                    
                    <br>                         
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-warning">Confirmar</button>
                        </div>
                    </div>
                    <br>
                </form>
                <hr />
            </div>
        </div>
    </div>
</div>
</div><!-- /container -->