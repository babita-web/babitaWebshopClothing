
<?php include ('includes/header.php');
if (!$session->is_signed_in()){
    redirect('login.php');
}
$roles = role::find_all();
?>
<?php include ('includes/sidebar.php')?>
<?php include ('includes/content-top.php')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-around">
                <h2>Welcome To roles Page</h2>

            </div>

            <a class="btn btn-primary rounded-0" href="add_role.php"><i class="fas fa-role-plus"></i>Add role</a>
            <table class="myTable table table-header">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>people of this role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($roles as $role) :
                    ?>
                    <tr>
                        <td><?php echo $role->id; ?></td>
                        <td><?php echo $role->position; ?></td>

                        <td>
                            <a href="role_users.php?id=<?php echo $role->id; ?>">
                                <?php
                                $users = User::find_the_role_users($role->id);
                                echo count($users);
                                ?>
                            </a>
                        </td>
                        <td>
                            <a href="edit_role.php?id=<?php echo $role->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="fas fa-user-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete_role.php?id=<?php echo $role->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="fas fa-user-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ('includes/footer.php')?>









