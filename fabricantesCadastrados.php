<?php

session_start();

require_once("DBConnection.php");

$consulta_sql = "SELECT fabr_id FROM tb_fabr";

$result = mysqli_query($conn, $consulta_sql);

$_qtde_total_registros_bd = mysqli_num_rows($result);//pega o numero total de linhas

$qtde_registros_por_pag = 1;

//definir a qtde de paginas
$qtde_paginas = ceil($_qtde_total_registros_bd / $qtde_registros_por_pag);

//verificar qual a pagina atual
$pagina_atual = isset($_GET['pagina_atual'])? filter_input(INPUT_GET, 'pagina_atual', FILTER_SANITIZE_NUMBER_INT): 1;

//definir inicio da nova consulta no bd, comforme a pagina atual
$inicio_consulta = ($qtde_registros_por_pag * $pagina_atual) - $qtde_registros_por_pag;

$consulta_sql = "SELECT fabr_id, 
						fabr_nome, 
						fabr_end,
						fabr_resp,
						CONCAT(fabr_mail,'; ',fabr_tel) AS 'contato',
						CONCAT(fabr_cnpj,'; ',fabr_ie) AS 'cnpj|ie'
				   FROM tb_fabr 
			   ORDER BY fabr_id ASC LIMIT $inicio_consulta, $qtde_registros_por_pag";

$result_consulta_sql = mysqli_query($conn, $consulta_sql);

$qtde_parcial_registros_bd = mysqli_num_rows($result_consulta_sql);

mysqli_close($conn);

?>
<!DOCTYPE html>
<meta charset="utf-8"/>
<section id="index_adm">
	<head>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">
		<title>Home</title>
	</head>
	<div id="users_cadastrados">
		<a  id="link_cadastrar" href="Administracao.php?pagina=form_fabricante.php" >Cadastrar Fabricante</a>
		<?php
		//Verificar a mensagem utilizando sessão 
			if(isset($_SESSION['mensagem'])){
				echo "<p>".$_SESSION['mensagem']."</p>";
				unset($_SESSION['mensagem']);
			}
		?>

		<table id="tb7_colunas">
			<tr><th>ID</th>
				<th>Nome</th> 
				<th>Endereço</th>
				<th>Responsável</th>
				<th>Contato</th>
				<th><h5>CNPJ e Insc. Estadual</h5></th>
				<th class="borda_direita">Ação</th>
			</tr>
			<?php while($registro = mysqli_fetch_array($result_consulta_sql, MYSQLI_BOTH)){?>
			<tr>
				<td><?php echo $registro['fabr_id']?></td>
				<td><?php echo $registro['fabr_nome']?></td> 
				<td><?php echo $registro['fabr_end']?></td>
				<td><?php echo $registro['fabr_resp']?></td>
				<td><?php echo $registro['contato']?></td>
				<td><?php echo $registro['cnpj|ie']?></td>
				<td class="borda_direita">
					<a href="Administracao.php?pagina=form_fabricante.php&fabr_id=<?php echo $registro['fabr_id'];?>"><img class="icon_edit" src="/SiteIdealLab/imagens/icone_editar.png"></a>

					<a href="Administracao.php?pagina=fabr_crud.php&fabr_id=<?php echo $registro['fabr_id'];?>"><img alt="Excluir" class="icon_delete" src="/SiteIdealLab/imagens/delete-button (1).png"></a>
				</td>
			</tr>
			<?php }?>
		</table>
		<?php 
		if($pagina_atual > 1){ ?>
			<a class="tirar_sublinhado" href="Administracao.php?pagina=fabricantesCadastrados.php&pagina_atual=<?php echo ($pagina_atual - 1)?>">&#9668</a>
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
				<a class="tirar_sublinhado " href="Administracao.php?pagina=fabricantesCadastrados.php&pagina_atual=<?php echo $link ?>"><?php echo $link;?></a>
		<?php		}
			}

		if($pagina_atual != $qtde_paginas){ ?>
			<a class="tirar_sublinhado " href="Administracao.php?pagina=fabricantesCadastrados.php&pagina_atual=<?php echo ($pagina_atual + 1)?>&pagina=fabricantesCadastrados.php">&#9658</a>
		<?php } ?>
	</div>
</section>
				
