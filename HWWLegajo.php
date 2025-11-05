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
  echo "<h3>Listado de Legajos</h3>";
  echo "<table class='table table-striped' border='1' cellpadding='5' cellspacing='0' width='50%' style='text-align: left;'>";
  echo "<thead class='thead-dark'>
        <tr>
            <th>Legajo</th>
            <th>Nombre</th>
            <th>CUIT</th>
            <th>Usuario</th>
        </tr>
        </thead>";
  foreach ($result as $row) {
    ?>    
    <tr>
        <td align="left"><?php echo $row['PrestadorLegajo'];?></td>
        <td align="left"><?php echo $row['LegajoNombre'];?></td>
        <td align="left"><?php echo $row['PrestadorCUIT'];?></td>
        <td text-align="center"><?php echo $row['LegajoUsuario'];?></td>
    </tr>
    <?php    
  }
echo "</table>";

//echo $_SESSION['user_role']."<br>";
$perfilid=$_SESSION['user_role'];
//echo $perfilid."---</br>";
?>
