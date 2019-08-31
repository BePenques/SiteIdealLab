<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT equi_id FROM tb_equi";

$result = mysqli_query($conn, $consulta_sql);

$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

$qtde_registros_por_pag = 4;

//definir a qtde de paginas
$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

//verificar qual a pagina atual
$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

//definir inicio da nova consulta no bd, comforme a pagina atual
$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;


$consulta_sql = "SELECT e.equi_id,
					    a.fabr_id,
					    e.forn_id,
						e.equi_nome,
						a.fabr_nome,
						f.forn_nome,
						e.equi_mod,
						e.equi_marc,
						e.equi_desc,
						e.equi_img,
						e.equi_val,
						e.equi_cara,
						e.equi_tipo_basi,
						e.equi_tipo_inter,
						e.equi_tipo_avan
 				   FROM tb_equi e
                   LEFT JOIN tb_fabr a using(fabr_id)
                   LEFT JOIN tb_forn f using(forn_id)
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
		<title>Exigências Legais</title>
	</head>
	<body>
		<div id="site">
			<div id="menu">	
				<header id="headeradm">
					<h4>Exigências Legais</h4>
					<a href="index.php"><input id="btn_logout" type="button" value="Voltar"></a>
					
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
			<main>
			<section id="sobrenos">
				
			<table id="tb_equi">
				<tr>
				<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
				
					<td>	
						<div id="div_equi">
							<div id="div_txt_equi">
								<h2><b><?php echo $registro['equi_nome']?></b></h2>
								<p><b>Fabricante: </b> <?php echo $registro['fabr_nome']?></p>
								<p><b>Fornecedor: </b> <?php echo $registro['forn_nome']?></p>
								<p><b>Modelo: </b> <?php echo $registro['equi_mod']?></p>
								<p><b>Marca: </b> <?php echo $registro['equi_marc']?></p>
								<p><b>Descrição: </b> <?php echo $registro['equi_desc']?></p>
								<p><div class="div_txt"><b>Características: </b> <?php echo $registro['equi_cara']?></div></p>
								<p><b>Valor: </b> <?php echo $registro['equi_val']?></p>
								<p><b> Indicado para laboratório(s) de nível: </b>
								<?php  
									($registro['equi_tipo_basi'] == '1')? $val = "Básico; " : $val = ""; 

									($registro['equi_tipo_inter'] == '1')? $val_inter = "Intermediário; " : $val_inter = ""; 

									($registro['equi_tipo_avan'] == '1')? $val_ava = "Avançado;" : $val_ava = ""; 
																						   
								?>
							<?php if(isset($val)){  echo "<p><h5>".$val."</h5><br></p>"; }; 
						  		  if(isset($val_inter)){  echo "<h5>".$val_inter."<h5><br>"; } 
						          if(isset($val_ava)){  echo "<h5>".$val_ava."<h5>"; } ?>
								</p>
							</div>	
						    <?php if (($registro['equi_img'] != "")){?>
							<img id="img_equi" src="<?php echo $registro['equi_img']?>">
						    <?php }else{?>
						    <img id="img_equi" src="/SiteIdealLab/imagens/sem_foto.png">
						    <?php } ?>
							
						</div>	
					</td>
			
				<?php } ?> 
				</tr>
			</table>
				

		<?php 
		if($pagina_atual > 1){ ?>
			<a class="tirar_sublinhado" href="listarEquipamentos.php?pagina_atual=<?php echo ($pagina_atual - 1)?>">&#9668</a>
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
				<a class="tirar_sublinhado" href="listarEquipamentos.php?pagina_atual=<?php echo $link ?>"><?php echo $link;?></a>
		<?php		}
			}

		if($pagina_atual != $qtde_paginas){ ?>
			<a class="tirar_sublinhado" href="listarEquipamentos.php?pagina_atual=<?php echo ($pagina_atual + 1)?>">&#9658</a>
		<?php } ?>
			</section>
			</main>
			</div>	
		<?php require_once("footer.php"); ?>
		</div>
	</body>
</html>



			