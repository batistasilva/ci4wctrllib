<?= $this->extend("app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                List Member
                <a href="<?= base_url('add-user') ?>" style="margin-top: -7px;" class="btn btn-info pull-right">Add User</a>
            </div>
            <div class="panel-body">

                <?php
                    if(session()->has("success")){
                        ?>
                            <div class="alert alert-success">
                                <?= session("success") ?>
                            </div>
                        <?php
                    }
                ?>

                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <td><?php echo $user->getId(); ?></td>
                                <td><?php echo $user->getUsername(); ?></td>
                                <td><?php echo $user->getEmail(); ?></td>
                                <td><?php echo $user->getStatus(); ?></td>
                                <td>
                                    <a href="<?= base_url('edit-user/' . $user->getId()); ?>" class="btn btn-info">Edit</a>
                                    <a href="<?= base_url('delete-user/' . $user->getId()); ?>" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>