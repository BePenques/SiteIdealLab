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
					<?php
						require_once("DBConnection.php");
						$consulta_sql = "SELECT exij_id,
												exij_tit,
												exij_desc,
												exij_font,
												DATE_FORMAT(exij_data, '%d/%m/%Y') AS exij_data
										   FROM tb_exij
									   ORDER BY exij_data ASC";

					    $result_consulta_sql = mysqli_query($conn, $consulta_sql);
					?>
				
				<div id="div_scroll">	
					<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
					
					  <div id="div_noti">	
							<div id="txt_exig">
								<h2><b><?php echo $registro['exij_tit']?></b></h2>
								<p><?php echo $registro['exij_desc']?></p>	
								<h6 id="publicado_em">Fonte: <?php echo $registro['exij_font']?> </h6>
								<h6 id="publicado_em">Data: <?php echo $registro['exij_data']?> </h6>
							</div>
							

						</div>
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

