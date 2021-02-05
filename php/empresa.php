<?php
session_start();
if ($_SESSION["rol"]=="empresa"){
    include 'dbconnect.php';
    include 'logmanager.php';
    $select="select * from cgonzalezmvm_portalmvm.vacants where empresa='".$_SESSION["empresa"]."'";
    $vacants=mysqli_query($conn, $select);
    echo '
    <head>
		<title>Portal Empresa</title>
		<meta name="Keyword" content="Portal Treball MVM">
		<meta name="author" content="Carlos Gonzalez Llopis">
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<meta charset="UTF-8">
	</head>
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
    while($entrada=mysqli_fetch_array($vacants)){
    echo "<tr>";
        echo "<td>" . $entrada['id'] . "</td>";
        echo "<td>" . $entrada['empresa'] . "</td>";
        echo "<td>" . $entrada['titol'] . "</td>";
        echo "<td>" . $entrada['descripcio_lloc'] . "</td>";
        echo "<td>" . $entrada['descripcio_vacant'] . "</td>";
        echo "<td>" . $entrada['practiques_dual'] . "</td>";
        echo "<td>" . $entrada['contacte'] . "</td>";
        echo '<td>
            <form class="panelbotons" action="" method="post">
                <button type="submit" name="Llegir" value="'.$entrada['id'].'">Llegir</button>
                <button type="submit" name="Editar" value="'.$entrada['id'].'">Editar</button>
                <button type="submit" name="Borrar" value="'.$entrada['id'].'">Borrar</button>  
            </form></td>'
;

    echo "</tr>";
    }
    echo "</table>";
    echo '<form action="" method="post"> 
              <div class="panelbotons" id="buttons">
				<input type="submit" name="Novavacant" value="Nova vacant">
				<input type="submit" name="Sortir" value="Sortir">
               </div>
            </form>';

    if (isset($_POST['Llegir'])){
        $_SESSION['linia']=$_POST['Llegir'];
        header("Location: ../php/lectura.php");
        $action = utf8_decode("INFO: El usuari " .$_SESSION["usermail"]. " ha llegit la vacant amb ID " .$_SESSION['linia'] );
        genlog($action);
    }
    elseif (isset($_POST['Editar'])){
        $_SESSION['linia']=$_POST['Editar'];
        header("Location: ../php/edicio.php");
    }
    elseif (isset($_POST['Borrar'])){
        $_SESSION['linia']=$_POST['Borrar'];
        $action = utf8_decode("DELETE: El usuari " .$_SESSION["usermail"]. " ha esborrat la vacant amb ID " .$_SESSION['linia'] );
        genlog($action);
        header("Location: ../php/deleted.php");

    }
    elseif (isset($_POST['Sortir'])){
        session_destroy();
        $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
        genlog($action);
        header("Location: ../index.php");
    }
    elseif (isset($_POST['Novavacant'])){
        header("Location: ../php/novavacant.php");
    }


}