<?php

$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$ocupacion = $_POST['ocupacion'];
$ocupacionFormateado = ucwords(strtolower($ocupacion));
$contacto = $_POST['contacto'];
$nacionalidad = $_POST['nacionalidad'];
$nivel_ingles = $_POST['nivel_ingles'];
$lenguajes_programacion = isset($_POST['lenguajes_programacion']) ? implode(", ", $_POST['lenguajes_programacion']) : '';
$aptitudes = $_POST['aptitudes'];
$habilidades = isset($_POST['habilidades']) ? implode(", ", $_POST['habilidades']) : '';
$perfil = $_POST['perfil'];

$_SESSION['nombre'] = $nombre;
$_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
$_SESSION['ocupacion'] = $ocupacionFormateado;
$_SESSION['contacto'] = $contacto;
$_SESSION['nacionalidad'] = $nacionalidad;
$_SESSION['nivel_ingles'] = $nivel_ingles;
$_SESSION['lenguajes_programacion'] = $lenguajes_programacion;
$_SESSION['aptitudes'] = $aptitudes;
$_SESSION['habilidades'] = $habilidades;
$_SESSION['perfil'] = $perfil;

header("Location: cv.php");
exit;
?>
