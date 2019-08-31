<?php

 require_once('sc_conexao_banco.php');


 if(isset($_POST['pesquisar'])){
        
        //Pegar e filtrar valores tranmitidos via POST ou GET
        $pesquisar = filter_input(INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
        
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
				WHERE 
                	noti_tit 
            	LIKE
                	'%".$pesquisar."%'
            	  OR 
                	noti_txt 
            	LIKE
               		'%".$pesquisar."%'
				  OR
				    noti_data
				LIKE
					'%".$pesquisar."%'
				  OR
				    usua_nome
				LIKE
					'%".$pesquisar."%'
			   	ORDER BY 
			   		noti_id DESC";
     
    }else{
	 
	 
	 header("Location: index.php#noticias");
	 
    }
?>