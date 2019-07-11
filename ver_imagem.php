<?php
require("DBConnection.php");
  
//$id_imagem = $_GET['noti_id'];
$id_imagem  = filter_input(INPUT_GET,'noti_id',FILTER_SANITIZE_NUMBER_INT);
$querySelecionaPorCodigo = "SELECT noti_img FROM tb_noti WHERE noti_id = '". $id_imagem ."'";

$resultado = mysqli_query($conn, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
Header( "Content-type: image/gif");
echo ($imagem->imagem);

mysqli_close($conn);


?>