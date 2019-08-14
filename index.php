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
					<li><a class="sem_borda_direita" href="/SiteIdealLab/login.php">Login</a></li>	
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
					<aside class="aside_esquerdo">
					  <div id="div_lab">
						  <p id="p_tpo_lab"> Confira 3 tipos de laboratórios em diferentes níveis </p>
							<div class="lab-basico">
								<h4 class="cor_letra">Exemplo de Laboratório Básico</h4>
							</div>
							<div class="lab-interm">
								<h4>Exemplo de Laboratório Intermediário</h4>
							</div>
							<div class="lab-avanç">
								<h4>Exemplo de Laboratório Avançado</h4>
							</div>

						</div>
						<div id="div_equip">
						</div>
					</aside>	
				  <aside class="aside_direito">
					<form>
						  <h3> Cadastre-se para ter acesso ao conteúdo personalizado !</h3>
							<fieldset>
								<label>Nome: </label>
								<input type="text" name="nome" />
								<label>Telefone: </label>
								<input type="text" name="tel" class="txtpersonalizado"/>
								<label>E-mail: </label>
								<input type="text" name="email" class="txtpersonalizado"/>
								<label >Área de atuação: </label>
								<select class="cb_assunto margins2" >
									<option>Sugestão</option>
									<option>Crítica</option>
									<option>Dúvida</option>
									<option>Outro</option>
								</select>
								<label class="margins3">Verba Disponível:</label> 
								<input id="range" type="range" name="points" min="1000" max="5000"> 
								<div>
									<input type="button" value="Limpar" onclick="msg()">
									<input type="button" value="Enviar" onclick="msg()">
								</div>	
							</fieldset>
						</form>
				  </aside>
				</section>
	<!----- PAGÍNA PARCEIROS ------------------------------------------>	 
				<section id="parceiros">
				  <h1><a name="parceiros">Parceiros</a></h1>	
				</section>
	<!----- PAGÍNA CONTATO ------------------------------------------>	
				<section id="contato">
					<aside class="aside_esquerdo">
						<form>
							<fieldset>
								<legend><a name="contato"> Formulário de Contato </a></legend>
								<label>Nome: </label>
								<input type="text" name="nome" />
								<label>Telefone: </label>
								<input type="text" name="tel" class="txtpersonalizado"/>
								<label>E-mail: </label>
								<input type="text" name="email" class="txtpersonalizado"/>
								<label>Assunto:</label>
							  <select class="cb_assunto" >
									<option>Sugestão</option>
									<option>Crítica</option>
									<option>Dúvida</option>
									<option>Outro</option>
								</select>
								<textarea rows="8" cols="25" placeholder="Escreva sua mensagem..." ></textarea>
								<input type="button" value="Limpar" onclick="msg()">
								<input type="button" value="Enviar" onclick="msg()">
							</fieldset>
						</form>
					</aside>
					<aside class="aside_direito">

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