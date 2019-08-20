<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
	<?php
		require_once("conexao_banco.php");
		$result_consulta_sql =  mysqli_query($conn, "SELECT * FROM tb_users");
		
		

	//mysqli_close($conn);
	
	?>
	<a href="/SiteProteses/Exemplos/teste_cadastrar.php">Cadastrar Usuário</a>
	<table width="200" border="1">
	<tr>
		<th>ID</th>
	    <th>E-mail</th>
	    <th>Senha</th>
	    <th>Tipo</th>
		<th>Ação</th>
	</tr>
	<?php while($registro = mysqli_fetch_array($result_consulta_sql)){ ?> 
	<tr>
		<td><?php echo $registro['id_user'];?></td>
		<td><?php echo $registro['email'];?></td>
		<td><?php echo $registro['senha'];?></td>
		<td><?php echo $registro['tipo'];?></td>
		<td><a href="adm.php">Editar</a>|<a href="adm.php">Deletar</a></td>
	</tr>
	<?php } ?> 
</table>
</body>
</html>