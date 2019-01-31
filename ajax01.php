<?php 
header("access-control-allow-origin: *");
/*
if (isset($_POST["nombre"])&&isset($_POST["email"])&&isset($_POST["telefono"])&&isset($_POST["departameto"])) {
	$name = $_POST["nombre"];
	$email = $_POST["email"];
	$tlf = $_POST["telefono"];
	$departamento = $_POST["departameto"];

	//query = "INSERT INTO personas (Nombre ,Email ,Telefono ,Codigo_Puesto) VALUES ('".$name."', '".$email."', ".$tlf.", ".$departamento.")";
	$pdo = getConnection();
	$sql = "INSERT INTO personas (Nombre ,Email ,Telefono ,Codigo_Puesto) VALUES (?,?,?,?)";
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$name, $email, $tlf,$departamento]);
}
*/
if (isset($_GET["par"])) {
	$par = $_GET["par"];
	switch ($par) {
		case 0:
		CrearFormulario();
		break;
		case 1:
		VerInfo();
		break;
	}
}
if (isset($_GET["par02"])) {
	$par = $_GET["par02"];
	switch ($par) {
		case 0:
		VerInfoDepatamento01();
		break;
		case 1:
		VerInfoDepatamento02();
		break;
	}
}

function getConnection(){
	$host = "localhost";
	$db_name = "db01ajax";
	$username = "root";
	$password = "";
	$conn;
	$conn = null;
	try{
		$conn = new PDO("mysql:host=localhost;dbname=" . $db_name, $username, $password);
	}catch(PDOException $exception){
		echo "Connection error: " . $exception->getMessage();
	}
	return $conn;
}
function CrearFormulario(){
	CrearSelectPuesto();
	CrearInputNombre();
}
function CrearSelectPuesto(){
	$pdo = getConnection();
	$stmt = $pdo->query("SELECT * FROM puesto");
	$stmt->execute();
	$datos = $stmt->fetchAll();
	$num = $stmt->rowCount();
	$impSelect = "<br><select id='selectPuesto'><option value='' disabled selected>Seleciona un puesto</option>";
	for ($i=0; $i < $num; $i++) { 
		$impSelect .= "<option value='".($i+1)."'>".$datos[$i][1]."</option>";
	}
	$impSelect .= "</select>";
	echo $impSelect;
}

function CrearSelectDepartamento(){
	$pdo = getConnection();
	$stmt = $pdo->query("SELECT * FROM departamen");
	$stmt->execute();
	$datos = $stmt->fetchAll();
	$num = $stmt->rowCount();
	$impSelect = '<br><br> <select id="sel_dep" onchange="Selecionar_Dep()"><option value="" disabled selected>Seleciona un departamento</option>';
	for ($i=0; $i < $num; $i++) { 
		$impSelect .= "<option value='".$i."'>".$datos[$i][1]."</option>";
	}
	$impSelect .= "</select>";
	echo $impSelect;
}
function CrearInputNombre(){
	$impInput = '<br><br>Name <input type="text" id="id_name" name="f_name">';
	$impInput .='<br><br>Email <input type="text" id="id_email" name="f_email">';
	$impInput .='<br><br>Telefono <input type="text" id="f_telefono" name="f_telefono">';
	$impInput .='<br><br><button name="crearUsuario" type="submit" onclick="loadXMLDocCrearUsuario()" value="0">Crear nuevo usuario</button>';
	echo $impInput;
}

function VerInfo(){
	CrearSelectDepartamento();
	$pdo = getConnection();
	$stmt = $pdo->query("SELECT personas.Nombre,personas.Email,personas.Telefono,departamen.Nombre,puesto.Nombre 
		FROM `departamen` 
		JOIN puesto ON departamen.ID_Dep=puesto.Departamento_Asignado 
		JOIN personas ON puesto.ID_Puesto=personas.Codigo_Puesto");
	$stmt->execute();
	$datos = $stmt->fetchAll();
}

function VerInfoDepatamento01(){
	$pdo = getConnection();
	$stmt = $pdo->query('SELECT personas.Nombre,personas.Email,personas.Telefono,departamen.Nombre as "nDepartamen",puesto.Nombre as "nPuesto" FROM `departamen` JOIN puesto ON departamen.ID_Dep=puesto.Departamento_Asignado JOIN personas ON puesto.ID_Puesto=personas.Codigo_Puesto WHERE departamen.ID_Dep=1');
	$stmt->execute();
	$datos = $stmt->fetchall(PDO::FETCH_CLASS);
	$json = json_encode($datos);
	echo $json;
}

function VerInfoDepatamento02(){
	$pdo = getConnection();
	$stmt = $pdo->query('SELECT personas.Nombre,personas.Email,personas.Telefono,departamen.Nombre as "nDepartamen",puesto.Nombre as "nPuesto" FROM `departamen` JOIN puesto ON departamen.ID_Dep=puesto.Departamento_Asignado JOIN personas ON puesto.ID_Puesto=personas.Codigo_Puesto WHERE departamen.ID_Dep=2');
	$stmt->execute();
	$datos = $stmt->fetchall(PDO::FETCH_CLASS);
	$json = json_encode($datos);
	echo $json;
}
?>
