<?php if(isset($_SESSION["message"])): ?>
    <div style="margin-top: 5vh;" class="ui <?php if (isset($_SESSION["error"])) echo "negative"; if (isset($_SESSION["success"])) echo "positive"; if (isset($_SESSION["info"])) echo "teal"; ?> message">
        <i class="close icon"></i>
        <?php foreach ($_SESSION["message"] as $message): ?>
            <div>
            • <?php echo $message; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>