<?= $this->extend("app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Update Member
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
                    <form class="" action="<?= base_url('edit-user/' . $user->getId()) ?>" method="post">
                        <div class="form-control">
                            <div class='form group text-primary'>
                                <svg width="32" height="32" fill="currentColor" class="bi bi-person-circle" ><use xlink:href="#user-1"/></svg>                                
                            </div>
                            <div class="form-group">
                                <label for="username">User</label>
                                <input type="text" class="form-control" name="username" readonly id="username" value="<?= $user->getUsername(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?= $user->getEmail(); ?>">
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
                                        <input class="form-check-input" type="radio" name="Status" id="status" value="A" <?php if ($user->getStatus() == 'A') echo 'checked'; ?>>
                                            <label class="form-check-label" for="status">Active</label>
                                    </div>
                                    <div class="col-sm">
                                        <input class="form-check-input" type="radio" name="Status" id="status" value="I" <?php if ($user->getStatus() == 'I') echo 'checked'; ?>>
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
                                    <textarea class="form-control" name="note" id="note" rows="3"><?= $user->getNote(); ?></textarea>
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