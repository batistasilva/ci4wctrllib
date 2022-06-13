<div class="container">
    <h1><p>Seus dados foram cadastrados com sucesso!, vefique seu e-mail para fazer a validação do seu cadastro!</p></h1>
    <?php if (isset($_SESSION['form_okay'])): ?>
        <div class="form-group">
            <div class="error">
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $_SESSION['form_okay']; ?></strong>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION['form_okay']);
        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
        ?>
    <?php endif; ?>      
</div>
