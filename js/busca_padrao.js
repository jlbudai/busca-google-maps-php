// Login Form

$(function() {
    var button = $('#busca_padrao_botao');
    var box = $('#busca_box');
    var form = $('#buscaForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#busca_padrao_botao').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});
