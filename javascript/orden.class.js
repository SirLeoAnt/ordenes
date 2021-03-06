TOrden = function(){
	var self = this;
	
	this.guardar = function(id,	estado, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"id": id,
				"estado": estado,
				"action": "guardar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.importar = function(items, inicio, fin, razonsocial, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"items": items,
				"inicio": inicio,
				"fin": fin,
				"razonSocial": razonsocial,
				"action": "importar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
};