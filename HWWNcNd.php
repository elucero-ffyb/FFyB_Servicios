<?php
header("Content-Type: text/html;charset=utf-8");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['user_role'];

include('v_session.php');
include('head.php');
include('conexion.php');

// Procesar los resultados
  echo "<h3>Listado NC/ND></h3>";
  echo "<table class='table table-striped' border='1' cellpadding='5' cellspacing='0' width='50%' style='text-align: left;'>";
  echo "<thead class='thead-dark'>
        <tr>
            <th>Legajo</th>
            <th>Nombre</th>
            <th>CUIT</th>
            <th>Usuario</th>
        </tr>
        </thead>";
  
echo "</table>";

$perfilid=$_SESSION['user_role'];
?>