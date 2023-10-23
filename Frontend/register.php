<div style="padding: 15vh 5vw; background-color: #fcfcfc">
    <h2 class="ui header centered">
        Sign Up
    </h2>

    <form method="POST" class="ui form">
        <div class="field">
            <label>UserName</label>
            <input type="text" name="username" placeholder="UserName" value="<?php echo $_SESSION["username"] ?? ""; ?>">
        </div>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" placeholder="example@email.com" value="<?php echo $_SESSION["email"] ?? ""; ?>">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="********">
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="passwordConfirm" placeholder="********">
        </div>
        <button type="submit" class="ui large teal button">SignUp</button>
    </form>

    <p style="margin-top: 30px">Already have an account? <a href="/login" class="ui link">Log In.</a></p>
</div>