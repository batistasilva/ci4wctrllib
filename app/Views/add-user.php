<?= $this->extend("app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Add User
                <a href="<?= base_url('list-users') ?>" style="margin-top: -7px;" class="btn btn-info pull-right">List Users</a>
            </div>
            <div class="panel-body">
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <hr>
                <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="" action="<?= base_url('add-user') ?>" method="post">
                    <div class="form-control">
                        <div class='form group text-primary'>
                            <svg width="32" height="32" fill="currentColor" class="bi bi-person-circle" ><use xlink:href="#user-1"/></svg>                                
                        </div>
                        <div class="form-group">
                            <label for="username">User</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header card-group">
                                <div class="col-sm">
                                    <svg width="32" height="32" fill="currentColor" class="text-success" ><use xlink:href="#question-status"/></svg>                                                                        
                                </div>
                                <div class="card-title col-sm  fw-bold text-success">
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="card-body card-group">
                                <div class="col-sm">
                                    <input class="form-check-input" type="radio" name="Status" id="status" value="A" checked>
                                    <label class="form-check-label" for="status">Active</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-check-input" type="radio" name="Status" id="status" value="I">
                                    <label class="form-check-label" for="status">Inative</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="form-group">
                            <div class="col-sm text-primary">
                                <svg width="32" height="32" fill="currentColor" class="text-primary" ><use xlink:href="#file-text"/></svg>                                                                                                                         
                            </div>
                            <div class="col-sm">
                                <label for="note" class="form-label">Note...</label>
                            </div>                    
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="form-control">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>