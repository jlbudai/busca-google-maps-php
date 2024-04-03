 function valida() {                        
	if (document.busca.valormaximo.value - document.busca.valorminimo.value < 0 ){
		alert('O valor minimo não pode ser maior que o valor maxímo');
		return false;
	}
	if (!document.busca.compra_aluga[0].checked & !document.busca.compra_aluga[1].checked) {
		alert('Escolha uma opção: Comprar ou Alugar');
		return false;
	}
}
			
			
