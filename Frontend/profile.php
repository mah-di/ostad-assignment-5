<div style="padding: 15vh 5vw; background-color: #fcfcfc">
    <h2 class="ui header centered">
        Hello <i><?php echo '@' . $_SESSION["username"]; ?></i>
    </h2>

    <form method="POST" class="ui form">
        <div class="field">
            <label>Your UserName</label>
            <input type="text" name="username" required value="<?php echo $_SESSION["username"]; ?>">
        </div>
        <div class="field">
            <label>You Email</label>
            <input type="email" name="email" required value="<?php echo $_SESSION["email"]; ?>">
        </div>
        <button type="submit" class="ui large teal button">Update</button>
    </form>
    
</div>

<div id="delete-profile" style="margin-top: 5vh; padding: 20px; background-color: #fdd;">

    <h3>Danger Zone</h3>

    <form action="/profile/delete" method="POST" class="ui form">
        <div class="field">
            <label>Enter Your Password</label>
            <input type="password" name="password" required placeholder="********">
        </div>
        <button class="ui large red button">Delete Profile</button>
    </form>
</div>