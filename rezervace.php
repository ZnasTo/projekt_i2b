<?php
require("./htmlTopPlusNavigace.phtml");
require("./funkce/funkce_uzivatele.php");

$db = mysqli_connect("localhost", "root", "", "projekt_i2b");
mysqli_set_charset($db, "utf8");

if (isset($_GET["odstranit"])) {
    odstranRezevaci($db, $_GET["odstranit"]); 
    if ($chybaDB = mysqli_error($db))
      echo "<p>$chybaDB</p>";
    else  
      header("Location: rezervace.php");
}
?>

    <h1>Rezervace</h1>

    <div class="vnitrek">
    <?php
    
    if(isset($_SESSION["uzivatel"])){
    


    ?>
    <?php
    $dotazTreneri ="
                    SELECT * FROM treneri
                ";
                $vysledekDotazuTreneri = mysqli_query($db, $dotazTreneri);
                $treneri = mysqli_fetch_all($vysledekDotazuTreneri,
            MYSQLI_ASSOC);
    ?>
    <form method="post"class = "formular">
        <div class = "Rezervace">
        <label for="den">Vyber den</label>
        <select name="den" id="den">
            <option value="">---Vyber den---</option>
            <?php for ($i=0; $i < 7 ; $i++) {  ?>
                <option value="<?=date("Y-m-d",strtotime("+$i day",time()));?>"><?=date("d.m.",strtotime("+$i day",time()));?></option>
    
            <?php } ?>
        </select>
        </div>
        <div class = "Rezervace">
            <label for="trener" >Vyber trenera</label>
            <select name="trener" id="trener" class = "test">
            <option value="">---Vyber trenera---</option>
                <?php foreach ($treneri as $trener) {  ?>
                    <option value="<?=$trener["ID_trenera"]?>"><?=$trener["jmeno"] . " " . $trener["prijmeni"] ?></option>
        
                <?php } ?>
            </select>
        </div>
        <div class = "Rezervace">
        <label for="cas">Vyber čas</label>
        <select name="cas" id="cas">
            <option value="">---Vyber čas---</option>
            <?php for ($i=0; $i < 13 ; $i++) {  ?>
                <option value="<?=date("G:i",strtotime("8:00")+strtotime("$i:0"));?>"><?=date("G:i",strtotime("8:00")+strtotime("$i:0"));?></option>
            <?php } ?>
        </select>
        </div>
        <input type="submit" id ="submit" value="odeslat">
    </form>

    <?php 
        if(isset($_POST["den"]))
        if (($_POST["den"]!= "") && $_POST["cas"]!= ""  && $_POST["trener"]!= "" ) {
            $dotazOdeslani = "
            INSERT INTO rezervace
            (uzivatel,datum_rezervace,rezervona_doba,ID_trenera)
            VALUES
            ('{$_SESSION["uzivatel"]["ID_uzivatele"]}','{$_POST["den"]}','{$_POST["cas"]}','{$_POST["trener"]}')
            ";
            mysqli_query($db, $dotazOdeslani);
        }
        
        else echo "špatně vyplněný formulář";

        if(isset($_SESSION["uzivatel"])){
            
            $dotazUzivatele ="
                            SELECT * FROM uzivatele
                        ";
                        $vysledekDOtazuUzivatele = mysqli_query($db, $dotazUzivatele);
                        $uzivatele = mysqli_fetch_all($vysledekDOtazuUzivatele,
                    MYSQLI_ASSOC);
            
            
            $dotazZiskaniRezervaci ="
                SELECT * FROM rezervace
                WHERE CURDATE() < datum_rezervace
            ";
            $vysledekDotazuRezevace = mysqli_query($db, $dotazZiskaniRezervaci);
            $rezervace = mysqli_fetch_all($vysledekDotazuRezevace,
        MYSQLI_ASSOC);
            

        if($_SESSION["uzivatel"]["role"] == 3){
            ?>
            <h2>
                Vaše rezervace
            </h2>
            <p>
                Pokud se zde vaše rezervace ani po odeslání nezobrazí,
                tak se neuložila, z důvodů zabrání termínu rezervace.
            </p>
        
        <table class = "tabulkaRezervace">
            <thead>
                <tr>
                    <th>ID rezervace</th>
                    <th>uživatel</th>
                    <th>datum rezervace</th>
                    <th>rezervovaná doba</th>
                    <th>Trener</th>
                    <th>X</th>
                </tr>
            </thead>
    
                    <?php
                foreach($rezervace as $rez){
                    ?>
                
                <?php
                if($_SESSION["uzivatel"]["ID_uzivatele"]== $rez["uzivatel"]){
                ?>
                <tr>
                    <td><?= $rez["ID_rezervace"] ?></td>
                    
                    
                    <?php foreach($uzivatele as $uzivat){?>

                    
                    <?php if($rez["uzivatel"]==$uzivat["ID_uzivatele"]){
                    ?>
                    <td>
                    <?= $uzivat["login"]?>
                    <?php }
                    //echo "";
                    ?>
                    </td>


                    <?php }?>  

                    <td><?= $rez["datum_rezervace"] ?></td>
                    <td><?= $rez["rezervona_doba"] ?></td>
                    <?php
                foreach($treneri as $trener){?>

                    
                    <?php if($rez["ID_trenera"]==$trener["ID_trenera"]){
                    ?>
                    <td>
                    <?= $trener["jmeno"]. " " . $trener["prijmeni"] ?>
                    </td>
                    <?php }
                    //echo "";
                    ?>
                    
                    
                    <?php }?>  
                    <td>
                    <a href="?odstranit=<?= $rez["ID_rezervace"] ?>">Odstranit</a>
                    </td>
                </tr>
                
                <?php } 
             } ?>        
            </table>
            
            
            <?php
        }
        if($_SESSION["uzivatel"]["role"] <= 2){
            ?>
                <h2>
                    Všechny rezervace
                </h2>
            <table class = "tabulkaRezervace">
            <thead>
                <tr>
                    <th>ID rezervace</th>
                    <th>uživatel</th>
                    <th>datum rezervace</th>
                    <th>rezervovaná doba</th>
                    <th>Trener</th>
                    <th>X</th>
                </tr>
            </thead>
    
                    <?php
                foreach($rezervace as $rez){
                    ?>
                


                <tr>
                    <td><?= $rez["ID_rezervace"] ?></td>
                    
                    
                    <?php foreach($uzivatele as $uzivat){?>

                    
                    <?php if($rez["uzivatel"]==$uzivat["ID_uzivatele"]){
                    ?>
                    <td>
                    <?= $uzivat["login"]?>
                    <?php }
                    //echo "";
                    ?>
                    </td>


                    <?php }?>  

                    <td><?= $rez["datum_rezervace"] ?></td>
                    <td><?= $rez["rezervona_doba"] ?></td>
                    <?php
                foreach($treneri as $trener){?>

                    
                    <?php if($rez["ID_trenera"]==$trener["ID_trenera"]){
                    ?>
                     <td>
                    <?= $trener["jmeno"]. " " . $trener["prijmeni"] ?>
                    </td>
                    <?php }
                    //echo "";
                    ?>
                    
                    
                    
                    <?php }?>  
                    <td>
                    <a href="?odstranit=<?= $rez["ID_rezervace"] ?>">Odstranit</a>
                    </td>
                </tr>
                
                <?php 
             } ?>        
            </table>
            <?php                      
        }
    }
    
     ?>
    </div>
    
    <?php
    }
    require("./htmlBottom.html");
    ?>