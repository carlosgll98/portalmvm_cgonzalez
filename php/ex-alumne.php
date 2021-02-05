<?php
session_start();
if ($_SESSION["rol"] == "ex-alumne") {
    include 'dbconnect.php';
    include 'logmanager.php';
    $select = "select * from cgonzalezmvm_portalmvm.vacants where practiques_dual='laboral'";
    $vacants = mysqli_query($conn, $select);

    echo '
	<head>
		<title>Portal Ex-alumne</title>
		<meta name="Keyword" content="Portal Treball MVM">
		<meta name="author" content="Carlos Gonzalez Llopis">
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<meta charset="UTF-8">
	</head>
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
    <div id="topbuttons">
        <form action="" method="post">
          <button type="submit" name="Sortir" value="Sortir">Sortir</button>
        </form>
    </div>
    <img class="logo2" src="../images/logo.png" alt="LogoMVM">
    <div id="contentaula">
		<div id="formtaula">
            <table border="1" cellspacing=1 cellpadding=2">
            <tr>
              <th>ID</th>
              <th>EMPRESA</th>
              <th>TITOL</th>
              <th>DESCRIPCIÓ LLOC</th>
              <th>DESCRIPCIÓ VACANTS</th>
              <th>TIPUS DE PRÁCTIQUES</th>
              <th>CONTACTE</th>
              <th>ACCIONS</th>
          </tr>
        </div>
    </div>
    ';
    while ($entrada = mysqli_fetch_array($vacants)) {
        echo "<tr>";
        echo "<td>" . $entrada['id'] . "</td>";
        echo "<td>" . $entrada['empresa'] . "</td>";
        echo "<td>" . $entrada['titol'] . "</td>";
        echo "<td>" . $entrada['descripcio_lloc'] . "</td>";
        echo "<td>" . $entrada['descripcio_vacant'] . "</td>";
        echo "<td>" . $entrada['practiques_dual'] . "</td>";
        echo "<td>" . $entrada['contacte'] . "</td>";
        echo '<td>
            <form action="" method="post">
                <button type="submit" name="Llegir" value="'.$entrada['id'].'">Llegir</button>
                <button type="submit" name="Contactar" value="'.$entrada['id'].'">Contactar</button> 
            </form>
            </td>';

        echo "</tr>";
    }
    echo "</table>";






    if (isset($_POST['Llegir'])){
        $_SESSION['linia']=$_POST['Llegir'];
        $action = utf8_decode("INFO: El usuari " .$_SESSION["usermail"]. " ha llegit la vacant amb ID " .$_SESSION['linia'] );
        genlog($action);
        header("Location: ../php/lectura.php");
    }
    elseif (isset($_POST['Contactar'])){
        $_SESSION['linia']=$_POST['Contactar'];
        $action = utf8_decode("INFO: El usuari " .$_SESSION["usermail"]. " ha contactat per la vacant amb ID" .$_SESSION['linia'] );
        genlog($action);
        header("Location: ../php/optarvacant.php");
    }
    elseif (isset($_POST['Sortir'])){
        session_destroy();
        $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
        genlog($action);
        header("Location: ../index.php");
    }


}

