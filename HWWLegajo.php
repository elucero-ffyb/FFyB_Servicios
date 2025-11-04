<?php
header("Content-Type: text/html;charset=utf-8");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['user_role'];

include('v_session.php');
include('head.php');
include('conexion.php');

$query="SELECT [PrestadorLegajo]
      ,[PrestadorCUIT]
      ,[LegajoUsuario]
      ,[LegajoPassword]
      ,[LegajoNombre]
      ,[PerfilId]
      ,[LegajoPuntoEmisionId]
      ,[LegajoSerie]
      ,[LegajoHabFacturar]
  FROM [FfybServiciosTest_20250711].[dbo].[LEGAJO]
  ORDER BY LegajoNombre ASC";

  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Procesar los resultados
  foreach ($result as $row) {
        echo "<table>";
        echo "<th><td>Legajo</td><td>Nombre</td><td>CUIT</td><td>Usuario</td></th>";
        echo "<tr><td>" . $row['PrestadorLegajo'] . "</td>
        <td>" . $row['LegajoNombre'] . "</td>
        <td>" . $row['PrestadorCUIT'] . "</td>
        <td>" . $row['LegajoUsuario'] . "</td></tr>";
        echo "</table>";
  }


//echo $_SESSION['user_role']."<br>";
$perfilid=$_SESSION['user_role'];
//echo $perfilid."---</br>";
?>
