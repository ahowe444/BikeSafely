<?php
    $value = $_POST['query'];
    $formfield = $_POST['field'];
    if ($formfield == "email") {
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
            echo "Invalid email";
        } else {
            echo "<span>Valid</span>";
        }
    }
    echo $_POST['emai'];
?>

