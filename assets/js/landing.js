var site_url = window.location.protocol+'//'+window.location.hostname+'/athena/';
var img_dir = site_url+'assets/img/landing/';
var photos = [];
var counter = 0;

//fetch available photos from the directory and use the array as an album
$.get(site_url+'/landing/getLandingPhotos',function(res){
	for(x=0;x<res.length;x++){
		photos.push(img_dir+res[x]);
	}
},'json');	

//preload images
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}
$(photos).preload();

//background image rotator
setInterval(function(){ 
	counter = (counter==photos.length ? 0 : counter);
	background = photos[counter];
	$('#backdrop').animate({ opacity: 0.75 },800,function(){
		$('#backdrop').animate({opacity: 0.5},200,function(){
				$('#backdrop').css('background-image','url('+background+')');
				$('#backdrop').animate({ opacity: 0.75 }, 800);
		});
	});
	counter++;
},
10000);

$(document).ready(function(){
	var movementStrength = 10;
	var height = movementStrength / $(window).height();
	var width = movementStrength / $(window).width();
	$('body').mousemove(function(e){
	    var pageX = e.pageX - ($(window).width() / 2);
	    var pageY = e.pageY - ($(window).height() / 2);
	    var newvalueX = width * pageX * -1 -10;
	    var newvalueY = height * pageY * -1 -10;
	    $('#backdrop').css("background-position", newvalueX+"px     "+newvalueY+"px");
	});
})

$(document).on('change','#purpose',function(){
	var selected = $(this).val();
	console.log(selected);
	if(selected == 'temporary'){
		$('#agency_section').fadeIn('slow');
		//$('select[name="temp_agency"]').attr('required');
	}else if(selected == 0){
		$('#agency_section').fadeOut('slow');
		$('#details').fadeOut('slow');
	}else{
		$('#agency_section').fadeOut('slow');
		$('#details').fadeIn('slow');
	}
})

$(document).on('change','#agency',function(){
	var selected = $(this).val();

	if(selected != 0){
		$('#details').fadeIn('slow');
		//$('select[name="temp_agency"]').attr('required');
	}else{
		$('#details').fadeOut('slow');
	}
})

$(document).on('change','#issue',function(){
	var selected = $(this).val();
	$('.items').fadeOut('slow');
	$('#'+selected).fadeIn('fast');
	$('#submit_div').fadeIn('fast');
});