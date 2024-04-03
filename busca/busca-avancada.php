<?php
//	include '../config/conexao.php';
//	$idNoticia = mysql_real_escape_string($_GET['id_noticia']);
//
?>
<!DOCTYPE html>
<html>
  <head>
     <?php include '../includes/head_site.php'; ?>
  </head>
   <body>
        <div id="conteudo-geral">
            <?php include "../includes/cabecalho.php"; ?>
               
              <div id="meio" style="height:450px">
                <div id="meio_geral" style="height:420px">     
                  <div id="meio-conteudo">
                    <h4>Busca Avançada</h4>
                    
                    <div id="texto-interna">
                    <p>Através dos itens abaixo, é possivel efetuar uma busca mais detalhada do imóvel que deseja. Selecione as op&ccedil;oes</p>
                    <p>e clique em BUSCAR.</p>
                      <form action="resultado-busca-avancada.php" method="get" name="busca" onsubmit="javascript:return valida();">
                        <div id="busca-avancada">  
                          Escolha uma das opções:&nbsp;&nbsp;
                                   <input name="compra_aluga" id="compra_aluga" type="radio" value="CO" onclick="busca_cidades(this.value)" class="input-text-superior"/> <b>Comprar</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <input name="compra_aluga" id="compra_aluga" type="radio" value="AL" onclick="busca_cidades(this.value)" class="input-text-superior"/> <b>Alugar</b> <br>
                                 <br>
                                 Escolha a cidade e bairro:&nbsp;&nbsp;
                                     
                        <select name="cidade_fake" id="cidade_fake" class="select-1">
                                <option value="NDA">Escolha a Cidade</option>
                        </select>
                        
                        <select name="bairro_fake" id="bairro_fake" class="select-1">
                                <option value="NDA">Escolha o Bairro</option>
                        </select>

                                       <br><br>
                                          Escolha o tipo de imóvel:&nbsp;&nbsp;
                          <input name="tipo_imovel" id="tipo_imovel" type="radio" value="Comercial"/> 
                                       <b>Comercial</b>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input name="tipo_imovel" id="tipo_imovel" type="radio" value="Casa, Kitnet, Apartamento, Sitio"/> 
                                        <b>Residencial</b> <br>
                                        
                                        <br>
                          Escolha a quantidade que deseja:&nbsp;&nbsp;&nbsp;
                                        
                                       Salas&nbsp;&nbsp;
                                        <select name="salas" id="salas" class="select-1" style="width:50px">
                                          <option value="0" >0</option>
                                          <option value="1" >1</option>
                                          <option value="2" >2</option>
                                          <option value="3" >3</option>
                                          <option value="4" >4</option>
                                          <option value="5" >5</option>
                                          <option value="6" >6</option>
                                          <option value="7" >7</option>
                                          <option value="8" >8</option>
                                          <option value="9" >9</option>
                                          <option value="10" >10</option>
                        </select>    
                                  
                                        Quartos&nbsp;&nbsp;
                                        <select name="quartos" id="quartos" class="select-1" style="width:50px">
                                          <option value="0" >0</option>
                                          <option value="1" >1</option>
                                          <option value="2" >2</option>
                                          <option value="3" >3</option>
                                          <option value="4" >4</option>
                                          <option value="5" >5</option>
                                          <option value="6" >6</option>
                                          <option value="7" >7</option>
                                          <option value="8" >8</option>
                                          <option value="9" >9</option>
                                          <option value="10" >10</option>
                                        </select>
                                   
                                        Suítes&nbsp;&nbsp;
                          <select name="suites" id="suites" class="select-1" style="width:50px">
                                          <option value="0" >0</option>
                                          <option value="1" >1</option>
                                          <option value="2" >2</option>
                                          <option value="3" >3</option>
                                          <option value="4">4</option>
                                          <option value="5" >5</option>
                                          <option value="6" >6</option>
                                          <option value="7" >7</option>
                                          <option value="8" >8</option>
                                          <option value="9" >9</option>
                                          <option value="10" >10</option>
                                        </select>
                                        Banheiros&nbsp;&nbsp;
                          <select name="banheiros" id="banheiros" class="select-1" style="width:50px">
                                          <option value="0" >0</option>
                                          <option value="1" >1</option>
                                          <option value="2" >2</option>
                                          <option value="3" >3</option>
                                          <option value="4">4</option>
                                          <option value="5" >5</option>
                                          <option value="6" >6</option>
                                          <option value="7" >7</option>
                                          <option value="8" >8</option>
                                          <option value="9" >9</option>
                                          <option value="10" >10</option>
                                        </select>
                        <br>
                                        <br>
                          Escolha uma faixa de valores:&nbsp;&nbsp;
<select name="valorminimo" class="select-1" id="valorminimo"><option value="0"> Sem M&iacute;nimo </option></select>&nbsp;&nbsp;até&nbsp;&nbsp;
                                        <select name="valormaximo" class="select-1" id="valormaximo"><option value="999999999999">Sem M&aacute;ximo</option></select><br><br>
                       
                                                               <input type="image" src="../images/bt_buscar.png" name="button"/>   
                        </div>           
                      </form>
                    </div>
                </div>
                <br><br>
            </div>
         </div>
            <?php include '../includes/rodape.php'; ?>
        </div>
    </body>
</html>