<div class="container">
    <h1>Reserva gerada com sucesso!, anote o número de sua reserva!!</h1>
    <?php if (isset($_SESSION['rsvcode'])): ?>
        <div class="form-group">
            <div class="error">
                <div class="alert alert-success alert-dismissable" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $_SESSION['rsvcode']; ?></strong>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION['rsvcode']);
        //Finaliza a sessão para a mensagem não ficar sendo exibida com reflesh
        ?>
    
    <?php endif; ?>      
</div> 
