<?php
function prihlas($db,$udajeUzivatele){
    
    $dotazPrihlaseni = "
    SELECT *
    FROM uzivatele
    WHERE login = '{$udajeUzivatele["login"]}'
      AND heslo = '" .sha1($udajeUzivatele["heslo"]) ."'
          ";
    $vysledekDotazu = mysqli_query($db, $dotazPrihlaseni);
    $uzivatel = mysqli_fetch_assoc($vysledekDotazu);

    if($uzivatel){
        $_SESSION["uzivatel"] = $uzivatel;
        header("Location: index.php");
        exit;
    }
    else{
        echo "<p>"."Špatné Jméno nebo heslo"."</p>";
    }
}
function odhlas(){
    //session_destroy();
    unset($_SESSION["uzivatel"]);
    header("Location: index.php");
    exit;
}
function registruj($db,$udajeUzivatele){
    $shaHeslo = sha1($udajeUzivatele["heslo"]);

    $dotazRegistrace = "
    INSERT INTO uzivatele
    (login,heslo,role)
    VALUES
    ('{$udajeUzivatele["login"]}','$shaHeslo',3)
    ";
    mysqli_query($db, $dotazRegistrace);
}
function odstranRezevaci($db, $idRezervace) {
    $sql = 
    "DELETE FROM rezervace
    WHERE ID_rezervace = $idRezervace
    ";
    
    mysqli_query($db, $sql);
}








//<-------------------- můj vzor

//tedka neposlouchej
//    die D: