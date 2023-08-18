<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add</title>
    <?php
    $options = [
        'options' => [
            'default' => 2,
            'max_range' => 20,
            'min_range' => 2
        ]];

    if (!isset($_GET["number"])) {
        $number = 2;
    } else {
        $number = filter_var($_GET["number"], FILTER_VALIDATE_INT, $options);
    }

    if (isset($_GET["submitted"])) {
        $sum = 0;

        for ($i = 1; $i <= $number; $i++) {
            if (empty($_GET["float-selector-" . $i])) {
                $error_message = "You have to choose a number in every input!";
                break;
            } elseif (!is_numeric($_GET["float-selector-" . $i])) {
                $error_message = "Your input has to be a number!";
                break;
            } else {
                $filter = FILTER_VALIDATE_FLOAT;
                $float = filter_var($_GET["float-selector-" . $i], $filter);
                $sum += $float;
            }
        }
    }
    ?>
    <script type="text/javascript">
        function validate() {
            const forms = document.querySelectorAll('form');
            const form = forms[0];
            let message = "";

            Array.from(form.elements).forEach((input) => {
                if (input.type === "number") {
                    if (input.value === "") {
                        message = "You have to choose a number in every input!";
                        input.focus();
                        return false;
                    }
                    return true;
                } else if (input.getAttribute("class") === "float-selector") {
                    message = "Your input has to be a number!";
                    input.focus();
                    return false;
                }
                return true;
            });
            if(message !== "") {
                alert(message);
            }
        }
    </script>
</head>
<body>
    <h1>Add</h1>
    <form action="add.php" method="get" id="add-form"
          name="add-form" onsubmit = "return(validate());">
        <?php
        for ($i = 1; $i <= $number; $i++) {
            echo "<label for='float-selector-$i'>Number $i</label>
                  <input type='number' step=any id='float-selector-$i'
                  name='float-selector-$i' class='float-selector' required>
                  </br>";
        }
        echo "<input type='hidden' id='number' name='number' value=$number>"
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
        echo "<h2>$error_message</h2>";
    } elseif (isset($sum)) {
        echo "<h2>The sum of the numbers: $sum</h2>";
    }
    ?>
</body>
</html>