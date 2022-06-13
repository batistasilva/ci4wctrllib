<div class="container">
    <h1>
        <p>
            Não foi possível realizar o seu cadastro!. Por favor, entre em contato com o administrador do site para informar o erro!
        </p>
    </h1>
    <?php if (isset($_SESSION['form_error'])): ?>
        <div class="form-group">
            <div class="error">
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $_SESSION['form_error']; ?></strong>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION['form_error']);
        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
        ?>
    <?php endif; ?>      
</div>