<?php include '../lock.php'; ?>
<?php if (!isset($_GET['clienteId'])){
	header('location:gerenciar.php');
} ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<title>Ativide Avalitiva</title>
</head>
<body class="container-fluid">
	<?php
		include '../menu.php';
		include '../conn.php';

		$clienteId = $_GET['clienteId'];
		
      $sql = "SELECT * FROM cliente where ID = $clienteId";
		$resultado = mysqli_query($conn,$sql);
		$linhas = mysqli_affected_rows($conn);
		if ($linhas > 0){
			echo '<h2 class="text text-info">Cliente Selecionado</h3>';
			echo '<table class="table table-striped">';
			echo '<tr>
						<th>ID #</th>
						<th>NOME</th>
						<th>E-MAIL</th>
						<th>CPF</th>					 
              </tr>';	
			for ($i = 0; $i < $linhas; $i++){
				echo "<tr>";
				$linha_atual = mysqli_fetch_assoc($resultado);
				foreach ($linha_atual as $valor){
					echo "<td>" . $valor . "</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
      } else {
        echo '<h3 class="alert alert-warning">
              Nenhum cadastro feito. Use form abaixo para cadastrar </h3>';
        include 'exibir.php';
      }	
		
		$sql = "SELECT ID, NOME, MARCA, VALOR FROM produto";
		$result = mysqli_query($conn,$sql);
		$linhas = mysqli_affected_rows($conn);
		if ($linhas > 0){
			echo '<h2 class="text text-info">Selecionar Produto</h2>';
			echo '<table class="table table-striped">';
			echo '<tr>
            <th>ID #</th>
            <th>NOME</th>
            <th>MARCA</th>
            <th>VALOR</th>								
            </tr>';				
				
			for ($i = 0; $i < $linhas; $i++){
				$linha_atual = mysqli_fetch_assoc($result);
				echo "<tr>";
				foreach ($linha_atual as $indice => $valor){				
					if($indice == "ID"){
						$id = $valor;
					}
					echo "<td>" . $valor . "</td>";
				}				
				echo '<td><a href="cadastrar_quantidade.php?clienteId='.$clienteId.'&prodId='.$id.'">Selecionar</a></td>';				
				echo "</tr>";
			}
			echo "</table>";
      } else {
			echo '<h3 class="alert alert-warning">
              Nenhum cadastro feito. </h3>';
		}			
   ?>			
</body>
</html>  