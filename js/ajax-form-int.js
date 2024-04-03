$(document).ready(function(){
    var xarope;
    // Evento change no campo compra_aluga
    $("input[name=compra_aluga]").change(function(){
        xarope = $("input[name='compra_aluga']:checked").val();
        // Exibimos no campo cidade antes de concluirmos
        $("select[name=cidade]").html('<option value="">Carregando cidades...</option>');
        // Exibimos no campo cidade antes de selecionamos a cidade, serve também em caso
        // do usuario ja ter selecionado o tipo e resolveu trocar, com isso limpamos a
        // seleção antiga caso tenha feito.
        $("select[name=bairro]").html('<option value="NDA">Aguardando cidade...</option>');
        if(xarope == '0'){ //comprar
            $("select[name=valorminimo]").html('<option value="0">Valor Minimo</option><option value="10000">R$ 10000,00</option><option value="50000">R$ 50000,00</option><option value="90000">R$ 90000,00</option><option value="130000">R$ 130000,00</option><option value="170000">R$ 170000,00</option><option value="210000">R$ 210000,00</option><option value="250000">R$ 250000,00</option><option value="290000">R$ 290000,00</option><option value="330000">R$ 330000,00</option><option value="370000">R$ 370000,00</option><option value="410000">R$ 410000,00</option><option value="450000">R$ 450000,00</option><option value="490000">R$ 490000,00</option><option value="530000">R$ 530000,00</option><option value="570000">R$ 570000,00</option><option value="610000">R$ 610000,00</option><option value="650000">R$ 650000,00</option><option value="690000">R$ 690000,00</option><option value="730000">R$ 730000,00</option><option value="770000">R$ 770000,00</option>');
            $("select[name=valormaximo]").html('<option value="9999999999999">Valor Máximo</option><option value="10000">R$ 10000,00</option><option value="110000">R$ 110000,00</option><option value="210000">R$ 210000,00</option><option value="310000">R$ 310000,00</option><option value="410000">R$ 410000,00</option><option value="510000">R$ 510000,00</option><option value="610000">R$ 610000,00</option><option value="710000">R$ 710000,00</option><option value="810000">R$ 810000,00</option><option value="910000">R$ 910000,00</option><option value="1010000">R$ 1010000,00</option><option value="1110000">R$ 1110000,00</option><option value="1210000">R$ 1210000,00</option><option value="1310000">R$ 1310000,00</option><option value="1410000">R$ 1410000,00</option><option value="1510000">R$ 1510000,00</option><option value="1610000">R$ 1610000,00</option><option value="1710000">R$ 1710000,00</option><option value="1810000">R$ 1810000,00</option><option value="1910000">R$ 1910000,00</option>');
        }else{
            $("select[name=valorminimo]").html('<option value="0">Valor Minimo</option><option value="100">R$ 100,00</option><option value="200">R$ 200,00</option><option value="300">R$ 300,00</option><option value="400">R$ 400,00</option><option value="500">R$ 500,00</option><option value="600">R$ 600,00</option><option value="700">R$ 700,00</option><option value="800">R$ 800,00</option><option value="900">R$ 900,00</option><option value="1000">R$ 1000,00</option><option value="1100">R$ 1100,00</option><option value="1200">R$ 1200,00</option><option value="1300">R$ 1300,00</option><option value="1400">R$ 1400,00</option><option value="1500">R$ 1500,00</option><option value="1600">R$ 1600,00</option><option value="1700">R$ 1700,00</option><option value="1800">R$ 1800,00</option><option value="1900">R$ 1900,00</option><option value="2000">R$ 2000,00</option>');
            $("select[name=valormaximo]").html('<option value="9999999999999">Valor Máximo</option><option value="100">R$ 100,00</option><option value="400">R$ 400,00</option><option value="700">R$ 700,00</option><option value="1000">R$ 1000,00</option><option value="1300">R$ 1300,00</option><option value="1600">R$ 1600,00</option><option value="1900">R$ 1900,00</option><option value="2200">R$ 2200,00</option><option value="2500">R$ 2500,00</option><option value="2800">R$ 2800,00</option><option value="3100">R$ 3100,00</option><option value="3400">R$ 3400,00</option><option value="3700">R$ 3700,00</option><option value="4000">R$ 4000,00</option><option value="4300">R$ 4300,00</option><option value="4600">R$ 4600,00</option><option value="4900">R$ 4900,00</option><option value="5200">R$ 5200,00</option><option value="5500">R$ 5500,00</option><option value="5800">R$ 5800,00</option>');
        }
        
        // Passando compra_aluga por parametro para a pagina ajax-cidade.php


        $.post("../busca/ajax-cidade.php",
        {
            compra_aluga:$(this).val()

            },
        // Carregamos o resultado acima para o campo cidade
        function(valorCidade){
            $("select[name=cidade]").html(valorCidade);
        }
        )
    })

    // Evento change no campo cidade
    $("select[name=cidade]").change(function(){
        // Exibimos no campo bairro antes de concluirmos
        $("select[name=bairro]").html('<option value="">Carregando bairros...</option>');
        // Passando cidade, compra_aluga por parametro para a pagina ajax-bairro.php
        $.post("../busca/ajax-bairro.php",{
            cidade:$(this).val(),
            compra_aluga: xarope
        },
        // Carregamos o resultado acima para o campo bairro
        function(valor){
            $("select[name=bairro]").html(valor);
        }
        )
    })

})
