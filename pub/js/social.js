function connect_social(service){
	var url = {
			url: window.location.href.toString().split(window.location.host)[1]
	};
	
	$.get("/?a="+service+"_login", url).
	done(function(data){
		data = JSON.parse(data);
		if(data.login_url != ''){
			window.location = data.login_url;
		}else{
			Core.modal({
				msg: 'Error while connecting to '+service+'.',
				alert: 'error'
			});
		}

	}).
	fail(function(){
		Core.modal({
			msg: 'Error while connecting to '+service+'.',
			alert: 'error'
		});
	});
}


function disconnect_social(service){
    
	$.get("/?a="+service+"_logoff").
	done(function(data){
		data = JSON.parse(data);
		if(data.valid != ""){
			window.location.reload();
		}else{
			Core.modal({
				msg: "Error while disconnecting from "+service+".",
				alert: "error"
			});
		}

	}).
	fail(function(){
		Core.modal({
			msg: "Error while disconnecting from "+service+".",
			alert: "error"
		});
	});
}