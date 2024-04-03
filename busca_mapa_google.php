<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Aristeu Rios Imóveis</title>

<link rel="stylesheet" type="text/css" href="css/estilo_busca_mapa.css" />
<link rel="shortcut icon" href="favicon.ico"/>

 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script src="js/jquery1.7.js" type="text/javascript"></script>
<script src="js/ajax-form.js"></script>
<script src="js/valida_busca.js" type="text/javascript"></script>


<!-- monta mapa-->
<script type="text/javascript">
    //<![CDATA[

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-22.218556,-45.934639),
        zoom: 15,
        mapTypeId: 'roadmap'
      });
    }

   //]]>
</script>



</head>
<body onload="load()">
<div id="maincontainer">

      <div id="topsection" style="">
<div id="logo"><a href="index.php"><img src="images/logo_aristeu.png" alt="" width="117" height="146"  border="0" /></a>
             </div>
           
      </div>

      <div id="contentwrapper">
          <div id="contentcolumn">
              <div id="map"></div>
          </div>
      </div>

<div id="leftcolumn">

<div id="busca_box">
     <div id="busca_titulo">
      BUSCAR IMÓVEIS PELO MAPA GOOGLE
      </div>
    <p>Para localizar os imóveis, selecione as opções abaixo:</p><br />
                
         <form id="form_box" action="busca/resultado_busca_mapa.php" method="get" name="busca_google" onsubmit="javascript:return valida()">
                        <label class="item_label">Desejo:</label>
                        <input name="compra_aluga" id="compra_aluga" type="radio" value="0" class="input-text"/><label>Comprar</label>
                        <input name="compra_aluga" id="compra_aluga" type="radio" value="1" class="input-text-superior"/><label>Alugar</label> <br><br>
                        <label class="item_label">Cidade:</label>
                        <select name="cidade" class="select" >
                             <option value="NDA">Escolha a Cidade</option>
                        </select> <br><br>
                           
                        <label class="item_label">Bairro:</label>    
                        <select name="bairro"  class="select">
                             <option value="NDA">Escolha o Bairro</option>
                        </select><br><br>

                        <label class="item_label">Valor Mínimo:</label>
                        <select name="valorminimo" class="select" id="valorminimo">
                           <option value="0"> Sem M&iacute;nimo </option>
                        </select> <br><br>
                               
                        <label class="item_label">Valor Máximo:</label>
                        <select name="valormaximo" class="select" id="valormaximo">
                         
                         <option value="999999999999">Sem M&aacute;ximo</option>
                        </select>
                        <br><br>
                   
                        <input type="image" src="images/bt_buscar.png" tabindex="1" name="button"/>
                    </form>
</div>


</div>

<div id="footer"> Aristeu Rios Im&oacute;veis<br>
Rua Coemntador Jos&eacute; Garcia, 100 - Centro<br>
Pouso Alegre - MG - Tel:(35)3449-5000<br></div>

</div>
</body>
</html>