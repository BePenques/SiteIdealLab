<!--

1 - arrumar imagem em equipamento - ok
2 - arrumar funcionamento include - ok
3 - fazer CRUD fabr e forn - ok
4 - mostrar noticias no index - ok
5 - colocar botão sair menu 

-->
<!DOCTYPE html>
<meta charset="utf-8"/>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<title>Home</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
				<header id="headeradm">
					<h4>Área Administrativa</h4>
					<input id="btn_logout" type="button" value="Sair" onclick="msg()">
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
				<main> 
					<section id="index_adm">
					<nav>
						<ul>
							<li><a href="?pagina=usuariosCadastrados.php">Gerenciar Usuários</a></li>
							<li><a href="?pagina=noticiasCadastradas.php">Gerenciar Notícias</a></li>
							<li><a href="?pagina=equipamentosCadastrados.php">Gerenciar Equipamentos</a></li> 
							<li><a href="?pagina=fornecedoresCadastrados.php">Gerenciar Fornecedores</a></li>
							<li><a href="?pagina=fabricantesCadastrados.php">Gerenciar Fabricantes</a></li>
						</ul>
					</nav>
					</section>
					
						
						<?php include($_GET['pagina']);?>
				
				</main>
				</div>	
			<footer>
			</footer>
		</div>
	</body>
</html>

