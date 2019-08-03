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
					
						$fabr_id = filter_input(INPUT_GET,'fabr_id',FILTER_SANITIZE_NUMBER_INT);
						
						$forn_id = filter_input(INPUT_GET,'forn_id',FILTER_SANITIZE_NUMBER_INT);

						if(isset($equi_id))//Se for update
						{

						$consulta_sql = "SELECT 
											equi_id,
											fabr_id,
											forn_id,
											equi_nome,
											equi_fabr,
											equi_forn,
											equi_mod,
											equi_marc,
											equi_img,
											equi_desc,
											equi_val,
											equi_cara,
											equi_tipo_basi,
											equi_tipo_inter,
											equi_tipo_avan
											
						FROM tb_equi WHERE equi_id = '". $equi_id ."'";

						require_once("DBConnection.php");

						$result = mysqli_query($conn, $consulta_sql);

						$registro = mysqli_fetch_array($result);
								
					//	mysqli_close($conn);
							
						//SELECT PARA COLETAR OS FABRICANTES CADASTRADOS	
							
		
						}
					?>
					
					  <form method="post" action="equi_crud.php" id="sem_margim_top" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($equi_id)) { ?>
								<legend>Atualizar Equipamento </legend>
								<input type="hidden" name="equi_id" value="<?php echo isset($equi_id)? $registro['equi_id'] : "";?>">
							   
							<?php }else{ ?>
								<legend>Cadastrar Equipamento </legend>
							<?php }; ?>
						    <label>Nome: </label>
							<input type="text" name="equi_nome" value="<?php echo isset($equi_id)? $registro['equi_nome'] : "";?>">
							  
							<label class="label_maior">Fabricante: </label>
							<select name="fabr_id" class="cb_fabr">
								<?php 
									require_once("DBConnection.php");
									$consulta_sqlSelect = "SELECT fabr_id,
																	  CONCAT(fabr_id,' - ',fabr_nome) as dados_fabr 
																 FROM tb_fabr";	

									$resultSelect = mysqli_query($conn, $consulta_sqlSelect);	

									while($registroSelect = mysqli_fetch_array($resultSelect)){
										?>
										<option value="<?php echo $registroSelect['fabr_id']?>"
										<?php
											if(isset($equi_id)){
												if($registroSelect['fabr_id'] == $fabr_id){
													echo "selected=\"selected\"";
												}
											}
										?>
										><?php echo $registroSelect['dados_fabr']?></option>

									<?php } ?> 
                            </select></br> 
						  	<label class="label_maior">Fornecedor: </label>
							<select name="forn_id" class="cb_forn">
								<?php 
								require_once("DBConnection.php");
								$consulta_sqlSelect = "SELECT forn_id,
																  CONCAT(forn_id,' - ',forn_nome) as dados_forn 
															 FROM tb_forn";	
							
								$resultSelect = mysqli_query($conn, $consulta_sqlSelect);	
									
								while($registroSelect = mysqli_fetch_array($resultSelect)){?>
								
									<option value="<?php echo $registroSelect['forn_id']?>"
										<?php
											if(isset($equi_id)){
												if($registroSelect['forn_id'] == $forn_id){
												  echo "selected=\"selected\"";
												}
											}
										?>
									><?php echo $registroSelect['dados_forn']?></option>
								<?php } ?> 
							</select>
							<label>Modelo: </label>
							<input type="text" name="equi_mod" value="<?php echo isset($equi_id)? $registro['equi_mod'] : "";?>">
						    <label>Marca: </label>
							<input type="text" name="equi_marc" value="<?php echo isset($equi_id)? $registro['equi_marc'] : "";?>">
							<label>Atualizar
							<input type="checkbox" name="equi_img" value="<?php echo isset($equi_id)? $registro['equi_img'] : "";?>"></label> 
							  
							<label></br>Imagem: </label>
							<input type="file" name="file" id="file">  
							<label>Descrição: </label>
							<input type="text" name="equi_desc" value="<?php echo isset($equi_id)? $registro['equi_desc'] : "";?>"> 
							<label>Valor: </label>
							<input type="text" name="equi_val" value="<?php echo isset($equi_id)? $registro['equi_val'] : "";?>">  
							<label>Características: </label>
							<textarea class="float_right" rows="9" cols="27" name="equi_cara"><?php echo isset($equi_id)? $registro['equi_cara'] : "";?></textarea>
							  
							<div id="tipo_equi">
							<label>Nivel: </label>
							<input type="checkbox" name="equi_tipo_basi" value="1"
								    <?php
								   	if(isset($equi_id)){
											if($registro['equi_tipo_basi'] == "1"){
											 echo "checked";
									}
										}
								    ?>
								   ><label>Básico</label>
							<input type="checkbox" name="equi_tipo_inter" value="1"
								    <?php
								   	if(isset($equi_id)){
											if( $registro['equi_tipo_inter'] == "1"){ 
											 echo "checked";
											}
									}
								    ?>
								   ><label>Intermediário</label>
							<input type="checkbox" name="equi_tipo_avan" value="1"
								    <?php
								   	if(isset($equi_id)){
											if($registro['equi_tipo_avan'] == "1"){ 
											 echo "checked";
											}
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
