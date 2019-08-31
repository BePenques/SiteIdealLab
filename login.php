
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
					<a href="index.php"><input id="btn_logout" type="button" value="Voltar"></a>
					
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
			<main>
				<section id="index_adm">
				<section id="login">
					<form method="post" action="script_login.php" class="formLogin">
						<fieldset>
							<legend>Login <img id="icone_cadeado" alt="icone cadeado" src="/SiteIdealLab/imagens/95482.png"></legend>
							<label>E-mail:</label><input class="txt_borda" type="text" name="usua_nome"/>
							<label>Senha:</label><input class="txt_borda" type="password" name="usua_senha"/>
							<input id="btn_direita" type="submit" value="Entrar" name="Salvar"> 
							<a id="esqueceu_senha" href="">Esqueceu a senha?</a>
						</fieldset>
					</form>
				</section>
				</section>	
			</main>
			</div>	
		<?php require_once("footer.php"); ?>
		</div>
	</body>
</html>

