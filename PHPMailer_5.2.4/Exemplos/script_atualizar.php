<?php
session_start();

require_once("conexao_banco.php");

$id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
$email =   filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha =   filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$tipo =   filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

$consulta_sql = "UPDATE tb_users SET  email = '". $email ."', senha = '". $senha ."', tipo = '". $tipo ."' WHERE id_user = '". $id_user ."'";

$result = mysqli_query($conn, $consulta_sql);

if(mysqli_affected_rows($conn)){
	 $_SESSION['mensagem'] = "<span style='color:green'>Usuário editado com sucesso</span>";
        header("Location: listar_users.php");
}else{
	 $_SESSION['mensagem'] = "<span style='color:red'>Usuário editado com sucesso</span>";
        header("Location: listar_users.php");
}

mysqli_close($conn);

?>