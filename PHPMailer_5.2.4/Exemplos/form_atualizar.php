<?php

require_once("conexao_banco.php");

//filtrar dados transmitidos por GET
$id_user = filter_input(INPUT_GET,'id_user',FILTER_SANITIZE_NUMBER_INT);

$consulta_sql = "SELECT * FROM tb_users WHERE id_user = '". $id_user ."'";

$result = mysqli_query($conn, $consulta_sql);

$registro = mysqli_fetch_array($result);

mysqli_close($conn);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar usuário</title>
</head>
<body>
	<a href="listar_users.php">Listar_usuários</a>
	<h3>Editar Usuário</h3>
	<form method="post" action="script_atualizar.php">
		<input type="hidden" name="id_user" value="<?php echo $registro['id_user'];?>">
		 <label>E-mail: </label>
         <input type="email" name="email" value="<?php echo $registro['email'];?>"><br><br>
		 <label>Senha: </label>
         <input type="password" name="senha" value="<?php echo $registro['senha'];?>"><br><br>
		 <label>Tipo:</label>
		 <select name="tipo">
			 <option value="SUP"
				 <?php
				  if('SUP' == $registro['tipo']){
					  echo "selected=\"selected\"";
				  }
				 ?>
				 >SUP</option>
			 <option value="ADM"
					 <?php
					 if('ADM' == $registro['tipo']){
						 echo "selected=\"selected\"";
					 }
					 ?>
					 
					 >ADM</option>
	    </select><br><br>
		<input type="submit" name="salvar" value="Salvar">
        <input type="reset" name="desfazer" value="Desfazer">
	</form>
</body>
</html>