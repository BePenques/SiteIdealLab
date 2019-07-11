<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT * FROM tb_noti";

$result = mysqli_query($conn, $consulta_sql);


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
			<div style="min-height: calc(100vh - 70px);">	
				<main> 
					<section id="index_adm">
						<nav>
							<ul>
								<li><a href="#home">Gerenciar usuarios</a></li>
								<li><a href="#sobrenos">Notícias Cadastradas</a></li>
								<li><a href="#noticias">Mudar Login</a></li>
							</ul>
						</nav>
						<div id="users_cadastrados">
							<a  id="link_cadastrar" href="form_noticia.php" >Cadastrar Notícia</a>
							<?php
							//Verificar a mensagem utilizando sessão 
								if(isset($_SESSION['mensagem'])){
									echo "<p>".$_SESSION['mensagem']."</p>";
									//unset($_SESSION['mensagem']);
								}
							?>
							<table id="tb7_colunas">
								<tr>
									<th>ID</th>
									<th>Título</th> 
									<th>Data</th>
									<th>Texto</th>
									<th>Imagem</th>
									<th>Usuário</th>
									<th class="borda_direita">Ação</th>
								</tr>
								<?php while($registro = mysqli_fetch_array($result)){?>
								<tr>
									<td><?php echo $registro['noti_id']?></td>
									<td><?php echo $registro['noti_tit']?></td> 
									<td><?php echo $registro['noti_data']?></td>
									<td><?php echo $registro['noti_txt']?></td>
									<td><?php echo '<a href="ver_imagem.php?id='.$registro['noti_id'].'">Imagem '.$registro['noti_id'].'</a>'; ?></td>
									
									
									
	
									
									<?php
									$consulta_sql = "SELECT  usua_nome FROM tb_usua INNER JOIN tb_noti USING(usua_id) WHERE usua_id = '". $registro['usua_id'] ."'";
									$result_nome = mysqli_query($conn, $consulta_sql);												 
										while($registro_nome = mysqli_fetch_array($result_nome)){
									?>
									<td><?php echo $registro_nome['usua_nome'] ?></td>
									
									<?php }  ?> 
									<td class="borda_direita">
										<a href="form_noticia.php?noti_id=<?php echo $registro['noti_id'];?>"><img class="icon_edit" src="/SiteProteses/imagens/icone_editar.png"></a>

										<a href="noti_crud.php?noti_id=<?php echo $registro['noti_id'];?>"><img alt="Excluir" class="icon_delete" src="/SiteProteses/imagens/delete-button (1).png"></a>
									</td>
								</tr>
								<?php } ?> 
							</table>
						</div>
					</section>
				</main>
			</div>	
			<footer>
			</footer>
		</div>
	</body>
</html>

