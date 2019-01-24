<?php 
header("access-control-allow-origin: *");

if (isset($_POST["nombre"])&&isset($_POST["email"])&&isset($_POST["telefono"])) {
	$name = $_POST["nombre"];
	$email = $_POST["email"];
	$tlf = $_POST["telefono"];
	InsertarDatos();
}


function InsertarDatos(){
	echo "string";
}

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
	//CrearSelectDepartamento();
	CrearSelectPuesto();
	CrearInputNombre();
}
function CrearSelectPuesto(){
	$pdo = getConnection();
	$stmt = $pdo->query("SELECT * FROM puesto");
	$stmt->execute();
	$datos = $stmt->fetchAll();
	$num = $stmt->rowCount();
	$impSelect = "<br><select><option value='' disabled selected>Seleciona un puesto</option>";
	for ($i=0; $i < $num; $i++) { 
		$impSelect .= "<option value='".$i."'>".$datos[$i][1]."</option>";
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
	$impSelect = "<select><option value='' disabled selected>Seleciona un departamento</option>";
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
	$pdo = getConnection();
	$stmt = $pdo->query("SELECT personas.Nombre,personas.Email,personas.Telefono,departamen.Nombre,puesto.Nombre 
		FROM `departamen` 
		JOIN puesto ON departamen.ID_Dep=puesto.Departamento_Asignado 
		JOIN personas ON puesto.ID_Puesto=personas.Codigo_Puesto");
	$stmt->execute();
	$datos = $stmt->fetchAll();
	var_dump($datos);

	$impTabla='<table style="width:50%"> <tr>';
	
}
//SELECT * FROM `departamen`,puesto,personas WHERE ID_Dep=Departamento_Asignado AND ID_Puesto=Codigo_Puesto

?>
