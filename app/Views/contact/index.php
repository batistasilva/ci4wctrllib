<div class="container">
    <div class="col-lg-13">
        <div class="row well" style="height: 768px; margin-top:0px; margin-left:0px; margin-right: 0px; margin-bottom: 0px;">
            <div class="thumbnail">
                <span class="thumbnail muted text-center" style="background-color: #0E3B8C; font-weight: bold; color: #FFFFFF;">
                     <small><strong>Formulário de Contato</strong></small>
                </span>  
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                        <form action="/contact/datasend" method="POST" class="form-group">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="InputName">Nome</label>
                                    <div class="controls">
                                        <input type="text" class="form-control text-center" autofocus name="name" id="InputName" placeholder="Nome e Sobrenome" required pattern="[a-zA-Z\u00C0-\u00ff\s]{0,40}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputEmail1">Email</label>
                                    <div class="controls">
                                        <input type="email" class="form-control text-center" name="email" id="InputEmail1" placeholder="contato@provedora.com.br" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputTelPhone">Telefone</label>
                                    <div class="controls">
                                        <input type="tel" class="form-control text-center" name="telphone" id="InputTelPhone" placeholder="(00)0000-0000" required pattern="\([0-9]{2}\)[0-9]{4}-[0-9]{4}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="InputMessage">Mensagem</label>
                                    <div class="controls">
                                        <textarea class="form-control left" name="message" id="InputMessage" required></textarea>                                        
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning">Confirmar</button>          
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>