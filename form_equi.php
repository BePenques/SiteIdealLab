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

						$equi_id = filter_input(INPUT_GET,'equi_id',FILTER_SANITIZE_NUMBER_INT);

						if(isset($equi_id))//Se for update
						{

						$consulta_sql = "SELECT * FROM tb_equi WHERE equi_id = '". $equi_id ."'";

						require_once("DBConnection.php");

						$result = mysqli_query($conn, $consulta_sql);

						$registro = mysqli_fetch_array($result);

						mysqli_close($conn);
						}
					?>
					
					  <form method="post" action="equi_crud.php" id="sem_margim_top" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($equi_id)) { ?>
								<legend>Atualizar Equipamento </legend>
								<input type="hidden" name="equi_id" value="<?php echo isset($equi_id)? $registro['equi_id'] : "";?> ">
							<?php }else{ ?>
								<legend>Cadastrar Equipamento </legend>
							<?php }; ?>
						    <label>Nome: </label>
							<input type="text" name="equi_nome" value="<?php echo isset($equi_id)? $registro['equi_nome'] : "";?> ">
							<label>Fabricante: </label>
							<input type="text" name="equi_fabr" value="<?php echo isset($equi_id)? $registro['equi_fabr'] : "";?> ">
							<label>Fornecedor: </label>
							<input type="text" name="equi_forn" value="<?php echo isset($equi_id)? $registro['equi_forn'] : "";?> ">
							<label>Modelo: </label>
							<input type="text" name="equi_mod" value="<?php echo isset($equi_id)? $registro['equi_mod'] : "";?> ">
						    <label>Marca: </label>
							<input type="text" name="equi_marc" value="<?php echo isset($equi_id)? $registro['equi_marc'] : "";?> ">
							<label>Imagem: </label>
						    <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
						    <input name="imagem" type="file" accept="image/png, image/jpeg"/>  
							<label>Descrição: </label>
							<input type="text" name="equi_desc" value="<?php echo isset($equi_id)? $registro['equi_desc'] : "";?> "> 
							<label>Valor: </label>
							<input type="text" name="equi_val" value="<?php echo isset($equi_id)? $registro['equi_val'] : "";?> ">  
							<label>Características: </label>
							<textarea class="float_right" rows="9" cols="27" name="equi_cara"><?php echo isset($equi_id)? $registro['equi_cara'] : "";?></textarea>
							  
							<div id="tipo_equi">
							<label>Nível: </label>
							<input type="checkbox" name="equi_tipo_basi" value="BAS"
								   <?php
								   	if(isset($equi_id)){
											if('S' == $registro['equi_tipo_basi']){ ?>
											 checked
										<?php	}
										}
								   ?>
								   ><label>Básico</label>
							<input type="checkbox" name="equi_tipo_inter" value="INT"
								     <?php
								   	if(isset($equi_id)){
											if('S' == $registro['equi_tipo_inter']){ ?>
											 checked
										<?php	}
										}
								   ?>
								   ><label>Intermediário</label>
							<input type="checkbox" name="equi_tipo_avan" value="AVA"
								    <?php
								   	if(isset($equi_id)){
											if('S' == $registro['equi_tipo_avan']){ ?>
											 checked
										<?php	}
										}
								   ?>		
								   ><label>Avançado</label>
							 </div>
							<div id="alinhar">
							<input type="button" value="Voltar" onclick="msg()">
							<input type="button" value="Limpar" onclick="msg()">
							<input type="submit" value="Salvar" name="Salvar"> 
							</div>
						 </fieldset>
					 </form>
			</main>
			<footer>
			</footer>
		</div>
	</body>
</html>
