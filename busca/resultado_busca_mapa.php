<?php
include '../config/conexao.php';
$compra_aluga = mysql_real_escape_string($_GET['compra_aluga']);
$cidades = mysql_real_escape_string(mb_strtoupper($_GET['cidade'], 'iso-8859-1'));
$bairros = mysql_real_escape_string(mb_strtoupper($_GET['bairro'], 'iso-8859-1'));
$valorminimo = mysql_real_escape_string($_GET['valorminimo']);
$valormaximo = mysql_real_escape_string($_GET['valormaximo']);


if ($cidades == 'NDA') {
    $cidades = "";
} else {
    
};
if ($bairros == 'NDA') {
    $bairros = "";
} else {
    
};
if ($valorminimo == 'NDA') {
    $valorminimo = "";
} else {
    
};
if ($valormaximo == 'NDA') {
    $valormaximo = "";
} else {
    
};


function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
}

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mapa Google</title>

<link rel="stylesheet" type="text/css" href="../css/estilo_busca_mapa.css" />

<script src="../js/jquery1.7.js" type="text/javascript"></script>
<script src="../js/ajax-form-int.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="../js/label.js"></script>
<script src="../js/mapa.js"></script>
<script src="../js/valida_busca.js" type="text/javascript"></script>

<!-- monta mapa-->
<script type="text/javascript">
    //<![CDATA[

    function load() {
      loadMapWithAjax();
    }

     //]]>

</script>

</head>
<body onload="load()">
<div id="maincontainer">

      <div id="topsection">
         
         <div id="logo"><a href="index.php"><img src="../images/logo_aristeu.png" alt="" width="117" height="146" border="0" /></a>
             </div>
           
      </div>

      <div id="contentwrapper">
          <div id="contentcolumn">
              <div id="map"></div>
          </div>
      </div>

<div id="leftcolumn">
   
    <div id="lista">       
  	   <?php
          // Maximo de registros por pagina
          $maximo = 10;

          // Declaração da pagina inicial
           $pagina = $_GET["pagina"];
           if ($pagina == "") {
                $pagina = "1";
           }

          // Calculando o registro inicial
           $inicio = $pagina - 1;
           $inicio = $maximo * $inicio;

           // Conta os resultados no total da query
           $strCount = "SELECT COUNT(*) AS 'num_registros' FROM imoveis WHERE venda_locacao='$compra_aluga' AND cidade_im LIKE '%$cidades%' AND bairro_im LIKE '%$bairros%' AND valor BETWEEN '$valorminimo' AND '$valormaximo' ORDER BY id_im ASC";
           $query = mysql_query($strCount);
           $row = mysql_fetch_array($query);
           $total = $row["num_registros"];

           echo '<div class ="box_paginas">Resultado da busca: <b style="color:#06386d">' . $total . '</b> imóveis</div>
		   <div class="icone_fechar">
            <a href="../busca_mapa_google.php" border="0" /><img src="../images/icone_close.gif"/></a>
        </div><br />';

           $busca = mysql_query("SELECT * FROM imoveis WHERE venda_locacao='$compra_aluga' AND cidade_im LIKE '%$cidades%' AND bairro_im LIKE '%$bairros%' AND valor BETWEEN '$valorminimo' AND '$valormaximo' ORDER BY id_im ASC LIMIT $inicio,$maximo");

         // Começa a exibição dos resultados
       while ($resultado = mysql_fetch_array($busca)) {
              $id_result = $resultado['id_im'];
              $chave_result = $resultado['chave_im'];
              $venda_locacao_result = $resultado['venda_locacao'];
              $finalidade_result = $resultado['finalidade_im'];
              $cidade_result = $resultado['cidade_im'];
              $bairro_result = $resultado['bairro_im'];
			  $end_result = $resultado['end_im'];
              $valor_result = $resultado['valor'];
              $tem_foto = $resultado['foto'];
              $caminho_foto = $resultado['nome_foto'];
              
				  
			  
              if ($tem_foto == "0") {
                 $caminho_foto = "../fotos/sem_foto.jpg";
              } else {
                  $caminho_foto = "../fotos/" . $resultado['nome_foto'];
              };
        
		      if ($venda_locacao_result == "0") {
                  $venda_locacao_result = "Venda";
              } else {
                   $venda_locacao_result = "Locação";
              };
              echo'
              <div class="lista_item" id="lista_item-'.$id_result.'">
				 <div class="lista_icone" alt="Chave do imóvel">' . $chave_result . '</div>
				 <div class="lista_foto">
					<img src="' . $caminho_foto .  '" border="0" width="61" height="42" id="img-'.$id_result.'" />
				 </div>
				 <div class="lista_titulo">
				 	     ' . $finalidade_result . ' - R$ ' . number_format($valor_result, 2, ',', '.') . '
				 </div>
				 <div class="lista_texto">
				     <b>Cidade: </b>' . $cidade_result . '<br>
                     <b>Bairro:</b>' . $bairro_result . '<br>
					
                 </div>
                                 
             </div>';
		 }
                             
				   
					    //Paginacao
                        $menos = $pagina - 1;
                        $mais = $pagina + 1;

                        $pgs = ceil($total / $maximo);

                        if ($pgs > 1) {

                            echo "<br />";

                            // Mostragem de pagina
                            if ($menos > 0) {
                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?pagina=$menos&compra_aluga=$compra_aluga&cidades=" . str_replace(" ", "+", $cidades) . "&bairros=" . str_replace(" ", "+", $bairros) . "&valorminimo=$valorminimo&valormaximo=$valormaximo>anterior</a>&nbsp; ";
                            }

                            // Listando as paginas
                            for ($i = 1; $i <= $pgs; $i++) {
                                if ($i != $pagina) {
                                    echo " <a href=" . $_SERVER['PHP_SELF'] . "?pagina=" . ($i) . "&compra_aluga=$compra_aluga&cidades=" . str_replace(" ", "+", $cidades) . "&bairros=" . str_replace(" ", "+", $bairros) . "&valorminimo=$valorminimo&valormaximo=$valormaximo>$i</a> | ";
                                } else {
                                    echo " <strong>" . $i . "</strong> | ";
                                }
                            }

                            if ($mais <= $pgs) {
                                echo " <a href=" . $_SERVER['PHP_SELF'] . "?pagina=$mais&compra_aluga=$compra_aluga&cidades=" . str_replace(" ", "+", $cidades) . "&bairros=" . str_replace(" ", "+", $bairros) . "&valorminimo=$valorminimo&valormaximo=$valormaximo>próxima</a><br/>";
                            }
                        }
                        echo '</div>';
                        ?>
                        
</div>
</div>

<div id="footer">Aristeu Rios Imóveis<br>
Rua Coemntador Jos&eacute; Garcia, 100 - Centro<br>
Pouso Alegre - MG - Tel:(35)3449-50001<br></div>

</div>
</body>
</html>