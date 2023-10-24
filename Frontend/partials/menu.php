<div class="ui primary pointing menu">
    <a href="/" class="<?php if ($_SERVER["REQUEST_URI"] == "/") echo "active"; ?> teal item">
        Home
    </a>
    <?php if (isset($_SESSION["isLoggedIn"])): ?>
        <a href="/profile" class="<?php if ($_SERVER["REQUEST_URI"] == "/profile") echo "active"; ?> teal item">
            Profile
        </a>
        <?php if ($_SESSION["role"] == "admin"): ?>
            <a href="/admin-area" class="<?php if ($_SERVER["REQUEST_URI"] == "/admin-area") echo "active"; ?> teal item">
                Admin Area
            </a>
        <?php endif; ?>
        <?php if ($_SESSION["role"] !== "user"): ?>
            <a href="/manager-area" class="<?php if ($_SERVER["REQUEST_URI"] == "/manager-area") echo "active"; ?> teal item">
                Manager Area
            </a>
        <?php endif; ?>
        <a href="/user-area" class="<?php if ($_SERVER["REQUEST_URI"] == "/user-area") echo "active"; ?> teal item">
            User Area
        </a>
    <?php endif; ?>
    <div class="right menu">
        <?php if (isset($_SESSION["isLoggedIn"])): ?>
            <a href="/logout" class="ui teal item">
                LogOut
            </a>
        <?php else: ?>
            <a href="/register" class="ui teal item">
                SignUp
            </a>
            <a href="/login" class="ui teal item">
                LogIn
            </a>
        <?php endif; ?>
    </div>
</div>