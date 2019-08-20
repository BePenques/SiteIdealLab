<?php

session_start();

require_once("conexao_banco.php");

$consulta_sql = "SELECT * FROM tb_users";

$result = mysqli_query($conn, $consulta_sql);

mysqli_close($conn);

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>
<body>
	<a href="form_cadastrar.php">Cadastrar usuario</a>
	<!--verifica a mensagem utilizando sessão -->
	<?php
		if(isset($_SESSION['mensagem'])){
			echo "<p>".$_SESSION['mensagem']."</p>";
		}
	?>
	<table width="500" border="1">
		<tr>
			<th>ID</th>
			<th>E-mail</th>
			<th>Senha</th>
			<th>Tipo</th>
			<th>Ação</th>
		<tr>
			<?php while($registro = mysqli_fetch_array($result)){?>
		<tr>
			<td><?php echo $registro['id_user']?></td>
			<td><?php echo $registro['email']?></td>
			<td><?php echo $registro['senha']?></td>
			<td><?php echo $registro['tipo']?></td>
			<td><a href="form_atualizar.php?id_user=<?php echo $registro['id_user'];?>">Editar</a>|<a href="script_deletar.php?id_user=<?php echo $registro['id_user'];?>">Excluir</a></td>
		<tr>
			<?php }?>
	</table>
</body>
</html>