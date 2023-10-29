<div style="padding: 15vh 5vw; background-color: rgb(245, 255, 255);">
    <h2 class="ui header centered">
        Log In
    </h2>

    <form method="POST" class="ui form">
        <div class="field">
            <label>Email</label>
            <input type="text" required name="email" placeholder="example@email.com">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" required name="password" placeholder="*******">
        </div>
        <button class="ui large teal button" type="submit">LogIn</button>
    </form>

    <p style="margin-top: 30px">Don't have an account? <a href="/register" class="ui link">Sign Up.</a></p>
</div>