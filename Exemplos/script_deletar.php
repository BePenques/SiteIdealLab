<?php

session_start();

require_once("conexao_banco.php");

$id_user = filter_input(INPUT_GET,'id_user',FILTER_SANITIZE_NUMBER_INT);

$consulta_sql = "DELETE FROM tb_users WHERE id_user = '". $id_user ."'";

$result = mysqli_query($conn, $consulta_sql);

$registro = mysqli_fetch_array($result);

if(mysqli_affected_rows($conn)){
	 $_SESSION['mensagem'] = "<span style='color:green'>Usuário excluido com sucesso</span>";
        header("Location: listar_users.php");
}else{
	 $_SESSION['mensagem'] = "<span style='color:red'>Usuário excluido com sucesso</span>";
        header("Location: listar_users.php");
}

mysqli_close($conn);

?>