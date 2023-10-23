<?php
    require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

    $users = getUsers();
?>

<h3 class="ui blue header centered">Hello There, <i><?php echo isset($_SESSION["username"]) ? '@' . $_SESSION["username"] : "guest"; ?></i></h3>

<div style="margin: 10vh 0">
    <h2 class="ui header centered">Users</h2>
    
    <table class="ui celled striped teal table">
        <thead>
            <tr>
                <th>UserName</th>
                <?php if (isset($_SESSION["isLoggedIn"])): ?>
                    <th>Email</th>
                    <th>Role</th>
                <?php endif; ?>
                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
                    <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $userId => $user): ?>
                <tr>
                    <td>
                        <?php echo "@{$user->username}"; ?>
                    </td>
                    <?php if (isset($_SESSION["isLoggedIn"])): ?>
                        <td>
                            <?php echo $user->email; ?>
                        </td>
                        <td>
                            <?php echo $user->role; ?>
                        </td>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
                        <td>
                            <a href="/manage-user-role/<?php echo $userId; ?>">Manage Role</a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <?php if($_SESSION["userId"] == $userId): ?>
                                <a href="/profile#delete-profile">Delete</a>
                            <?php else: ?>
                                <a href="/delete/<?php echo $userId; ?>">Delete User</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>