<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT equi_id FROM tb_equi";

$result = mysqli_query($conn, $consulta_sql);

$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

$qtde_registros_por_pag = 1;

//definir a qtde de paginas
$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

//verificar qual a pagina atual
$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

//definir inicio da nova consulta no bd, comforme a pagina atual
$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;

$consulta_sql = "SELECT equi_id,
						CONCAT( equi_id, '; ', equi_nome ) as 'id|nome',
						CONCAT( equi_fabr, '; ', equi_forn ) as 'fabr|forn',
						CONCAT( equi_mod, '; ',  equi_marc ) as 'mod|marc',
						equi_img,
						CONCAT( equi_desc, '; ',  equi_val) as 'desc|val',
						equi_cara,
						equi_tipo_basi,
						equi_tipo_inter,
						equi_tipo_avan
 				   FROM tb_equi 
			   ORDER BY equi_id ASC LIMIT $inicio_consulta, $qtde_registros_por_pag";

$result_consulta_sql = mysqli_query($conn, $consulta_sql);

$qtde_parcial_registros_bd = mysqli_num_rows($result_consulta_sql);

mysqli_close($conn);

?>

<!DOCTYPE html>
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
							</ul>
						</nav>
						<div id="users_cadastrados">
							<a  id="link_cadastrar" href="form_equi.php" >Cadastrar Equipamento</a>
							<?php
							//Verificar a mensagem utilizando sessão 
								if(isset($_SESSION['mensagem'])){
									echo "<p>".$_SESSION['mensagem']."</p>";
									//unset($_SESSION['mensagem']);
								}
							?>
							<table id="tb8_colunas">
								<tr>
									<th><h5>ID e Nome</h5></th>
									<th><h6>Fabricante e<br>Fornecedor</h6></th> 
									<th><h6>Modelo e Marca</h6></th>
									<th><h5>Imagem</h5></th>
									<th><h6>Descrição e<br> valor</h6></th>
									<th><h6>Características</h6></th>
									<th><h5>Tipo</h5></th>
									<th class="borda_direita"><h5>Ação</h5></th>
								</tr>
								<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
								<tr>
									<td><?php echo $registro['id|nome']?></td>
									<td><?php echo $registro['fabr|forn']?></td> 
									<td><?php echo $registro['mod|marc']?></td>
									<td><?php echo $registro['equi_img']?></td>
									
									<td><?php echo $registro['desc|val'] ?></td>
									<td><?php echo $registro['equi_cara'] ?></td>
									
									<?php  ($registro['equi_tipo_basi'] == '1')? $val = "Básico; " : $val = ""; ?>
											
								
									<?php  ($registro['equi_tipo_inter'] == '1')? $val_inter = "Intermediário; " : $val_inter = ""; ?>
											
									
									<?php  ($registro['equi_tipo_avan'] == '1')? $val_ava = "Avançado;" : $val_ava = ""; ?>
											
									
									<td><?php if(isset($val)){  echo "<h6>".$val."</h6><br>"; }; 
										      if(isset($val_inter)){  echo "<h6>".$val_inter."<h6><br>"; } 
											  if(isset($val_ava)){  echo "<h6>".$val_ava."<h6>"; } ?></td>
									<td class="borda_direita">
										<a href="form_equi.php?equi_id=<?php echo $registro['equi_id'];?>"><img class="icon_edit" src="/SiteIdealLab/imagens/icone_editar.png"></a>

										<a href="equi_crud.php?equi_id=<?php echo $registro['equi_id'];?>"><img alt="Excluir" class="icon_delete" src="/SiteIdealLab/imagens/delete-button (1).png"></a>
									</td>
								</tr>
								<?php } ?> 
							</table>
							
							<?php 
							if($pagina_atual > 1){ ?>
								<a class="tirar_sublinhado" href="equipamentosCadastrados.php?pagina_atual=<?php echo ($pagina_atual - 1)?>">&#9668</a>
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
								?>	<a class="tirar_sublinhado" id="destaque" href="#"><?php echo "<b>$link</b>"; ?></a>
								
								<?php	
									}else{ 
							    ?>
									<a class="tirar_sublinhado" href="equipamentosCadastrados.php?pagina_atual=<?php echo $link ?>"><?php echo $link;?></a>
							<?php		}
								}
							
							if($pagina_atual != $qtde_paginas){ ?>
								<a class="tirar_sublinhado" href="equipamentosCadastrados.php?pagina_atual=<?php echo ($pagina_atual + 1)?>">&#9658</a>
							<?php } ?>
						</div>
					</section>
				</main>
			</div>	
			<footer>
				
			</footer>
		</div>
	</body>
</html>

