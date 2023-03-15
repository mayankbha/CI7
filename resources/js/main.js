$(document).ready(function(){

    $( '.editor-ck' ).ckeditor();

    $('#modal-after-login').modal({
        show: true
    });

    // Show Hide Specific function
    // ===========================
    $(':radio[name=payment]').change(function(){ 
        $('#cc-frm').toggle();
    });

    $('.send-by-addr').click(function(){ 
        $('#send-by-addr').show();
        $('#send-by-id').hide();
    });

    $('.send-by-id').click(function(){ 
        $('#send-by-id').show();
        $('#send-by-addr').hide();
    });

    $('.payment-cc').click(function(){ 
        $('#payment-cc').show();
        $('#payment-paypal').hide();
    });

    $('.payment-paypal').click(function(){ 
        $('#payment-paypal').show();
        $('#payment-cc').hide();
    });

     $('.show-chat-btn').click(function(){ 
        $('.chat-box').show();
    });

     $('.hide-chat-btn').click(function(){ 
        $('.chat-box').hide();
    });

    // Memberlist Slider
    // ==================
    jQuery("#owl-Related").owlCarousel({
        items: 5,
        lazyLoad: true,
        navigation: true
    });

    jQuery(".member-slider").owlCarousel({
        items: 5,
        lazyLoad: true,
        navigation: true,
        responsive: true
    });

    jQuery(".prod-img-slider").owlCarousel({
        items: 4,
        lazyLoad: true,
        navigation: true,
        responsive: true
    });

	$('a,button').tooltip({html:true});	

	$('a[rel=popover]').popover({html:true}).click(function () {
		return false
	});

	$('.dropdown-toggle').dropdown();
	$('#datepicker').datepicker();

    $('#advanced-search').hide();
    $('.advanced-search-btn').click(function(){ 
        $('#advanced-search').toggle();
    });
    
});

$("#age-slider").ionRangeSlider({
    from: 20,                    
    to: 30,                     
    type: "double",              
    step: 1,
    hideMinMax: true,                      
    postfix: ""
});

$("#height-slider").ionRangeSlider({
    from: 150,                    
    to: 180,                     
    type: "double",              
    step: 1,
    hideMinMax: true,                      
    postfix: " cm"
});

$("#weight-slider").ionRangeSlider({
    from: 50,                    
    to: 70,                     
    type: "double",
    hideMinMax: true,              
    step: 1,                      
    postfix: " kg"
});

$(".single-filter").ionRangeSlider({
    min: 10,                        
    max: 100,                       
    from: 50,                      
    to: 100,                         
    type: "single",                 
    step: 1,                       
    postfix: " %",             
    hasGrid: true,
    hideMinMax: true,                
    prettify: true
});

var updateSliderScale;
$(window).resize(function(){
    clearTimeout(updateSliderScale);
    updateSliderScale = setTimeout(function(){
        $("#age-slider,#height-slider,#weight-slider-slider,.single-filter").ionRangeSlider('update');
    }, 100);
});

