var customIcons = {
    Residencial: {
        icon: '../images/icone_residencial.png',
        shadow: '../images/icone_shadow.png'
    },
    Comercial: {
        icon: '../images/icone_comercial.png',
        shadow: '../images/icone_shadow.png'
    },
    Padrao: {
        icon: '../images/icone_padrao.png',
        shadow: '../images/icone_shadow.png'
    }
};

function loadMapWithAjax() {
    var latLngPadrao = new google.maps.LatLng(-22.218556, -45.933952);
    var zoomPadrao = 13;

    var bounds = new google.maps.LatLngBounds();
    var map = new google.maps.Map(document.getElementById("map"), {
        center: latLngPadrao,
        zoom: zoomPadrao,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infoWindow = new google.maps.InfoWindow;

    // Change this depending on the name of your PHP file
    downloadUrl("../mapa/mapaxml.php" + location.search, function(data) {
        var xml = $.parseXML(data.responseText);
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
            var lat_im = markers[i].getAttribute("lat_im");
            var lng_im = markers[i].getAttribute("lng_im");
            var id_im = markers[i].getAttribute("id_im");
            var bairro_im = markers[i].getAttribute("bairro_im");
            var end_im = markers[i].getAttribute("end_im");
            var cidade_im = markers[i].getAttribute("cidade_im");
            var finalidade_im = markers[i].getAttribute("finalidade_im");
            var valor = markers[i].getAttribute("valor");
            var chave_im = markers[i].getAttribute("chave_im");
            var nome_foto = markers[i].getAttribute("nome_foto");

            var html = null;
            var icon = null;
            var marker = null;
            try {
                var lat = parseFloat(lat_im);
                var lng = parseFloat(lng_im);
                if (latLngValidos(lat, lng)) {
                    var point = new google.maps.LatLng(lat, lng);
                    bounds = bounds.extend(point);

                    html = '<div class="infoWindow">'
                            + '<img class="foto" src="../fotos/' + nome_foto + '" alt="">'
                            + '<div class="bairro">' + bairro_im + '</div>'
                            + '<div class="valor">R$&nbsp;' + valor + '</div>'
                            + '<div class="endereco">' + end_im + '<br>' + cidade_im + '</div>'
                            + '<div class="detalhes"><a href="../detalhe-imovel.php?id=' + id_im + '"><img src="../images/bt_maisdetalhes.png" alt="Mais detalhes" border="0"></a></div>'
                            + '</div>';

                    icon = customIcons[finalidade_im] || customIcons['Padrao'];
                    marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        icon: icon.icon,
                        shadow: icon.shadow
                    });
                    var label = new Label(point, icon.icon, chave_im || "?", finalidade_im);
                    label.setMap(map);

                    bindInfoWindow(marker, map, infoWindow, html, id_im);
                }
            } catch (ex) {
                // alert(ex.message);
            }
            bindClick(marker, map, infoWindow, html, id_im);
        }

        // se não tem nada na busca, mostra o latLngPadrao e zoomPadrao
        if (markers.length === 0) {
            map.setCenter(latLngPadrao);
            map.setZoom(zoomPadrao);
        }
        // senão, centraliza e limita o zoom
        else {
            map.fitBounds(bounds);
            google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                if (map.getZoom() > 16) {
                    map.setZoom(16);
                }
                else if (map.getZoom() < 13) {
                    map.setZoom(13);
                }
            });
        }
    });
}

function downloadUrl(url, callback) {
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'xml'
    }).done(function(data, textStatus, jqXHR) {
        var request = jqXHR;
        if (request.readyState === 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    });
}

function doNothing() {
}

function latLngValidos(lat, lng) {
    // se lat_im ou lng_im forem null, o parseFloat retorna NaN
    // idem quando não consegue converter (ele não gera exceção como se poderia esperar...)

    return !isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0;
}

function bindInfoWindow(marker, map, infoWindow, html, id_im) {
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
        $(".lista_item").removeClass("imovel-selecionado");
        $("#lista_item-" + id_im).addClass("imovel-selecionado");
    });
}

function bindClick(marker, map, infoWindow, html, id_im) {
    var clicavel = document.getElementById("img-" + id_im);
    if (clicavel) {
        if (marker === null) {
            clicavel.onclick = function(evt) {
                infoWindow.close();
                $(".lista_item").removeClass("imovel-selecionado");
                alert("Não há informações geográficas para este imóvel!");
            };
        }
        else {
            clicavel.onclick = function(evt) {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
                $(".lista_item").removeClass("imovel-selecionado");
                $("#lista_item-" + id_im).addClass("imovel-selecionado");
            };
        }
    }
}
