 function valida() {                        
	if (document.busca.valormaximo.value - document.busca.valorminimo.value < 0 ){
		alert('O valor minimo n�o pode ser maior que o valor max�mo');
		return false;
	}
	if (!document.busca.compra_aluga[0].checked & !document.busca.compra_aluga[1].checked) {
		alert('Escolha uma op��o: Comprar ou Alugar');
		return false;
	}
}
			
			
