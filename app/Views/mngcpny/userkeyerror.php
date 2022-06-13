<div class="container">
    <h1>Erro de chave de cadastro!</h1>
    <?php if (isset($_SESSION['userkey_error'])): ?>
        <div class="form-group">
            <div class="error">
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $_SESSION['userkey_error']; ?></strong>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION['userkey_error']);
        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
        ?>
    <?php endif; ?>  
</div>
