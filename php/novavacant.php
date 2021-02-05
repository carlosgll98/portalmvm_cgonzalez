<DOCTYPE html>
    <html lang="es">
    <head>
        <title>Nova Vacant</title>
        <meta name="Keyword" content="Portal Treball MVM">
        <meta name="author" content="Carlos Gonzalez Llopis">
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
        <meta charset="UTF-8">
    </head>
    <body>
    <div id="topbuttons">
        <form action="" method="post">
            <button type="submit" name="Sortir" value="Sortir">Sortir</button>
            <button type="submit" name="Enrere" value="Enrere">Enrere</button>
        </form>
    </div>
    <header>
        <img class="logo" src="../images/logo.png" alt="LogoMVM">
    </header>
    <main>
        <div id="contenidor">
            <div id="form">
                <h2>Afeguir Vacants MVM</h2>
                <form action="" method="post">
                    <p>Titol de la vacant:</p>
                    <input type="text" name="titol" placeholder="Titol" id="titol">
                    <p>Descripció de lloc:</p>
                    <input type="text" name="lloc" placeholder="Lloc" id="lloc">
                    <p>Descripció de vacant:</p>
                    <input type="text" name="vacant" placeholder="vacant" id="vacant">
                    <p>Tipus de práctiques:</p>
                    <select name="form_select">
                        <option value="dual">Dual</option>
                        <option value="FCT">FCT</option>
                        <option value="laboral">Laboral</option>
                    </select>
                    <p>Contacte:</p>
                    <input type="email" name="contacte" placeholder="contacte" id="contacte">
                    <div id="buttons">
                        <input type="submit" name="submit" value="Enviar dades">
                        <input type="reset" value="Esborrar">
                        <input type="submit" name="Enrere" value="Enrere">
                    </div>
                </form>
            </div>
        </div>
    </main>
    </body>
    </html>

<?php
include "dbconnect.php";
include "logmanager.php";
session_start();
if(isset($_POST["submit"])){
$insert="INSERT INTO cgonzalezmvm_portalmvm.vacants (empresa, titol, descripcio_lloc, descripcio_vacant, practiques_dual, contacte)
				VALUES ('".$_SESSION["empresa"]."', '".$_POST["titol"]."', '".$_POST["lloc"]."', '".$_POST["vacant"]."', '".$_POST["form_select"]."', '".$_POST["contacte"]."')";
mysqli_query($conn, $insert);
$action = utf8_decode("NEW: La empresa " .$_SESSION["empresa"]. " ha creat la vacant: " .$_POST["titol"] );
genlog($action);
header("Location: ../php/empresa.php");
}
elseif (isset($_POST["Enrere"])){
    header("Location: ../php/empresa.php");
}
elseif (isset($_POST["Sortir"])){
    session_destroy();
    $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
    genlog($action);
    header("Location: ../index.php");
}