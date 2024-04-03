<?php
include '../config/conexao.php';
$compra_aluga = mysql_real_escape_string($_GET['compra_aluga']);
$cidades = mysql_real_escape_string($_GET['cidades']);
$bairros = mysql_real_escape_string($_GET['bairros']);
$valorminimo = mysql_real_escape_string($_GET['valorminimo']);
$valormaximo = mysql_real_escape_string($_GET['valormaximo']);
$recebe_tipoimovel = mysql_real_escape_string($_GET['tipo_imovel']);
$recebe_salas = mysql_real_escape_string($_GET['salas']);
$recebe_suites = mysql_real_escape_string($_GET['suites']);
$recebe_quartos = mysql_real_escape_string($_GET['quartos']);
$recebe_banheiros = mysql_real_escape_string($_GET['banheiros']);

if ($compra_aluga == 'CO') {
    $compra_aluga = "0";
} else {
    $compra_aluga = "1";
};
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
           <div id="meio">
             <div id="meio_geral">
                <div id="meio-conteudo">
                    <h4>Resuldado da Busca Avançada</h4>
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
                        $strCount = "SELECT i.*, d.* FROM imoveis AS i INNER JOIN imoveis_desc_moradia AS d ON i.id_im = d.id_im WHERE i.venda_locacao='$compra_aluga' AND i.cidade_im LIKE '%$cidades%' AND i.bairro_im LIKE '%$bairros%' AND d.sala='$recebe_salas' AND d.quarto='$recebe_quartos' AND d.suite='$recebe_suites' AND d.banheiro='$recebe_banheiros' AND i.valor BETWEEN '$valorminimo' AND '$valormaximo' ORDER BY i.id_im ASC";
                        $query = mysql_query($strCount);
                        //$row = mysql_fetch_array($query);
                        $total = mysql_num_rows($query);

                        echo 'Foram encontrados <b style="color:#06386d">' . $total . '</b> registros para a sua busca.<br /><br />';

                        $busca = mysql_query("SELECT i.*, d.* FROM imoveis AS i INNER JOIN imoveis_desc_moradia AS d ON i.id_im = d.id_im WHERE i.venda_locacao='$compra_aluga' AND i.cidade_im LIKE '%$cidades%' AND i.bairro_im LIKE '%$bairros%' AND d.sala='$recebe_salas' AND d.quarto='$recebe_quartos' AND d.suite='$recebe_suites' AND d.banheiro='$recebe_banheiros' AND i.valor BETWEEN '$valorminimo' AND '$valormaximo' ORDER BY i.id_im ASC LIMIT $inicio,$maximo");

                        // Começa a exibição dos resultados
                        while ($resultado = mysql_fetch_array($busca)) {
                            //tabela Imoveis
                            $id_resut = $resultado['id_im'];
                            $chave_result = $resultado['chave_im'];
                            $venda_locacao_result = $resultado['venda_locacao'];
                            $finalidade_result = $resultado['finalidade_im'];
                            $cidade_result = $resultado['cidade_im'];
                            $bairro_result = $resultado['bairro_im'];
                            $valor_result = $resultado['valor'];
                            $tem_foto = $resultado['foto'];
                            $caminho_foto = $resultado['nome_foto'];
                            //tabela imoveis desc moradia
                            $tipo_imovel = $resultado['tipo_imovel'];
                            $sala = $resultado['sala'];
                            $quarto = $resultado['quarto'];
                            $suite = $resultado['suite'];
                            $banheiro = $resultado['banheiro'];

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
                                    <div id="box-foto-resultado"><img src="' . $caminho_foto . '" border="0" width="100" height="80" /></div>
                                    <div style="float: left;margin-left: 10px">
                                        <p>
                                            <b style="color: #305998;font-size: 16px">' . $finalidade_result . ' - R$ ' . number_format($valor_result, 2, ',', '.') . '</b><br/>
                                            <b>Cidade: </b>' . $cidade_result . '
                                        </p>
                                        <p>
                                            <b>Bairro:</b>' . $bairro_result . '
                                        </p>
                                        <p><b>Chave:</b>' . $chave_result . '</p>
                                    </div>
                                    <div id="botao_geral" style="float:left; margin-top:90px; margin-left:20px"><a href="../detalhe-imovel.php?id=' . $id_resut . '"><img src="../images/bt_mais_detalhes.png" width="95" height="31" alt="mais detalhes" border="0"/></a></div>
                                </div>
                                ';
                        }

                        if ($compra_aluga == '0') {
                            $compra_aluga = "CO";
                        } else {
                            $compra_aluga = "AL";
                        };
                        
                        
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
                                echo " <a href=" . $_SERVER['PHP_SELF'] . "?pagina=$mais&compra_aluga=$compra_aluga&cidades=" . str_replace(" ", "+", $cidades) . "&bairros=" . str_replace(" ", "+", $bairros) . "&valorminimo=$valorminimo&valormaximo=$valormaximo>próxima</a>";
                            }
                        }
                        
                        echo'<div style="float:right;margin-top:100px;padding-bottom:20px">';
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
                                echo " <a href=" . $_SERVER['PHP_SELF'] . "?pagina=$mais&compra_aluga=$compra_aluga&cidades=" . str_replace(" ", "+", $cidades) . "&bairros=" . str_replace(" ", "+", $bairros) . "&valorminimo=$valorminimo&valormaximo=$valormaximo>próxima</a>";
                            }
                        }
                        echo '</div>';
                        ?>
                     </div><br><br><br><br>
                     <div class ="botao_geral"><a href="javascript:window.history.go(-1)" ><img src="../images/bt_voltar.png" alt="" border="0"></a>
</div>   
                    </div>
                    
               
            </div>
</div>
            <?php include '../includes/rodape.php'; ?>
        </div>
    </body>
</html>