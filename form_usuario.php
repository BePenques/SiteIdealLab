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
						<li><a href="#servicos">Sair</a></li>
					</ul>
				</nav>
					
					<?php
						
						$usua_id = filter_input(INPUT_GET,'usua_id',FILTER_SANITIZE_NUMBER_INT);
					
						if(isset($usua_id))//Se for update
						{

							$consulta_sql = "SELECT * FROM tb_usua WHERE usua_id = '". $usua_id ."'";
							
							require_once("DBConnection.php");

							$result = mysqli_query($conn, $consulta_sql);

							$registro = mysqli_fetch_array($result);

							mysqli_close($conn);
						}
					?>
					
				  <form method="post" action="usua_crud.php" id="sem_margim_top">
					<fieldset>
						<?php if(isset($usua_id)) { ?><!--é atualizar -->
							<legend>Atualizar Usuário </legend>
							<input type="hidden" name="usua_id" value="<?php $registro['usua_id'];?> ">
						<?php }else{ ?>
							<legend>Cadastrar Usuário </legend>
						<?php }; ?>
						
	
						<label>E-mail: </label>
						<input type="text" name="usua_nome" value="<?php echo isset($usua_id)? $registro['usua_nome'] : "";?> ">
						<label>Senha: </label>
						<input type="password" name="usua_senha" value="<?php echo isset($usua_id) ? $registro['usua_senha'] : "";?>">
						
						<label class="margin_top">Tipo: </label>
						
							<select name="usua_tipo" class="cb_assunto margin_top">
								<option value="CMU" selected="selected"
										<?php
										if(isset($usua_id)){
											if('CMU' == $registro['usua_tipo']){
											  echo "selected=\"selected\"";
											}
										}
										?>
									>CMU</option>
								<option value="SUP" 
										<?php
										if(isset($usua_id)){
											if('SUP' == $registro['usua_tipo']){
											  echo "selected=\"selected\"";
											}
										}
										?>	
										
									>SUP</option>
							</select>
						<div id="btns">
							<input type="button" value="Voltar" onclick="msg()">
							<input type="button" value="Limpar" onclick="msg()">
							<input type="submit" value="Salvar" name="Salvar"> 
						</div>
					</fieldset>
				  </form>	
				</section>
			</main>
			<footer>
			</footer>
		</div>
	</body>
</html>

