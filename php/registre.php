<DOCTYPE html>
	<html lang="es">
	<head>
		<title>Registre MVM</title>
		<meta name="Keyword" content="Portal Treball MVM">
		<meta name="author" content="Carlos Gonzalez Llopis">
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<meta charset="UTF-8">
		<script type="text/javascript">
			function showDiv(select){
				if(select.value==1){
					document.getElementById('hidden_div').style.display = "block";
				} else{
					document.getElementById('hidden_div').style.display = "none";
				}
			}
		</script>
	</head>
	<body>
	<header>
		<img class="logo" src="../images/logo.png" alt="LogoMVM">
	</header>
	<main>
		<div id="contenidor">
			<div id="form">
				<h2>Registre MVM</h2>
				<form action="../php/registre.php" method="post">
					<p>Persona de contacte:</p>
					<input type="text" name="contacte" placeholder="Contacte" id="contacte">
					<p>Email de contacte:</p>
					<input type="email" name="email" placeholder="Email" id="email">
					<p>Contrasenya:</p>
					<input type="password" name="contrasenya" placeholder="Contrasenya" id="contrasenya">
					<p>Seleccioni el tipus de perfil:</p>
					<select name="form_select" onchange="showDiv(this)" id="test">
						<option value="0">Alumne</option>
						<option value="1">Empresa</option>
						<option value="2">Ex-Alumne</option>
					</select>
					<div id="hidden_div" style="display:none;">
						<p>Nom de l'empresa:</p>
						<input type="text" name="empresa" placeholder="Empresa" id="empresa">
						<p>Observacions:</p>
						<input type="text" name="observacions" placeholder="Observacions" id="observacions">
					</div>

					<div id="buttons">
						<input type="submit" name="submit" value="Entrar">
						<input type="reset" value="Esborrar">
                        <input type="submit" name="portal" value="Accedir al PortalMVM">
					</div>
				</form>
			</div>
		</div>
	</main>
	</body>
	</html>

<?php

if (isset($_POST["submit"])){

include 'dbconnect.php';
include 'logmanager.php';

if (!$conn) {
	die("Error a la connexió " . mysqli_connect_error());
}

$contacte = utf8_decode($_POST['contacte']);
$email = utf8_decode($_POST['email']);
$contrassenya = utf8_decode($_POST['contrasenya']);
$idrol = utf8_decode($_POST['form_select']);
$empresa = utf8_decode($_POST['empresa']);
$observacions = utf8_decode($_POST['observacions']);


echo $contacte;
echo $email;
echo $contrassenya;
echo $idrol;
echo $empresa;
echo $observacions;

$sql = "INSERT INTO usuaris (contacte, email, contrassenya, idrol, empresa, observacions)
				VALUES ('".$contacte."', '".$email."', '".$contrassenya."', '".$idrol."', '".$empresa."', '".$observacions."')";

	if ($conn->query($sql) === TRUE) {
		echo " Usuari enregistrat correctament";
		$action = utf8_decode("NEW: Nou usuari enregistrat amb email $email");
        genlog($action);
	}
	else {
		echo "Error en la connexió". mysqli_connect_error();
		$action = utf8_decode("ERROR: Error en la connexio de mysql");
        genlog($action);
	}

}
elseif (isset($_POST["portal"])){
    header("Location: ../index.php");
}




?>

