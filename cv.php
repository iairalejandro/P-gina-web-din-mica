<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos enviados por el formulario
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

    // Guardar los datos en la sesión para mostrarlos en el CV
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

    // Inserción de los datos en la base de datos
    $sql = "INSERT INTO curriculums (nombre, fecha_nacimiento, ocupacion, contacto, nacionalidad, nivel_ingles, lenguajes_programacion, aptitudes, habilidades, perfil) 
            VALUES ('$nombre', '$fecha_nacimiento', '$ocupacionFormateado', '$contacto', '$nacionalidad', '$nivel_ingles', '$lenguajes_programacion', '$aptitudes', '$habilidades', '$perfil')";

    // Ejecutar la consulta y verificar si es exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente en la base de datos.";
    } else {
        echo "Error al insertar los datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    header("Location: index.php");
    exit;
}

// Obtener los datos de la sesión para mostrar en la página
$nombre = $_SESSION['nombre'];
$ocupacionFormateado = $_SESSION['ocupacion'];
$contacto = $_SESSION['contacto'];
$nacionalidad = $_SESSION['nacionalidad'];
$nivel_ingles = $_SESSION['nivel_ingles'];
$lenguajes_programacion = $_SESSION['lenguajes_programacion'];
$aptitudes = $_SESSION['aptitudes'];
$habilidades = $_SESSION['habilidades'];
$perfil = $_SESSION['perfil'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae - <?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <!-- Cabecera -->
    <div class="header">
        <div class="photo-header">
            <img src="profile.jpg" alt="Foto de perfil">
        </div>
        <div class="header-info">
            <h1><?php echo htmlspecialchars($nombre); ?></h1>
            <h2><?php echo htmlspecialchars($ocupacionFormateado); ?></h2>
        </div>
    </div>

    <div class="content">
        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="contact-info">
                <h2>Contacto</h2>
                <p>📞 <?php echo htmlspecialchars($contacto); ?></p>
                <p>📍 <?php echo htmlspecialchars($nacionalidad); ?></p>
                <p>linkedln.com/jose-martinez</p>
            </div>

            <div class="languages">
                <h2>Idiomas</h2>
                <p>Español: Nativo</p>
                <p>Inglés: <?php echo htmlspecialchars($nivel_ingles); ?></p>
                <p>Francés: Intermedio (B2)</p>
            </div>

            <div class="aptitudes">
                <h2>Aptitudes</h2>
                <ul>
                    <li>Inteligencia emocional</li>
                    <li>Espíritu crítico</li>
                    <li>Trabajo en equipo</li>
                    <li>Capacidad analítica</li>
                    <li><?php echo htmlspecialchars($aptitudes); ?></li>
                </ul>
            </div>

            <div class="skills">
                <h2>Habilidades</h2>
                <ul>
                    <?php
                    if (!empty($habilidades)) {
                        $habilidades_array = explode(", ", $habilidades);
                        foreach ($habilidades_array as $habilidad) {
                            echo "<li>" . htmlspecialchars($habilidad) . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="other-interests">
                <h2>Otros intereses</h2>
                <ul>
                    <li>Paseos ecológicos grupales</li>
                    <li>Lectura grupal en inglés</li>
                </ul>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="profile">
                <h2>Perfil</h2>
                <p><?php echo htmlspecialchars($perfil); ?></p>
            </div>

            <div class="experience">
                <h2>Experiencia Laboral</h2>
                
                <div class="job">
                    <h3>Trabajador Social</h3>
                    <p>México DF, 2022 – Actualmente</p>
                    <ul>
                        <li>Coordinador y mediador entre los equipos de ayuda psicológica a jóvenes y niños en exclusión social.</li>
                        <li>Velar por la salud mental del equipo y de miembros involucrados en proyectos.</li>
                        <li>Mapeo de necesidades estratégicas y lógicas para las diferentes áreas.</li>
                        <li>Monitor de ejercicios físicos para adolescentes.</li>
                        <li>Programar diferentes actividades extracurriculares con los involucrados.</li>
                    </ul>
                </div>

                <div class="job">
                    <h3>Trabajador Social</h3>
                    <p>México DF, 2020 – 2022</p>
                    <ul>
                        <li>Funciones para seguimientos de casos para jóvenes con problemas de adicciones.</li>
                        <li>Capacitaciones e integración vinculadas a medidas preventivas.</li>
                        <li>Recopilación de evidencias para auditorías y programas sociales.</li>
                    </ul>
                </div>

                <div class="job">
                    <h3>Trabajador Social (Prácticas)</h3>
                    <p>Zaragoza, España, 2019 – 2020</p>
                    <ul>
                        <li>Profesor de lengua española e inglesa para jóvenes migrantes.</li>
                        <li>Monitor de actividades ecológicas con adolescentes.</li>
                        <li>Coordinador de áreas deportivas.</li>
                    </ul>
                </div>
            </div>

            <div class="education">
                <h2>Formación</h2>
                <p><strong>Grado de Trabajo Social</strong></p>
                <p>ESMA, Madrid (2012 – 2015)</p>
                <p><strong>Licenciatura Profesional</strong></p>
                <p>Universidad de la Frontera, México DF (2011 – 2012)</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
