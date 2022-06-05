
<?php

    require("./htmlTopPlusNavigace.phtml");

    $povoleneTypySouboru = [
        "image/jpeg",
        "image/png",
        "image/gif"
    ];
?>

<h1>Jak se u nás máte</h1>
<h2>Přidej se k nám a pošli se svoji fotku jak se v gymu máš</h2>


<form method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="file" accept="<?= implode(", ", $povoleneTypySouboru) ?>">
    </div>
    <div class= "foto">

        <input type="submit" value="Nahrát soubor">
    </div>
</form>
<div class="fotky">
    <div class = "vnitrek2">
    <?php
$slozka = "fotky";
if (!file_exists($slozka)) mkdir($slozka);

if (isset($_FILES["file"])) {
  if (in_array($_FILES["file"]["type"], $povoleneTypySouboru))  
    move_uploaded_file(
        $_FILES["file"]["tmp_name"], // zdroj (absolutní cesta)
        $slozka . "/" . $_FILES["file"]["name"] // cíl (relativní cesta)
    );
  else
    echo "<p>Nahrávaný soubor nemá správný formát!</p>";  
}

?>
<section id= "sekce">
<?php


$dir = opendir($slozka);
while (($nazevSouboru = readdir($dir)) !== false) {
   if ($nazevSouboru != "." && $nazevSouboru != ".."){
   ?> 
    <img class="fotecka" src="fotky//<?=$nazevSouboru?>" alt="" width="200px">
<?php
                                                    }
}
?>
</section>
    </div>

<pre>
<?php
//var_dump($_FILES);
?>
</pre>
</div>
</body>
</html>