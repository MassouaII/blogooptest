<?php
include("includes/header.php");
if(!$session->is_signed_in()){
    header("location:login.php");
}
include("includes/sidebar.php");

?>
    <div id="main">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="page-header">All Users</h1>
                    <a href="add_user.php" class="btn btn-primary">
                        <i class="bi bi-person-add"> User</i>
                    </a>
                </div>

                <hr>

                <table class="table table-dark mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>USERNAME</th>

                        <th>FIRST_NAME</th>
                        <th>LAST_NAME</th>
                        <th>DELETED AT</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = User::find_all_users();
                    ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="text-bold-500"><?php echo $user->id; ?></td>
                            <td class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <img src="<?php echo $user->picture_path_and_placeholder(); ?>"
                                         alt="avtar img holder">
                                </div>
                                <?php echo $user->username; ?>
                            </td>

                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td>
                            <td><?php echo $user->deleted_at; ?></td>
                            <td class="d-flex">
                                <a href="edit_user.php?id=<?php echo $user->id; ?>">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                                <a href="delete_user.php?id=<?php echo $user->id; ?>">
                                    <i class="bi bi-trash text-danger"></i>
                                </a>
                                <!-- Voeg de checkbox toe met een unieke ID -->

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           id="deleteSwitch<?php echo $user->id; ?>"
                                        <?php echo ($user->deleted_at == '0000-00-00 00:00:00') ? 'checked' : ''; ?>>
                                </div>







                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>


<?php
include("includes/footer.php");
?>