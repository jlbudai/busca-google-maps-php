<?php

require ("../config/conexao.php");

$compra_aluga = $_POST['compra_aluga'];

$sql = "SELECT DISTINCT cidade_im FROM imoveis WHERE venda_locacao='".$compra_aluga."' ORDER BY cidade_im ASC";
$qr = mysql_query($sql) or die(mysql_error());

if(mysql_num_rows($qr) == 0){
   echo  '<option value="0">'.htmlentities('Aguardando...').'</option>';
   
}else{
    echo '<option value="NDA">Todas as Cidades...</option>';
   while($ln = mysql_fetch_assoc($qr)){
      echo '<option value="'.utf8_encode($ln['cidade_im']).'">'.utf8_encode(ucwords(mb_strtolower($ln['cidade_im']))).'</option>';	  
   }
}

?>
