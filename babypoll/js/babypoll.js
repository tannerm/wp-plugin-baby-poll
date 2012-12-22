jQuery(document).ready(function(){
	
	(function($){
		
		$( ".datepicker" ).datepicker();
		$( ".timepicker" ).timepicker({
			showPeriod: true,
		    showLeadingZero: true
		});
		//$( ".spinner" ).timespinner();

		$( "#babypoll_weight_lb, #babypoll_weight_oz").change(function(){
			$( "#babypoll_weight" ).val($( "#babypoll_weight_lb" ).val() + $( "#babypoll_weight_oz" ).val());
		})


	})(jQuery);
	
});