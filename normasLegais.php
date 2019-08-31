<!DOCTYPE html>
<meta charset="utf-8"/>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<title>Normas Legais</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
				<header id="headeradm">
					<h4>Normas Legais</h4>
					<a href="index.php#servicos"><input id="btn_logout" type="button" value="Voltar"></a>
					
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
			<main>
			<section id="sobrenos">	
				<?php

				session_start();

				require_once("DBConnection.php");

				$consulta_sql = "SELECT norm_id FROM tb_norm";

				$result = mysqli_query($conn, $consulta_sql);

				$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

				$qtde_registros_por_pag = 3;

				//definir a qtde de paginas
				$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

				//verificar qual a pagina atual
				$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

				//definir inicio da nova consulta no bd, comforme a pagina atual
				$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;

				$consulta_sql = "SELECT 
									norm_id,
									norm_tit,
									norm_desc,
									norm_font,
									DATE_FORMAT(norm_data, '%d/%m/%Y') AS norm_data
								FROM 
									tb_norm
								ORDER BY 
									norm_id DESC 
								LIMIT $inicio_consulta, $qtde_registros_por_pag";

				$result_consulta_sql = mysqli_query($conn, $consulta_sql);

				$qtde_parcial_registros_bd = mysqli_num_rows($result_consulta_sql);

				?>
				
				<div id="div_scroll">	
					<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					
					  <div id="div_noti">	
							<div id="txt_exig">
								<h2><b><?php echo $registro['norm_tit']?></b></h2>
								<p><?php echo $registro['norm_desc']?></p>	
								<h6 id="publicado_em">Fonte: <?php echo $registro['norm_font']?> </h6>
								<h6 id="publicado_em">Data: <?php echo $registro['norm_data']?> </h6>
							</div>
							

						</div>
					<?php } ?> 
				</div>
			
				<?php 
		if($pagina_atual > 1){ ?>
			<a class="tirar_sublinhado" href="normasLegais.php?pagina_atual=<?php echo ($pagina_atual - 1)?>">&#9668</a>
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
				<a class="tirar_sublinhado" href="normasLegais.php?pagina_atual=<?php echo $link ?>"><?php echo $link;?></a>
		<?php		}
			}

		if($pagina_atual != $qtde_paginas){ ?>
			<a class="tirar_sublinhado" href="normasLegais.php?pagina_atual=<?php echo ($pagina_atual + 1)?>">&#9658</a>
		<?php } ?>
				
			</section>	
			</main>
			</div>	
		<?php require_once("footer.php"); ?>
		</div>
	</body>
</html>

