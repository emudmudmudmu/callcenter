@if($jquery)
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endif

<script type="text/javascript">
<!--

	var brickScript = {

		keys: [], 
		specialKeys: {16: 'SHIFT', 17: 'CTRL', 18: 'ALT'}, 
		currentSpecialKey: 0, 
		input: function(keycode) {

			if(!brickScript.isSpecificKeys(keycode)) {

				return false;

			}
				
			$.each($(':text,textarea'), function(index, input){
		
			    var id = $(input).attr('id');
		
			    $.each($('label'), function(index2, label){
		
			    	var labelFor = $(label).attr('for');
		
			    	if(id == labelFor) {
		
			    		var text = '';

				    	if(brickScript.as.hasOwnProperty(id)) {

				    		id = brickScript.as[id];

				    	}
			    		
		    			if(id == 'email') {
			    			
			    			text = 'test'+ $.now() +'@example.com';
			    			
			    		} else if(id == 'url' || id == 'link') {
			    			
			    			text = 'http://test'+ $.now() +'.example.com';
			    			
			    		} else if(id == 'password') {
			    			
			    			text = $.now();
			    			
			    		} else if(id == 'age') {
			    			
			    			text = brickScript.randomNumber();
			    			
			    		} else {
			    			
			    			text = $(label).text();
			    			
			    		}
						
						$(input).val($.trim(text));
			    		
			    	}
		
			    });
		
			});

			$.each($('select'), function(index, select){

				var values = $(select).find('option').map(function() { return $(this).val(); });

				if(values.length > 1) {

					var randomNumber = Math.floor( Math.random() * (values.length-1)+1);

				}

				$(select).val(values[randomNumber]);
				
			});

			$.each($(':radio'), function(index, radio){
				
				if(brickScript.randomNumber()%2 == 0) {

					$(radio).prop('checked', true);

				}
				
			});

			$.each($(':checkbox'), function(index, checkbox){
				
				if(brickScript.randomNumber()%2 == 0) {
			
					$(checkbox).prop('checked', true);

				}
				
			});
		
		}, 

		isSpecificKeys: function(keycode) {

			if(brickScript.isSpecialKey(keycode)) {
				
				brickScript.setCurrentSpecialKey(keycode);
				return false;

			}
			
			return (brickScript.specialKeys[brickScript.currentSpecialKey] == brickScript.keys[0] 
						&& String.fromCharCode(keycode) == brickScript.keys[1]);

		}, 

		isSpecialKey: function(keycode) {

			return (keycode >= 16 && keycode <= 18);

		}, 
		
		setCurrentSpecialKey: function(keycode) {

			brickScript.currentSpecialKey = keycode;

		}, 

		randomNumber: function() {

			return Math.floor( Math.random() * (100 - 1 + 1) ) + 1;

		}
	
	};

	$(document).ready(function(){

		brickScript.keys = {{ json_encode($keys) }};
		brickScript.as = {{ json_encode($as) }};
		
		$(window).keydown(function(e){
			
			brickScript.input(e.keyCode);
		
		});
		
		$(window).keyup(function(e){
			
			brickScript.setCurrentSpecialKey(0);
		
		});
	
	});

//-->
</script>