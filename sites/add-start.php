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
            header("Location: add.php?number=" . $_GET["number-selector"]);
        } else {
            $error_message = "The chosen number is not in the [2, 20] range!";
        }
    }
    ?>
    <script type="text/javascript">
        function validate() {
            if( document.getElementById("number-selector").value === "" ) {
                alert( "Please select an option!" );
                document.getElementById("number-selector").focus() ;
                return false;
            } else if( isNaN(document.getElementById("number-selector").value) ) {
                alert( "Your input has to be a number!" );
                document.getElementById("number-selector").focus() ;
                return false;
            }else if( document.getElementById("number-selector").value < 2 ||
                document.getElementById("number-selector").value > 20) {
                alert( "The chosen number is not in the [2, 20] range!" );
                document.getElementById("number-selector").focus() ;
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Add Start</h1>
    <form action="add-start.php" method="get" id="number-selector-form"
          name="number-selector-form" onsubmit = "return(validate());">
        <label for="number-selector">How many numbers do you want to add?</label>
        <input type="number" id="number-selector" name="number-selector"
               min="2" max="20" value="2" required>
        <input type="submit" value="Display calculator">
        <input type="hidden" id="submitted" name="submitted" value="true">
    </form>
    <?php
    if (isset($error_message)) {
        echo "<h2>$error_message</h2>";
    }
    ?>
</body>
</html>