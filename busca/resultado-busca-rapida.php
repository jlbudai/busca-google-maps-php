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
?>

<!DOCTYPE html>
<html>
     <head>
       <?php include '../includes/head_site.php'; ?>
        
    </head>
    <body>
        <div id="conteudo-geral">
            <?php include '../includes/cabecalho.php'; ?>
           <div id="meio" style="height:1300px">
            <div id="meio_geral">
                <div id="meio-conteudo">
                    <h3>Resultado da Busca</h3>
                    <div id="texto-interna">
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

                        echo 'Foram encontrados <b style="color:#06386d">' . $total . '</b> registros para a sua busca.<br /><br />';

                        $busca = mysql_query("SELECT * FROM imoveis WHERE venda_locacao='$compra_aluga' AND cidade_im LIKE '%$cidades%' AND bairro_im LIKE '%$bairros%' AND valor BETWEEN '$valorminimo' AND '$valormaximo' ORDER BY id_im ASC LIMIT $inicio,$maximo");

                        // Começa a exibição dos resultados
                        while ($resultado = mysql_fetch_array($busca)) {
                            $id_resut = $resultado['id_im'];
                            $chave_result = $resultado['chave_im'];
                            $venda_locacao_result = $resultado['venda_locacao'];
                            $finalidade_result = $resultado['finalidade_im'];
                            $cidade_result = $resultado['cidade_im'];
                            $bairro_result = $resultado['bairro_im'];
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
                                <div id="box-busca-resultado">
								   
                                    <div id="box-foto-resultado">
									<img src="' . $caminho_foto .  '" border="0" width="100" height="80" /></div>
									
                                    <div style="float: left;margin-left: 10px">
                                        <p>
                                            <h4>' . $finalidade_result . ' - R$ ' . number_format($valor_result, 2, ',', '.') . '</h4><br/>
                                            <b>Cidade: </b>' . $cidade_result . '
                                        </p>
                                        <p>
                                            <b>Bairro:</b>' . $bairro_result . '
                                        </p>
                                        <p><b>Chave:</b>' . $chave_result . '</p><br>
										<p><a href="../detalhe-imovel.php?id=' . $id_resut . '"><img src="../images/bt_mais_detalhes.png" alt="" border=""/></a></p>
                                    </div>
                                    
                                </div>
                                ';
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
                        
                        echo'<div style="float:right;margin-top:100px;padding-bottom:20px">';
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
                        <div style="float: left;height: 40px;width: 50%; margin-top:70px; position:relative;">Não encontrou seu imóvel ? <br> Efetue uma<a href="busca-avancada.php"> <b>BUSCA AVANÇADA</b></a></div>
                     
                        
                    </div><!-- fim texto-interna-->
                 <div class ="botao_geral"><a href="javascript:window.history.go(-1)" ><img src="../images/bt_voltar.png" alt="" border="0"></a>
</div>   
                </div><!-- fim meio conteuudo-->
              
</div><!-- fim meio-geral-->
</div><!-- fim meio -->
<?php include '../includes/rodape.php'; ?>
</div> <!-- fim conteudo-geral-->
</body>
</html>