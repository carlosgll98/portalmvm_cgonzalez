<?php
session_start();
include 'dbconnect.php';

$select = 'select * from cgonzalezmvm_portalmvm.vacants where id='.$_SESSION['linia'];
$lectura=mysqli_query($conn, $select);
while($entrada=mysqli_fetch_array($lectura)){
    $empresa=$entrada['empresa'];
    $titol=$entrada['titol'];
    $descripcio_lloc=$entrada['descripcio_lloc'];
    $descripcio_vacant=$entrada['descripcio_vacant'];
    $practiques_dual=$entrada['practiques_dual'];
    $contacte=$entrada['contacte'];

}
?>


<DOCTYPE html>
    <html lang="es">
    <head>
        <title>Lectura de vacant</title>
        <meta name="Keyword" content="Portal Treball MVM">
        <meta name="author" content="Carlos Gonzalez Llopis">
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
        <meta charset="UTF-8">
    </head>
    <body>
    <div id="topbuttons">
        <form action="" method="post">
            <button type="submit" name="Enrere" value="Enrere">Enrere</button>
            <button type="submit" name="Sortir" value="Sortir">Sortir</button>
        </form>
    </div>
    <header>
        <img class="logo" src="../images/logo.png" alt="LogoMVM">
    </header>
    <main>
        <div id="contenidor">
            <div id="form">
                <h2>Lecura de vacants MVM</h2>
                <form action="" method="post">
                    <p>Empresa:</p>
                    <input type="text" name="empresa" value="<?php echo $empresa ?>" id="empresa" readonly>
                    <p>Titol de la vacant:</p>
                    <input type="text" name="titol" value="<?php echo $titol ?>" id="titol" readonly>
                    <p>Descripció de lloc:</p>
                    <input type="text" name="lloc" value="<?php echo $descripcio_lloc ?>" id="lloc" readonly>
                    <p>Descripció de vacant:</p>
                    <input type="text" name="vacant" value="<?php echo $descripcio_vacant ?>" id="vacant" readonly>
                    <p>Tipus de práctiques:</p>
                    <input type="text" name="practiques" value="<?php echo $practiques_dual ?>" id="practiques" readonly>
                    <p>Contacte:</p>
                    <input type="email" name="contacte" placeholder="contacte" value="<?php echo $contacte ?>" id="contacte" readonly>
                    <div id="buttons">
                        <input type="submit" name="Enrere" value="Enrere">
                        <input type="submit" name="Sortir" value="Sortir">
                    </div>
                </form>
            </div>
        </div>
    </main>
    </body>
    </html>

<?php
include "logmanager.php";
if (isset($_POST['Sortir'])){
    session_destroy();
    $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
    genlog($action);
    header("Location: ../index.php");
}
elseif (isset($_POST['Enrere'])){
    if ($_SESSION["rol"]=="alumne"){
        header("Location: ../php/alumne.php");
    }
    elseif ($_SESSION["rol"]=="empresa"){
        header("Location: ../php/empresa.php");
    }
    elseif ($_SESSION["rol"]="ex-alumne"){
        header("Location: ../php/ex-alumne.php");
    }
}
?>