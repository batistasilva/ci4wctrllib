<div class="container">
    <h1>Erro na geração da reserva, entre em cotato com o seto administrativo do site!</h1>
    <?php if (isset($_SESSION['createRsvCust'])): ?>
        <div class="form-group">
            <div class="error">
                <div class="alert alert-danger alert-dismissable" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $_SESSION['createRsvCust']; ?></strong>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION['createRsvCust']);
        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
        ?>
    
    <?php endif; ?>  
</div>