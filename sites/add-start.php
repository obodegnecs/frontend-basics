<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add start</title>
    <?php
    if (isset($_GET["submitted"])) {
        if (!isset($_GET["number-selector"])) {
            $error_message = "Please select one of the options!";
        } elseif ($_GET["number-selector"] >= 2 && $_GET["number-selector"] <= 20) {
            header("Location: add.php?numbers=" . $_GET["number-selector"]);
        } else {
            $error_message = "The choosen number is not in the [2, 20] range!";
        }
    }
    ?>
</head>
<body>
    <h1>Add Start</h1>
    <form action="add-start.php" method="get" id="number-selector-form" >
        <label for="number-selector">How many numbers do you want to add?</label>
        <input type="number" id="number-selector" name="number-selector"
               min="2" max="20" value="2">
        <input type="submit" value="Display calculator">
        <input type="hidden" id="submitted" name="submitted" value="true">
    </form>
    <?php
    if (isset($error_message)) {
        echo "<h2>" . $error_message . "</h2>";
    }
    ?>
</body>
</html>