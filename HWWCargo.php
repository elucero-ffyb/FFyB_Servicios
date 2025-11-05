<?php
header("Content-Type: text/html;charset=utf-8");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['user_role'];

include('v_session.php');
include('head.php');
include('conexion.php');
$query="SELECT [CargoId]
      ,[CargoDescripcion]
      ,[CargoTipo]
      ,[CargoDedicacion]
  FROM [FfybServiciosTest_20250711].[dbo].[CARGO]
  order by 2ASC";
  
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Procesar los resultados
  echo "<h3>Listado de Cargos</h3>";
  echo "<table class='table table-striped' border='1' cellpadding='5' cellspacing='0' width='50%' style='text-align: left;'>";
  echo "<thead class='thead-dark'>
        <tr>
            <th>Cargo ID</th>
            <th>Cargo</th>
            <th>Tipo</th>
            <th>Dedicacion</th>
        </tr>
        </thead>";

foreach ($result as $row) {
    ?>    
    <tr>
        <td align="left"><?php echo $row['CargoId'];?></td>
        <td align="left"><?php echo $row['CargoDescripcion'];?></td>
        <td align="left"><?php echo $row['CargoTipo'];?></td>
        <td text-align="center"><?php echo $row['CargoDedicacion'];?></td>
    </tr>
    <?php    
  }        

echo "</table>";

$perfilid=$_SESSION['user_role'];
?>