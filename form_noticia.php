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

						$noti_id = filter_input(INPUT_GET,'noti_id',FILTER_SANITIZE_NUMBER_INT);

						if(isset($noti_id))//Se for update
						{

							$consulta_sql = "SELECT noti_tit,
													noti_txt,
													noti_img,
													DATE_FORMAT(noti_data, '%d/%m/%Y') as noti_data
											   FROM tb_noti WHERE noti_id = '$noti_id'";

							require_once("DBConnection.php");

							$result = mysqli_query($conn, $consulta_sql);

							$registro = mysqli_fetch_array($result);

							mysqli_close($conn);
						}
					?>
					
					  <form method="post" action="noti_crud.php" id="sem_margim_top" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($noti_id)) { ?>
								<legend>Atualizar Noticia </legend>
								<input type="hidden" name="noti_id" value="<?php echo isset($noti_id)? $noti_id : "";?>">
							  	
							<?php }else{ ?>
								<legend>Cadastrar Notícia </legend>
							<?php }; ?>
						    <label>Título: </label>
							<input type="text" name="noti_tit" value="<?php echo isset($noti_id)? $registro['noti_tit'] : "";?>">
							<label>Data: </label>
							<input type="text" name="noti_data" value="<?php echo isset($noti_id)? $registro['noti_data'] : "";?>">
							<label>Texto: </label>
							<textarea class="float_right" rows="9" cols="27" name="noti_txt"><?php echo isset($noti_id)? $registro['noti_txt'] : "";?></textarea>
							  
							<label>Atualizar
							<input type="checkbox" name="noti_img" value="<?php echo isset($noti_id)? $registro['noti_img'] : "";?>"></label>
							 
							
							<label>Imagem: </label>
							<input type="file" name="file" id="file"> 
							<div>
								<input type="button" value="Voltar"</inpu>
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

