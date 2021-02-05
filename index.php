<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Portal MVM</title>
		<meta name="Keyword" content="Portal Treball MVM">
		<meta name="author" content="Carlos Gonzalez Llopis">
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<meta charset="UTF-8">
	</head>
	<body>
	<header>
		<img class="logo" src="../images/logo.png" alt="LogoMVM">

	</header>
	<main>
		<div id="contenidor">
			<div id="form">
				<h2>Login MVM</h2>
				<form action="index.php" method="post">
					<p>Usuari:</p>
					<input type="email" name="usuari" placeholder="usuari@institutmvm.cat"  id="user">
					<br/>
					<p>Contrasenya:</p>
					<input type="password" name="password" placeholder="Contrasenya" id="password">
					<div id="buttons">
						<input type="submit" name="submit" value="Entrar">
						<input type="reset" value="Esborrar">
						<input type="submit" name="registre" value="Vui registrar-me">
					</div>
				</form>
			</div>
		</div>
	</main>
	</body>
	</html>
<?php
	//error_reporting(0);
	if (isset($_SESSION["usermail"])){
		session_destroy();
	}

	session_start();
	include "php/dbconnect.php";
    include "php/logmanager.php";

    if (isset($_POST["submit"])){
        $user=($_POST['usuari']);
	    $password=($_POST['password']);
	    $check = "select * from cgonzalezmvm_portalmvm.usuaris where email = '$user' and contrassenya = '$password';";

	    if (mysqli_fetch_array(mysqli_query($conn, $check), MYSQLI_NUM)[0]!='' OR mysqli_fetch_array(mysqli_query($conn, $check), MYSQLI_NUM)[0]!=NULL){
	        $_SESSION["usermail"]=$user;
		    $_SESSION["password"]=$password;
	        $conrol = "select idrol from cgonzalezmvm_portalmvm.usuaris where email = '$user'";
		    $rol = mysqli_fetch_array(mysqli_query($conn, $conrol), MYSQLI_NUM)[0];

		    if ($rol == 0){
			    $_SESSION["rol"]="alumne";
			    header("Location: ../php/alumne.php");
		    }
		    elseif ($rol == 1){
			    $_SESSION["rol"]="empresa";
			    $selempresa = "select empresa from cgonzalezmvm_portalmvm.usuaris where email = '".$_SESSION["usermail"]."'";
			    $_SESSION["empresa"]=mysqli_fetch_array(mysqli_query($conn, $selempresa), MYSQLI_NUM)[0];
			    header("Location: ../php/empresa.php");
		    }
		    elseif ($rol == 2){
			    $_SESSION["rol"]="ex-alumne";
			    header("Location: ../php/ex-alumne.php");
		    }
		    echo '<p class="acces">'.$rol.'</p>';
            $action = utf8_decode("ACCES: Inici de sessio de l'usuari: ".$_SESSION["usermail"]. "");
            genlog2($action);
	    }

	    else{
		    echo '<p class="acces">Acces incorrecte</p>';
            $action = utf8_decode("WARNING: Intent d'acces incorrecte de l'usuari: ".$user );
            genlog2($action);
		}
	    mysqli_close($conn);

    }

	elseif (isset($_POST["registre"])){
        header("Location: ../php/registre.php");
    }

?>
