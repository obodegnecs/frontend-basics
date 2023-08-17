<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superglobals</title>
    <?php
    session_start();

    if (isset($_GET["submitted"])) {
        if (!isset($_GET["superglobal"])) {
            $error_message = "Please select one of the options!";
        } elseif ($_GET["superglobal"] === "GLOBALS") {
            $message = $GLOBALS;
        } elseif (array_key_exists($_GET["superglobal"], $GLOBALS)) {
            foreach ($GLOBALS as $global => $value) {
                if ($global === $_GET["superglobal"]) {
                    $message = $value;
                    break;
                }
            }
        } else {
            $error_message = "It is not a valid superglobal!";
        }
    }
    ?>
</head>
<body>
    <h1>Superglobals</h1>
    <form action="superglobals.php" method="get" id="superglobals-form" >
        <label for="superglobal">Choose a superglobal:</label>
        <select name="superglobal" id="superglobal" form="superglobals-form" required>
            <option value="" selected disabled>- Please select -</option>
            <option value="GLOBALS">$GLOBALS</option>
            <option value="_SERVER">$_SERVER</option>
            <option value="_REQUEST">$_REQUEST</option>
            <option value="_POST">$_POST</option>
            <option value="_GET">$_GET</option>
            <option value="_FILES">$_FILES</option>
            <option value="_ENV">$_ENV</option>
            <option value="_COOKIE">$_COOKIE</option>
            <option value="_SESSION">$_SESSION</option>
        </select>
        <input type="submit" value="Export superglobal">
        <input type="hidden" id="submitted" name="submitted" value="true">
    </form>
    <?php
    if (isset($error_message)) {
        echo "<h2>" . $error_message . "</h2>";
    }
    ?>
    <pre>
        <?php
        if (isset($message)) {
            var_export($message);
        }
        ?>
    </pre>
</body>
</html>