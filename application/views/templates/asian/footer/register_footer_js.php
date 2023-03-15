<script type="text/javascript">
  $(function() {
    $( "#datepicker" ).datepicker();
	$.datepicker.setDefaults({
	  showOn: "both",
	  buttonImageOnly: true,
	  buttonImage: "calendar.gif",
	  buttonText: "Calendar"
	});	
  });
  
  $("#reg-height-slider").ionRangeSlider({
				type: "single",
				step: 1,
				postfix: " cm",
				from: <?php echo $reg_height;?>,
				hideMinMax: true,
				hideFromTo: false
			});

  $("#reg-weight-slider").ionRangeSlider({
				type: "single",              
				step: 1,                    
				postfix: " kg",
				from: <?php echo $reg_weight;?>,
				hideMinMax: true, 
				hideFromTo: false
			});

</script>		