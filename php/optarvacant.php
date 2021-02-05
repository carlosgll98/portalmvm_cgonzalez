<?php
include "logmanager.php";
session_start();
if ($_SESSION["rol"] == "alumne") {
    echo '<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Optar Vacant</title>
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
		<div id="contenidor2">
			<div id="form2">
				<form action="" method="post"> 
                     <p>Hem envíat un mail al teu tutor para la vacant amb ID: ' .$_SESSION["linia"].'</p>
			         <input type="submit" name="Enrere" value="Enrere">
                </form>
			</div>
		</div>
	</main>
	</body>
	</html>';

    if (isset($_POST["Enrere"])){
        header("Location: ../php/alumne.php");
    }
    elseif (isset($_POST['Sortir'])){
        session_destroy();
        $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
        genlog($action);
        header("Location: ../index.php");
    }

}
elseif ($_SESSION["rol"] == "ex-alumne") {

    echo '<DOCTYPE html>
	<html lang="es">
	<head>
		<title>Optar vacant</title>
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
				<form action="../php/optarvacant.php" method="post">
					<p>Nom:</p>
					<input type="text" name="nom" placeholder="Nom" id="nom" >
					<p>Cognom:</p>
					<input type="text" name="cognom" placeholder="Cognom" id="cognom" >
					<p>Email de contacte:</p>
					<input type="text" name="email" placeholder="Email" id="email" >
					<p>Teléfon de contacte:</p>
					<input type="text" name="telefon" placeholder="Teléfon" id="telefon" >
                    <p>Observacions</p>
                    <textarea name="comentarios" rows="10" cols="40"></textarea>
                    <p>Adjuntar CV:</p>
					<input type="file" id="cv" name="cv" >

					<div id="buttons">
						<input type="submit" name="submit" value="Enviar">
						<input type="reset" value="Esborrar">
                        <input type="submit" name="Enrere" value="Enrere">
					</div>
					
				</form>
			</div>
		</div>
	</main>
	</body>
	</html>';

    if (isset($_POST["submit"])){
        echo '<!DOCTYPE html>
	<html lang="es">
	<head>
		<title>Successful</title>
		<meta name="Keyword" content="Portal Treball MVM">
		<meta name="author" content="Carlos Gonzalez Llopis">
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<meta charset="UTF-8">
	</head>
	<body>
	<main>
		<div id="contenidor2">
			<div id="form2">
				<form action="" method="post"> 
                     <p>Hem enviat la teva solicitud a la empresa per la vacant amb ID: ' .$_SESSION["linia"].'</p>
			         <input type="submit" name="Enrere" value="Enrere">
                </form>
			</div>
		</div>
	</main>
	</body>
	</html>';

        if (isset($_POST["Enrere"])){
            header("Location: ../php/ex-alumne.php");
        }
    }
    elseif (isset($_POST["Enrere"])){
        header("Location: ../php/ex-alumne.php");
    }
    elseif (isset($_POST['Sortir'])){
        session_destroy();
        $action = utf8_decode("EXIT: El usuari " .$_SESSION["usermail"]. " ha tancat sessio");
        genlog($action);
        header("Location: ../index.php");
    }
}
