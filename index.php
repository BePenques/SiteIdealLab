<?php  session_start(); ?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<title>Home</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
			  <header>
				  <img id="logo" alt="logo" src="/SiteIdealLab/imagens/logo_teste_10.gif">
					
			  </header>
			  <nav>
				<ul>
					<li><a href="#home">Home</a></li>
					<li><a href="#sobrenos">Sobre Nós</a></li>
					<li><a href="#noticias">Notícias</a></li>
					<li><a href="#servicos">Serviços</a></li>
					<li><a href="#parceiros">Parceiros</a></li>
					<li><a href="#contato">Contato</a></li>
					
					<?php if(!isset($_SESSION['usua_nome'])){ ?>
					
						<li><a class="sem_borda_direita" href="/SiteIdealLab/login.php">Login</a>
					    </li>
					
					<?php }else{ ?>
					
						<li><a class="sem_borda_direita" href="script_login.php?logout=true">Sair</a>
					</li>
							
					<?php } ?>
				</ul>
			  </nav>
			</div>
		<!--  <div style="min-height: calc(100vh - 130px);">	-->
			  <main> 
	<!----- PAGÍNA HOME---------------------------------------------->		  
				<section id="home">
					<img class="foto_home" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
					<img class="foto_home2" src="/SiteIdealLab/imagens/GD_imgSemImagem.png"> 
				</section>
	<!----- PAGÍNA SOBRE-NOS----------------------------------------->			  
				<section id="sobrenos">
				  <aside class="bloco_esquerda">
					  <h1>Missão</h1>
					  <div class="divmissao_visao_valores">
						  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pulvinar, nibh non iaculis ultrices, purus leo dictum augue, quis blandit nulla magna non felis. Cras id tincidunt turpis. Cras vel volutpat turpis. Vestibulum ornare, sem a mollis tincidunt, tellus tortor ultrices felis, sit amet dignissim orci libero non felis. Morbi at ligula quis ipsum facilisis tempor. Etiam lobortis malesuada ipsum, quis aliquam metus efficitur non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
					  </div>
				  </aside>
				  <aside class="bloco_esquerda">
					 <h1>Visão</h1>
					  <div class="divmissao_visao_valores">
						  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pulvinar, nibh non iaculis ultrices, purus leo dictum augue, quis blandit nulla magna non felis. Cras id tincidunt turpis. Cras vel volutpat turpis. Vestibulum ornare, sem a mollis tincidunt, tellus tortor ultrices felis, sit amet dignissim orci libero non felis. Morbi at ligula quis ipsum facilisis tempor. Etiam lobortis malesuada ipsum, quis aliquam metus efficitur non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
					  </div>
				  </aside>
				  <aside class="bloco_direito">
					 <h1>Valores</h1>
					  <div class="divmissao_visao_valores">
						  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pulvinar, nibh non iaculis ultrices, purus leo dictum augue, quis blandit nulla magna non felis. Cras id tincidunt turpis. Cras vel volutpat turpis. Vestibulum ornare, sem a mollis tincidunt, tellus tortor ultrices felis, sit amet dignissim orci libero non felis. Morbi at ligula quis ipsum facilisis tempor. Etiam lobortis malesuada ipsum, quis aliquam metus efficitur non. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
					  </div>
				  </aside>
				</section>
	<!----- PAGÍNA NOTICIAS ------------------------------------------>			  
				<section id="noticias">
					
				<p id="p_noticias">Notícias</p>	
			    <form method="POST" action="index.php#noticias" id="formPesquisar">
					<input type="search" name="pesquisar" id="input_pesquisar" placeholder="Pesquisar em notícias..."/>
					<button type="submit" id="btn_pesquisarNoti">Buscar</button>
				</form>
					
				<?php
					
					require_once("DBConnection.php");
					
			     	$consulta_sql = "SELECT noti_id FROM tb_noti";

					$result = mysqli_query($conn, $consulta_sql);

					$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

					$qtde_registros_por_pag = 2;

					//definir a qtde de paginas
					$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

					//verificar qual a pagina atual
					$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

					//definir inicio da nova consulta no bd, comforme a pagina atual
					$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;
					
				 if(isset($_POST['pesquisar'])){
        
				//Pegar e filtrar valores tranmitidos via POST ou GET
				$pesquisar = filter_input(INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
					 
					 $where = "WHERE noti_tit 
								LIKE
									'%".$pesquisar."%'
								  OR 
									noti_txt 
								LIKE
									'%".$pesquisar."%'
								  OR
									noti_data
								LIKE
									'%".$pesquisar."%'
								  OR
									usua_nome
								LIKE
									'%".$pesquisar."%'";
				 }else{
					 $where = "";
				 }
					 
						
						$consulta_sql = "SELECT noti_id,
						                        noti_tit,
											    noti_txt,
											    noti_img,
											    DATE_FORMAT(noti_data, '%d/%m/%Y') as noti_data,
											    usua_nome 
										   FROM tb_noti 
		     						 INNER JOIN tb_usua USING(usua_id) 
									   $where
			                           ORDER BY noti_data ASC
									   LIMIT $inicio_consulta, $qtde_registros_por_pag";

					    $result_consulta_sql = mysqli_query($conn, $consulta_sql);
				?>
					
				<div id="div_scroll">	
					<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					
					  <div id="div_noti">	
							<div id="txt_noti">
								<h2><b><?php echo $registro['noti_tit']?></b></h2>
								<p><?php echo $registro['noti_txt']?></p>	
								<h6 id="publicado_em">Publicado em: <?php echo $registro['noti_data']?> </h6>
							</div>
						  
						   <?php if (($registro['noti_img'] != "")){?>
							<img id="img_noti" src="<?php echo $registro['noti_img']?>">
						    <?php }else{?>
						    <img id="img_noti" src="/SiteIdealLab/imagens/sem_foto.png">
						    <?php } ?>
					</div>
					<?php } ?> 
				
				
				<?php 
				if($pagina_atual > 1){ ?>
					<a class="tirar_sublinhado" href="?pagina_atual=<?php echo ($pagina_atual - 1)?>&#noticias">&#9668</a>
				<?php }

		for($link = $pagina_atual - 3, $limite_links = $link + 6;
			   $link <= $limite_links; $link++){
				if($link < 1)
				{
					$link = 1;
					$limite_links = 7;
				}
				if($limite_links > $qtde_paginas)
				{
					$limite_links = $qtde_paginas;
					$link = $limite_links - 6;
				}
				if($link < 1)
				{
					$link = 1;
					$limite_links = $qtde_paginas;
				}
				if($link == $pagina_atual)
				{
			?>	<a class="tirar_sublinhado" id="destaque" href="#noticias"><?php echo "<b>$link</b>"; ?></a>

			<?php	
				}else{ 
			?>
				<a class="tirar_sublinhado" href="?pagina_atual=<?php echo $link ?>&#noticias"><?php echo $link;?></a>
		<?php		}
			}

		if($pagina_atual != $qtde_paginas){ ?>
			<a class="tirar_sublinhado" href="?pagina_atual=<?php echo ($pagina_atual + 1)?>&#noticias">&#9658</a>
		<?php } ?>
				</div>	
				</section>
	<!----- PAGÍNA SERVICOS ------------------------------------------>						
				<section id="servicos">
					<aside class="aside_cima">
						<p id="p_captura"> Cadastre-se para receber uma simulação gratuita!</p>
						<form method="POST" action="script_simulacao.php" id="form_captura">
							<fieldset>
								<label>Nome: </label>
								<input type="text" name="nome" />
								<label>Telefone: </label>
								<input type="text" name="tel" class="txtpersonalizado"/>
								<label>E-mail: </label>
								<input type="text" name="email" class="txtpersonalizado"/>
								<label >Área de atuação: </label>
								<select class="cb_atuacao margins2" >
									<option>opcao1</option>
									<option>opcao2</option>
									<option>opcao3</option>
									<option>Outro</option>
								</select>
								<label>Verba Disponível: </label>
								<input type="text" name="verba" class="margin_top"/>
								<div class="btns">
									<input type="reset" value="Limpar">
									<input type="submit" value="Salvar" name="Salvar"> 
								</div>	
							</fieldset>
						</form>
					</aside>
					<aside class="aside_baixo">
					<div id="div_esquerda">
						<!--<p>Confira tipos de laboratórios:</p> -->
						<p id="p_captura2">Tipos de laboratórios:</p>
						<div id="div_scroll2">
							
							<?php require("sql_labo.php"); 
							while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					    
					  	<div id="div_labo">	
							<div id="div_labo_tpo">
								<p><b><?php echo $registro['labo_tipo']?></b></p></br>
								<p>Altura:<?php echo $registro['labo_alt']?></p>
								<p>Largura:<?php echo $registro['labo_lar']?></p>
							</div>
							<div id="div_labo_obs">
								<p><?php echo $registro['labo_obs']?><p>
							</div>
					  	</div>
							<?php } ?> 
						</div>	
						
					</div>	
					<div id="div_direita">
						<div id="div_links">
							<a href="listarEquipamentos.php">Confira Equipamentos para Laboratórios</a></br>
							<a href="normasLegais.php">Confira Normas Legais</a></br>
							<a href="exigenciasLegais.php">Confira Exigências Legais</a>
						</div>	
					</div></aside>
				</section>
	<!----- PAGÍNA PARCEIROS ------------------------------------------>	 
				<section id="parceiros">
				  <p id="p_noticias">Parceiros</p>	
					<div id="div_parceiros"> 
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png"></br>
					   	<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png"></br>
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
						<img id="foto_parceiro" src="/SiteIdealLab/imagens/GD_imgSemImagem.png">
					</div>
					
				</section>
	<!----- PAGÍNA CONTATO ------------------------------------------>	
				<section id="contato">
					<aside class="aside_cima">
						<form method="POST" action="script_email.php" id="sem_margim_top">
							<fieldset>
								<legend> Formulário de Contato</legend>
								<label>Nome: </label>
								<input type="text" name="contato_nome" />
								<label>Telefone: </label>
								<input type="text" name="contato_telefone" class="txtpersonalizado"/>
								<label>E-mail: </label>
								<input type="text" name="contato_email" class="txtpersonalizado"/>
								<label>Assunto:</label>
							  <select id="cb_assunto" name="contato_assunto">
									<option>Sugestao</option>
									<option>Critica</option>
									<option>Duvida</option>
									<option>Outro</option>
								</select>
								<textarea id="textarea_contato" name="contato_texto" rows="8" cols="25" placeholder="Escreva sua mensagem..." ></textarea>
							    <div id="btns2">
									<input type="reset" value="Limpar">
									<input type="submit" value="Enviar" name="Salvar"> 
								</div>
							</fieldset>
						</form>
					</aside>
					<aside class="aside_baixo">
						 <div id="div_encontrar">
							 <p class="p_encontrar">Onde nos encontrar:</p>
						 </div>	 
							 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.3905160308423!2d-47.06334738441871!3d-22.89896264335019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8c8ad9bce3363%3A0x7470022cd79a39c4!2sSenac+Campinas!5e0!3m2!1spt-BR!2sbr!4v1559764829175!5m2!1spt-BR!2sbr" frameborder="0" style="border:0" allowfullscreen></iframe>
						 
					</aside> 
				</section>
				</main>
		<!--	</div> -->
		<?php require_once("footer.php");?>
		</div>
	</body>
</html>
