<?php
require ("../config/conexao.php");

$cidade = $_POST['cidade'];
$compra_aluga = $_POST['compra_aluga'];

$sql = "SELECT DISTINCT bairro_im FROM imoveis WHERE venda_locacao='" . $compra_aluga . "' AND cidade_im='" . $cidade . "' ORDER BY bairro_im ASC";
$qr = mysql_query($sql) or die(mysql_error());



if (mysql_num_rows($qr) == 0) {
    echo '<option value="NDA">' . htmlentities('Aguardando cidade...') . '</option>';
} else {
    echo '<option value="NDA">Todos os Bairros...</option>';
    while ($ln = mysql_fetch_assoc($qr)) {
        echo '<option value="' .utf8_encode($ln['bairro_im']). '">' .utf8_encode(ucwords(mb_strtolower($ln['bairro_im']))). '</option>';
    }
}


?>
