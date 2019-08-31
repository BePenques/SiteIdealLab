
 <?php include("sc_login_comum.php"); ?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<title>Administração</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
				<header id="headeradm">
					<h4>Área Administrativa</h4>
					
				<!--	<input id="btn_logout" type="button" value="Sair" onclick="msg()"> -->
					
					<a  class="sem_borda_direita" href="script_login.php?logout=true">
					<input id="btn_logout" type="button" value="Sair">
					</a>
	
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
				<main> 
					<section id="index_adm">
					<nav id="nav_adm">
						<ul>
							<li><a href="?pagina=usuariosCadastrados.php">Gerenciar Usuários</a></li>
							<li><a href="?pagina=noticiasCadastradas.php">Gerenciar Notícias</a></li>
							<li><a href="?pagina=equipamentosCadastrados.php">Gerenciar Equipamentos</a></li> 
							<li><a href="?pagina=fornecedoresCadastrados.php">Gerenciar Fornecedores</a></li>
							<li><a href="?pagina=fabricantesCadastrados.php">Gerenciar Fabricantes</a></li>
							<li><a href="?pagina=exigenciasCadastradas.php">Gerenciar Exigências</a></li>
							<li><a href="?pagina=normasCadastradas.php">Gerenciar Normas</a></li>
							<li><a href="?pagina=laboratoriosCadastrados.php">Gerenciar Laboratórios</a></li>
						</ul>
					</nav>
					</section>
					
						
						<?php include($_GET['pagina']);?>
				
				</main>
				</div>	
		<?php require_once("footer.php"); ?>
		</div>
	</body>
</html>

