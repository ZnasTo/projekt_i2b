<?php
    require("./htmlTopPlusNavigace.phtml");


    $db = mysqli_connect("localhost", "root", "", "projekt_i2b");
    mysqli_set_charset($db, "utf8");

    require("./funkce/funkce_uzivatele.php");

    
    
?>
    <h1>Registrace</h1>

    <form method="post"  >
        <div class= "login">

            <div >  
                <label for="login">login</label>
                <input type="text" name="login" id="login" required>
            </div>
            <div>
                <label for="heslo">heslo</label>
                <input type="password" name="heslo" id="heslo" required >
            </div>
            <div>
    
                <label for="hesloZnovu">heslo znovu</label>   
                <input type="password" name="hesloZnovu" id="hesloZnovu" required >
            </div>
            
            <input type="submit" name="registrovat" value="registrovat">
        </div>
    </form>
    
    <?php
    if(isset($_POST["login"]) && isset($_POST["heslo"]) && isset($_POST["hesloZnovu"])){
        if(strcmp($_POST["heslo"],$_POST["hesloZnovu"])!=0){
            echo "<p>" . "Hesla se neshodují" . "</p>";
        }
        else{
            registruj($db,$_POST);
        }
    }
