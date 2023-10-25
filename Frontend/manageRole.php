<?php

require_once("Utils".DIRECTORY_SEPARATOR."functions.php");

$path = getPath();

$pathParams = explode("/manage-user-role/", $path);

$userId = end($pathParams);

$user = getUser($userId);

if ($user === null)
{
    redirectWithMessage("/", "info", "No such user exists.");

    die();
}

?>
<div style="margin-top: 5vh; padding: 20px; background-color: rgb(245, 255, 255);">
    <h3 class="ui header centered">
        Manage Role for - <i><?php echo "@{$user->username}"; ?></i>
    </h3>

    <h4 class="ui header centered">Current role : <i><?php echo $user->role; ?></i></h4>

    <form action="/assign-role" method="POST" class="ui form">
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
        <div class="field">
            <label>Assign a different role for <i><?php echo "@{$user->username}" ?></i></label>
            <select name="role" required>
                <option value="">assign a role</option>
                <option <?php if ($user->role == "admin") echo "selected"; ?> value="admin">admin</option>
                <option <?php if ($user->role == "manager") echo "selected"; ?> value="manager">manager</option>
            </select>
        </div>
        <button class="ui large green button" type="submit">Assign</button>
    </form>

    <?php if ($user->role !== "user"): ?>

        <div style="display: flex; justify-content: center; padding: 3vh 0">
            <b><a href="/role/remove/<?php echo $userId; ?>" style="color: #f33">
                Remove Role
            </a></b>
        </div>

    <?php endif; ?>

</div>