<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add</title>
    <?php
    session_start();

    $number = 2;
    $options = array(
        'options' => array(
            'default' => 2,
            'max_range' => 20,
            'min_range' => 2
        ));

    if (isset($_GET["numbers"])) {
        $number = filter_var($_GET["numbers"], FILTER_VALIDATE_INT, $options);
        $_SESSION["numbers"] = $number;
    } elseif (isset($_GET["submitted"])) {
        $number = $_SESSION["numbers"];
        $sum = 0;

        for ($i = 1; $i <= $number; $i++) {
            if (empty($_GET["float-selector-" . $i])) {
                $error_message = "You have to choose a number in every input!";
                break;
            } else {
                $sum += $_GET["float-selector-" . $i];
            }
        }
    }
    ?>
</head>
<body>
    <h1>Add</h1>
    <form action="add.php" method="get" id="add-form">
        <?php
        for ($i = 1; $i <= $number; $i++) {
            echo "<label for='float-selector-$i'>Number $i</label>
                  <input type='number' step=any id='float-selector-$i'
                  name='float-selector-$i'>
                  </br>";
        }
        ?>
        <input type="submit" value="Add numbers">
        <input type="reset" value="Reset">
        <input type="hidden" id="submitted" name="submitted" value="true">
    </form>
    <a href="add-start.php">
        <button>Back</button>
    </a>
    <?php
    if (isset($error_message)) {
        echo "<h2>" . $error_message . "</h2>";
    } elseif (isset($sum)) {
        echo "<h2>The sum of the numbers: " . $sum . "</h2>";
    }
    ?>
</body>
</html>