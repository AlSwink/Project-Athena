var site_url = 'http://'+window.location.hostname+'/athena/';
var app_name = '';
var loading = '';
var	active = '';
var	submit_original = '';
var last_activity = '';
var page_type = '';

$.get({
	url : site_url+'template/getLoading',
	dataType : 'json',
	success : function(res){
		loading = res;
	}
})

function templater(url=null,target,post=null,load=true,iscontroller=null,animate=true){
	if(iscontroller){
		control = url;
	}else{
		control = site_url+'template/getTemplateJSON';
	}
	$.ajax({
		type : 'POST',
		url : control,
		dataType : 'json',
		data : { url : url , post : post },
		beforeSend : function(){
			if(load){
				$(target).html(loading);
			}else{
				//$(target).html('');
			}
		},
		success : function(res){
			if(animate){
				$(target).hide().html(res).fadeIn('slow');
			}else{
				$(target).html('');
				$(target).html(res);
			}
		}
	})	
}

function form_submit(target){
	//console.log($(target).serialize());
}

function update(cm=null,target=null){
	templater(site_url+'template/getNotificationCount','#badge',null,0,1,false);
}

function clear_validation(target=null){
	if(target){
		$(target).removeClass('is-invalid');
		$(target).parent().find('.invalid-feedback').remove();
	}else{
		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();
		$('.alert').addClass('d-none');
	}
}

function createAlert(color,message){
	alert = '<div class="alert alert-'+color+'">'+message+'</div>';
	return alert;
}

function createInvalid(message){
	feedback = '<div class="invalid-feedback">'+message+'</div>';
	return feedback;
}

function startSubmit(target){
	submit_original = $(target).html();
	$(target).removeClass('btn-primary');
	$(target).addClass('btn-warning');
	$(target).html('Submitting.. <i class="fab fa-whmcs fa-spin"></i>');
	$(target).addClass('disabled');
	$(target).prop('disabled',true);
}

function endSubmit(target,modal_close=true){
	$(target).removeClass('btn-warning');
	$(target).addClass('btn-success');
	$(target).html('Submitted <i class="fas fa-check-circle"></i>');

	setTimeout(function(){
		$(target).removeClass('btn-success');
		$(target).addClass('btn-primary');
		$(target).html(submit_original);
		$(target).removeClass('disabled');
		$(target).prop('disabled',false);
		if(modal_close){
			$('.modal').modal('hide');
		}
	},750);
}

function loadDependencies(data){
	deps = '';
	$(data.css).each(function(k,v){
		deps += '<link rel="stylesheet" href="'+site_url+'assets/css/'+v+'.css"/>';
	});

	$(data.js).each(function(k,v){
		deps += '<script src="'+site_url+'assets/js/'+v+'.js"></script>';
	});

	$('head').append(deps);
}

$(document).ready(function(){
	last_activity = moment();
	update();

	$('.clock').FlipClock({
		clockFace: 'TwelveHourClock'
	});	

	$('#notif').on('click', function () {
		isShown = $('#notification_container').hasClass('show');
		if(!isShown){
			templater(site_url+'template/getNotifications','#notification_container',null,0,1,false);
			//update();
		}
	})

	//check window last activity
	$(document).click(function(){
		reload = false;
		now = moment();
		difference = (now.subtract(last_activity,'seconds'));
		diff = difference.format('s');
		url = site_url + 'api/get_'+page_type+'/'+app_name;
		
		/*$.get(url,function(res){
			if(version != res.version){
				reload = true;
			}
		});*/
		
		if(diff >= 7200){
			reload = true;
		}else{
			last_activity = moment();
		}

		if(reload)
			window.location.reload();
	})
});

/*setInterval(function(){
	//update();
},30000);*/

$(document).on('keypress','.alpha-no', function (evt) {
    if (evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});

$(document).on('click','.templater-btn',function(evt){
	evt.preventDefault();
});

$(document).on('click','.main_menu', function(evt) {
	evt.preventDefault();
	if(active == $(this).data('target')){
		$('#megamenu').collapse('toggle');
	}else{
		target = { sub_menu: $(this).data('target') };
		templater('dashboard/sub_menu','#megasubmenu',target)
	}

	$('.nav-item').removeClass('active');
    $(this).parent().addClass('active');

	if($('#megamenu').hasClass('show') == false){
		$('#megamenu').collapse('show');
	}

	active = $(this).data('target');
});

$(document).on('focusout','input',function(){
	clear_validation(this);
});

$(document).on('click','.announcement_control',function(){
	if($('.ticker-wrap').css('display') == 'none'){
		$('.ticker-wrap').fadeIn('slow');	
		$(this).html('<i class="far fa-eye-slash"></i>');
	}else{
		$('.ticker-wrap').fadeOut('slow');
		$(this).html('<i class="far fa-eye"></i>');	
	}
});

$(document).on('click','.sub_menu_items',function(evt){
	evt.preventDefault();
	url = $(this).prop('href');
	$('#megamenu').collapse('toggle');
	templater(url,'#main',null,1,1,1);
});

$(document).on('click','.refresh_me',function(evt){
	evt.preventDefault();
	url = $(this).prop('href');
	parent_container = $(this).parent().parent().parent().parent().attr('id');
	
	templater(url,'#'+parent_container,null,1,1,1);
});

$(document).on('click','.remove_me',function(evt){
	evt.preventDefault();
	parent_container = $(this).parent().parent().parent().parent().attr('id');
	$('#'+parent_container).html('');
});

