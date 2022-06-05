<?php
    require("./login.phtml");

    $db = mysqli_connect("localhost", "root", "", "projekt_i2b");
    mysqli_set_charset($db, "utf8");

    require("./funkce/funkce_uzivatele.php");

    if(isset($_POST["login"])){
        prihlas($db,$_POST);
    }

?>