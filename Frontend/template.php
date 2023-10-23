<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
    <title>OSTAD | ASSIGNMENT 5</title>
</head>
<body style="background-color: #f2f2f2">

    <div class="ui container" style="background-color: #fff; min-height: 100vh; padding: 10vh 5vw">

        <?php 
            if ($_SESSION["view"] !== "register" && $_SESSION["view"] !== "login" && $_SESSION["view"] !== "404") require_once("partials".DIRECTORY_SEPARATOR."menu.php");

            require_once("partials".DIRECTORY_SEPARATOR."showMessage.php");
        ?>

        <?php require_once($_SESSION["view"] . '.php') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>

    <?php if(isset($_SESSION["message"])): ?>
    <script>
        $('.message .close').on('click', function() {
            $(this).closest('.message').transition('fade')
        })
    </script>
    <?php endif; ?>

</body>
</html>