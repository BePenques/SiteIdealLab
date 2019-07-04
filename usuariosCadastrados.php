<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT * FROM tb_usua";

$result = mysqli_query($conn, $consulta_sql);

mysqli_close($conn);

?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">
		<title>Home</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
			  <header id="headeradm">
				<h4>Área Administrativa</h4>
			  </header>
			</div>
		  	<main> 
				<section id="index_adm">
					<nav>
						<ul>
							<li><a href="#home">Gerenciar usuarios</a></li>
							<li><a href="#sobrenos">Notícias Cadastradas</a></li>
							<li><a href="#noticias">Mudar Login</a></li>
							<li><a href="#servicos">Sair</a></li>
						</ul>
			  		</nav>
			 		<div id="users_cadastrados">
						<a  id="link_cadastrar" href="form_usuario.php" >Cadastrar Usuário</a>
						<?php
						//Verificar a mensagem utilizando sessão 
							if(isset($_SESSION['mensagem'])){
								echo "<p>".$_SESSION['mensagem']."</p>";
								//unset($_SESSION['mensagem']);
							}
						?>

						<table id="largura_800">
							<tr><th>ID</th>
								<th>Nome</th> 
								<th>Senha</th>
								<th>Tipo</th>
								<th class="borda_direita">Ação</th>
							</tr>
							<?php while($registro = mysqli_fetch_array($result)){?>
							<tr>
								<td><?php echo $registro['usua_id']?></td>
								<td><?php echo $registro['usua_nome']?></td> 
								<td><?php echo $registro['usua_senha']?></td>
								<td><?php echo $registro['usua_tipo']?></td>
								<td class="borda_direita">
									<a href="form_usuario.php?usua_id=<?php echo $registro['usua_id'];?>"><img class="icon_edit" src="/SiteProteses/imagens/icone_editar.png"></a>
									
									<a href="scriptDeletar.php?usua_id=<?php echo $registro['usua_id'];?>"><img alt="Excluir" class="icon_delete" src="/SiteProteses/imagens/delete-button (1).png"></a>
								</td>
							</tr>
							<?php }?>
						</table>
					</div>
				</section>
			</main>
			<footer>
			</footer>
		</div>
	</body>
</html>

