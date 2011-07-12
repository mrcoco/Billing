function classToHash(opt){
	var param = new Hash();
	$A(document.getElementsByClassName(opt)).each(function(s){
		param.set(s.name,s.value);
	});
	return param;
}
function getSync(targetUrl,targetId,errorId,param){
	var errMess = false;
	new Ajax.Request(targetUrl, {
		method: 'post',
		parameters: param,
		onload: $('load').show(),
		onComplete: function(response) {
			$(targetId).innerHTML = response.responseText;
			if($(errorId)!=null){
				var errMess = $(errorId).value;
			}
			if(errMess){
				var param 	= 'pesan=' + errMess;
				getErr('pesan.php','load',param);
			}
			else{
				$('load').hide();
			}
		}
	});
}
function getAsync(targetUrl,targetId,param){
	new Ajax.Request(targetUrl, {
		asynchronous: false,
		method: 'post',
		parameters: param,
		onComplete: function(response) {
			$(targetId).innerHTML = response.responseText;
		}
	});
}
function getErr(targetUrl,targetId,param){
	new Ajax.Request(targetUrl, {
		method: 'post',
		parameters: param,
		onComplete: function(response) {
			$(targetId).insert(response.responseText);
		}
	});
}
function buka(opt){
	var param 		= new Hash();
	var param     	= classToHash(opt);
	var targetId	= param.get("targetId");
	var errorId		= param.get("errorId");
	param.unset("targetId");
	getSync('interface.php',targetId,errorId,param);
}
function anyar(opt){
	var param 		= new Hash();
	var param     	= classToHash(opt);
	var targetId	= param.get("targetId");
	param.unset("targetId");
	new Ajax.Request('interface.php', {
		method: 'post',
		parameters: param,
		onComplete: function(response) {
			$(targetId).innerHTML = response.responseText;
		}
	});
}
function nonghol(opt){
	$('peringatan').show();
	var param 		= new Hash();
	var param     	= classToHash(opt);
	getErr('interface.php','peringatan',param);
}
function peringatan(opt){
	$('load').show();
	var param 		= classToHash(opt);
	var targetId	= param.get('targetId');
	var messParam	= new Hash();
	messParam.set('pesan',param.get('pesan'));
	messParam.set('kelas',opt);
	getErr('peringatan.php',targetId,messParam);
}
function dashboard(opt){
	var param 	= new Hash();
	var param 	= classToHash(opt);
	var targetId  = param.get("targetId");
	new Ajax.PeriodicalUpdater(targetId, "interface.php",{
		method: "post", frequency: 1, decay: 1, parameters: param
	});
}
function pilihan(opt){
    var param     	= classToHash(opt);
    var targetUrl 	= param.get('targetUrl');
	var targetId 	= param.get('targetId');
    if($(opt).checked){
        param.set('pilihan',1);
    }
    getAsync('interface.php',targetId,param);
    //var errMess = $(errorId).value;
    //if(errMess){
    //    var messParam  = 'pesan=' + errMess;
    //    getErr('pesan.php','peringatan',messParam);
    //}
}
function tutup(opt){
	var param 	= new Hash();
	$(opt).remove();
	getAsync('kosong.php','peringatan',param);
	getAsync('kosong.php','load',param);
	$('peringatan').hide();
	$('load').hide();
	anyar('refresh');
}

function cetakin(opt){
	var param 		= classToHash(opt);
	var targetId 	= param.get('targetId');
	var targetUrl	= param.get('targetUrl');
	param.unset('targetId');
	param.unset('targetUrl');
	param = '?' + param.toQueryString();
	window.open(targetUrl + param);
	//window.open(targetUrl + '?' + param.toQueryString(),targetId,'height=400,width=1024,scrollbars=1,toolbar=0,location=0,status=0,menubar=0,resizable=0');
}