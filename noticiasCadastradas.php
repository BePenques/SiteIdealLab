<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT noti_id FROM tb_noti";

$result = mysqli_query($conn, $consulta_sql);

$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

$qtde_registros_por_pag = 1;

//definir a qtde de paginas
$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

//verificar qual a pagina atual
$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

//definir inicio da nova consulta no bd, comforme a pagina atual
$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;

$consulta_sql = "SELECT 
					noti_id, 
					LEFT(noti_tit, 10) AS noti_tit, 
					LEFT(noti_txt, 10) AS noti_txt, 
					LEFT(noti_img, 10) AS noti_img, 
					DATE_FORMAT(noti_data, '%d/%m/%Y') AS noti_data, 
					usua_nome 
 				FROM 
					tb_noti 
		     	INNER JOIN 
					tb_usua 
				USING
					(usua_id) 
			   	ORDER BY 
			   		noti_id DESC 
				LIMIT $inicio_consulta, $qtde_registros_por_pag";

$result_consulta_sql = mysqli_query($conn, $consulta_sql);

$qtde_parcial_registros_bd = mysqli_num_rows($result_consulta_sql);


?>
<!DOCTYPE html>
<meta charset="utf-8"/>

	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">
		<title>Notícias Cadastradas</title>
	</head>

			
<section id="index_adm">

	<div id="users_cadastrados">
		<a  id="link_cadastrar" href="Administracao.php?pagina=form_noticia.php" >Cadastrar Notícia</a>
		<?php
		//Verificar a mensagem utilizando sessão 
			if(isset($_SESSION['mensagem'])){
				echo "<p>".$_SESSION['mensagem']."</p>";
				unset($_SESSION['mensagem']);
			}
		?>
		<table id="tb7_colunas">
			<tr>
				<th>ID</th>
				<th>Título</th> 
				<th>Data</th>
				<th>Texto</th>
				<th>Imagem</th>
				<th>Usuário</th>
				<th class="borda_direita">Ação</th>
			</tr>
			<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
			<tr>
				<td><?php echo $registro['noti_id']?></td> 
				<td><?php echo $registro['noti_tit']?></td> 
				<td><?php echo $registro['noti_data']?></td>
				<td><?php echo $registro['noti_txt']?></td>
				<td><?php echo $registro['noti_img'] ?></td>
				<td><?php echo $registro['usua_nome'] ?></td>

				<td class="borda_direita">
					<a href="Administracao.php?pagina=form_noticia.php&noti_id=<?php echo $registro['noti_id'];?>"><img class="icon_edit" src="/SiteIdealLab/imagens/icone_editar.png"></a>

					<a href="noti_crud.php?noti_id=<?php echo $registro['noti_id'];?>&noti_img=<?php echo $registro['noti_img'];?>"><img alt="Excluir" class="icon_delete" src="/SiteIdealLab/imagens/delete-button (1).png"></a>
				</td>
			</tr>
			<?php } ?> 
		</table>

		<?php 
		if($pagina_atual > 1){ ?>
			<a class="tirar_sublinhado" href="Administracao.php?pagina=noticiasCadastradas.php&pagina_atual=<?php echo ($pagina_atual - 1)?>">&#9668</a>
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
				<a class="tirar_sublinhado" href="Administracao.php?pagina=noticiasCadastradas.php&pagina_atual=<?php echo $link ?>"><?php echo $link;?></a>
		<?php		}
			}

		if($pagina_atual != $qtde_paginas){ ?>
			<a class="tirar_sublinhado" href="Administracao.php?pagina=noticiasCadastradas.php&pagina_atual=<?php echo ($pagina_atual + 1)?>">&#9658</a>
		<?php } ?>
	</div>
</section>
