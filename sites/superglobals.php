<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superglobals</title>
    <?php
    session_start();

    $superglobal_list = ["globals" => $GLOBALS,
        "server" => $_SERVER,
        "request" => $_REQUEST,
        "post" => $_POST,
        "get" => $_GET,
        "files" => $_FILES,
        "env" => $_ENV,
        "cookie" => $_COOKIE,
        "session" => $_SESSION];

    if (isset($_GET["submitted"])) {
        if (!isset($_GET["superglobals"])) {
            $error_message = "Please select one of the options!";
        } elseif (array_key_exists($_GET["superglobals"], $superglobal_list)) {
            $message = $superglobal_list[$_GET["superglobals"]];
        } else {
            $error_message = "It is not a valid superglobal!";
        }
    }
    ?>
</head>
<body>
    <h1>Superglobals</h1>
    <form action="superglobals.php" method="get" id="superglobals-form" >
        <label for="superglobals">Choose a superglobal:</label>
        <select name="superglobals" id="superglobals" form="superglobals-form">
            <option value="" selected disabled>- Please select -</option>
            <option value="globals">$GLOBALS</option>
            <option value="server">$_SERVER</option>
            <option value="request">$_REQUEST</option>
            <option value="post">$_POST</option>
            <option value="get">$_GET</option>
            <option value="files">$_FILES</option>
            <option value="env">$_ENV</option>
            <option value="cookie">$_COOKIE</option>
            <option value="session">$_SESSION</option>
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