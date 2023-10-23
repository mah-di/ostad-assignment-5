<?php if(isset($_SESSION["message"])): ?>
    <div style="margin-top: 5vh;" class="ui <?php if (isset($_SESSION["error"])) echo "negative"; if (isset($_SESSION["success"])) echo "positive"; if (isset($_SESSION["info"])) echo "teal"; ?> message">
        <i class="close icon"></i>
        <div>
            <?php echo $_SESSION["message"]; ?>
        </div>
    </div>
<?php endif; ?>