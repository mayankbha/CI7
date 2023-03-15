<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */


$(function () {

		$("#match_height-sliders").ionRangeSlider({
			from: <?php echo $height_range_default[0];?>,                    
			to: <?php echo $height_range_default[1];?>,                     
			type: "double",              
			step: 1,
			hideMinMax: true,                      
			postfix: "cm"
		});
		
		
		$("#match_weight-sliders").ionRangeSlider({
			from: <?php echo $weight_range_default[0];?>,                    
			to: <?php echo $weight_range_default[1];?>,                     
			type: "double",              
			step: 1,
			hideMinMax: true,                      
			postfix: "kg"
		});
		
		
		/*$("#match_weight-sliders").ionRangeSlider({
			min: 1000000,
    		max: 100000000,
    		type: "double",
    		postfix: " pounds",
			from: <?php echo $weight_range_default[0];?>,                    
			to: <?php echo $weight_range_default[1];?>,                     
			type: "double",              
			step: 10000,
			hideMinMax: true,                 
			postfix: "pounds"
		});*/
		
		/*$("#example_8").ionRangeSlider({
			min: 1000000,
			max: 100000000,
			type: "double",
			postfix: " pounds",
			step: 10000,
			from: 25000000,
			to: 35000000,
			onChange: function(obj) {
				console.log(obj);
			},
			onLoad: function(obj) {
				console.log(obj);
			}
		});*/
		
		

});
</script>	