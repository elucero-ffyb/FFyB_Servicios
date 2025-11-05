<?php
header("Content-Type: text/html;charset=utf-8");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['user_role'];

include('v_session.php');
include('head.php');
include('conexion.php');
$query="SELECT [CatedraId]
      ,[CatedraDescripcion]
      ,c.[DepartamentoID]
      ,d.[DepartamentoDsc]
  FROM [CATEDRA] c
       INNER JOIN [DEPARTAMENTO] d ON c.[DepartamentoID] = d.[DepartamentoID]
  order by 2 ASC";
  
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Procesar los resultados
  echo "<h3>Listado de Cátedras</h3>";
  echo "<table class='table table-striped' border='1' cellpadding='5' cellspacing='0' width='50%' style='text-align: left;'>";
  echo "<thead class='thead-dark'>
        <tr>
            <th>CatedraId</th>
            <th>Descripcion</th>
            <th>Departamento</th>
            
        </tr>
        </thead>";

foreach ($result as $row) {
    ?>    
    <tr>
        <td align="left"><?php echo $row['CatedraId'];?></td>
        <td align="left"><?php echo $row['CatedraDescripcion'];?></td>
        <td align="left"><?php echo $row['DepartamentoDsc'];?></td>
    </tr>
    <?php    
  }        

echo "</table>";

$perfilid=$_SESSION['user_role'];
?>