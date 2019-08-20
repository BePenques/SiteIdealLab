
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
				<form id="formPesquisar">
					<input id="input_pesquisar" type="search"/><img id="lupa" alt="icone_lupa" src="/SiteIdealLab/imagens/lupa.png">
				</form>	
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
					
						<li><a class="sem_borda_direita" href="/SiteIdealLab/login.php">Login</a></li>
					
					<?php }else{ ?>
					
						<li><a class="sem_borda_direita" href="script_login.php?logout=true">Logout</a></li
							
					<?php } ?>
				</ul>
			  </nav>
			</div>
		<!--  <div style="min-height: calc(100vh - 130px);">	-->
			  <main> 
	<!----- PAGÍNA HOME---------------------------------------------->		  
				<section id="home">
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
					
					<?php
						require_once("DBConnection.php");
						$consulta_sql = "SELECT noti_id,
						                        noti_tit,
											    noti_txt,
											    noti_img,
											    DATE_FORMAT(noti_data, '%d/%m/%Y') as noti_data,
											    usua_nome 
										   FROM tb_noti 
		     						 INNER JOIN tb_usua USING(usua_id) 
			                           ORDER BY noti_data ASC";

					    $result_consulta_sql = mysqli_query($conn, $consulta_sql);
					?>
				<p id="p_noticias">Notícias</p>	
				<div id="div_scroll">	
					<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					
					  <div id="div_noti">	
							<div id="txt_noti">
								<h2><b><?php echo $registro['noti_tit']?></b></h2>
								<p><?php echo $registro['noti_txt']?></p>	
								<h6 id="publicado_em">Publicado em: <?php echo $registro['noti_data']?> </h6>
							</div>
							<img id="img_noti" src="<?php echo $registro['noti_img'] ?>">

						</div>
					<?php } ?> 
				</div>	
		
					
				</section>
	<!----- PAGÍNA SERVICOS ------------------------------------------>						
				<section id="servicos">
					<aside class="aside_cima">
						<p id="p_captura"> Cadastre-se para receber uma simulação gratuita!</p>
						<form method="POST" action="" id="form_captura">
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
							<a href="">Confira Equipamentos para laboratórios</a></br>
							<a href="normasLegais.php">Confira Normas Legais</a></br>
							<a href="exigenciasLegais.php">Confira Exigências legais</a>
						</div>	
					</div></aside>
				</section>
	<!----- PAGÍNA PARCEIROS ------------------------------------------>	 
				<section id="parceiros">
				  <h1><p>Parceiros</p></h1>	
					<div> 
						<img id="foto_parceiro" src="/imagens/GD_imgSemImagem.png">
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
			<footer>
				<h6>Betiza Barreira - 2019 </h6>
			</footer>
		</div>
	</body>
</html>
