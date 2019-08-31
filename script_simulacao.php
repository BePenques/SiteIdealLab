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
					<h4>Simulação de melhor laboratório e equipamentos</h4>
					<a href="index.php"><input id="btn_logout" type="button" value="Voltar"></a>
					
				</header>
			</div>
			<div style="min-height: calc(100vh - 70px);">	
			<main>
			<section id="simulacao">	

				<?php

				if(isset($_POST['Salvar'])){

					unset($_POST['Salvar']);

					$verba =   filter_input(INPUT_POST, 'verba', FILTER_SANITIZE_STRING);

					require("DBConnection.php");
					
					$consulta_sql = "SELECT labo_id, 
										labo_tipo, 
										labo_alt,
										labo_lar,
										labo_obs
								   FROM tb_labo
								   WHERE $verba BETWEEN valor_min AND valor_max 
							   ORDER BY labo_id ASC LIMIT 1";

					$result_consulta_sql = mysqli_query($conn, $consulta_sql);
					
					
					if(strstr('Básico', $consulta_sql)){
						
						
					
					$consulta_sql_equi = "SELECT e.equi_id,
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
									   WHERE e.equi_tipo_basi = '1' 
								   ORDER BY equi_id ASC ";
						
					}else if( $registro['labo_tipo'] == "Intermediário"){
						
						$consulta_sql_equi = "SELECT e.equi_id,
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
									   WHERE e.equi_tipo_inter = '1' 
								   ORDER BY equi_id ASC ";
					}else{
						
						$consulta_sql_equi = "SELECT e.equi_id,
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
									   WHERE e.equi_tipo_avan = '1' 
								   ORDER BY equi_id ASC ";
					
					
					}
					
					$result_consulta_sql_equi = mysqli_query($conn, $consulta_sql_equi);

				    

					mysqli_close($conn);


				}
				?>
		        <p id="p_captura2">O laboratório recomendado para você é: </p>	
				<div id="div_scroll3">	
					<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					
					  	<div id="div_labo2">	
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
				
				
				<p id="p_captura2">Os equipamentos recomendados para o seu laboratório são: </p>

				<table id="tb_equi">
				<tr>
				<?php while($registro_equi = mysqli_fetch_array($result_consulta_sql_equi, MYSQLI_BOTH)){?>
				
					<td>	
						<div id="div_equi2">
							<div id="div_txt_equi2">
								<h2><b><?php echo $registro_equi['equi_nome']?></b></h2>
								<p><b>Fabricante: </b> <?php echo $registro_equi['fabr_nome']?></p>
								<p><b>Fornecedor: </b> <?php echo $registro_equi['forn_nome']?></p>
								<p><b>Modelo: </b> <?php echo $registro_equi['equi_mod']?></p>
								<p><b>Marca: </b> <?php echo $registro_equi['equi_marc']?></p>
								<p><b>Descrição: </b> <?php echo $registro_equi['equi_desc']?></p>
								<p><div class="div_txt"><b>Características: </b> <?php echo $registro_equi['equi_cara']?></div></p>
								<p><b>Valor: </b> <?php echo $registro_equi['equi_val']?></p>
							
							</div>	
						    <?php if (($registro_equi['equi_img'] != "")){?>
							<img id="img_equi" src="<?php echo $registro_equi['equi_img']?>">
						    <?php }else{?>
						    <img id="img_equi" src="/SiteIdealLab/imagens/sem_foto.png">
						    <?php } ?>
							
						</div>	
					</td>
			
				<?php } ?> 
				</tr>
			</table>
				
			</section>	
			</main>
			</div>	
		<?php require_once("footer.php"); ?>
		</div>
	</body>
</html>

