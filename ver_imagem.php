<?php

//unlink($registro['imagem_caminho']); -- para deletar do servidor

//salvar imagem no servidor



if(isset($_FILES['file']['name']) && $_FILES["file"]["error"] == 0)
{
	$imagem_nome = $_FILES['file']['name'];
	$imagem_arquivo = $_FILES['file']['tmp_name'];
	$imagem_tamanho = $_FILES['file']['size'];
	$imagem_tipo = $_FILES['file']['type'];
}


$imagem_extensao = strrchr($imagem_nome, '.');

$imagem_extensao = strtolower($imagem_extensao);

if(strstr('.jpg;.jpeg;.gif;.png', $imagem_extensao))
{
	$imagem_nome = md5(microtime()) .$imagem_extensao;
	
	$imagem_caminho = 'imagem/'. $imagem_nome;
	
	move_uploaded_file($imagem_arquivo, $imagem_caminho);
}


?>