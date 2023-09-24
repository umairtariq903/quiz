 jQuery(document).ready(function($){
	 $( '#quiz' ).hide();
	 $('#results').hide();
	 //Submit User Name Functionality
	 jQuery('#submit').click(function () {
	    
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	        }
	    });
	 
	    var formData = {
	        name: jQuery('#name').val(),
	        question:1,
	    };

	    var type = "POST";
	    var ajaxurl = 'showQuiz';
	    $.ajax({
	        type: type,
	        url: ajaxurl,
	        data: formData,
	        dataType: 'json',
	        success: function (data) {
	        	$(this).displayVals(data);
	        },
	        error: function (data) {
	            console.log(data);
	        }
	    });
	});

	jQuery('#next').click(function () {
	    
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    var selectedanswer =$('input[name="options"]:checked').val();  
	    if(typeof selectedanswer === "undefined"){
	    	alert('please select 1 option');
	    }
	    else{
		    	
	    		var formData = {
			        answer: selectedanswer,
			        question:jQuery('#question_number').val(),
			    };

			    var type = "POST";
			    var ajaxurl = 'nextQuestion';
			    $.ajax({
			        type: type,
			        url: ajaxurl,
			        data: formData,
			        dataType: 'json',
			        success: function (data) {
			        	if (Array.isArray(data) && data.length){
			        		$(this).displayVals(data);	
			        	}
			        	else{
			        		$(this).displayResult();	
			        	}
			        	
			        },
			        error: function (data) {
			            console.log(data);
			        }
			    });	
	    }   
	});

	jQuery('#skip').click(function () {
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    
    	var formData = {
	        question:jQuery('#question_number').val(),
	    };

	    var type = "POST";
	    var ajaxurl = 'skipQuestion';
	    $.ajax({
	        type: type,
	        url: ajaxurl,
	        data: formData,
	        dataType: 'json',
	        success: function (data) {
	        	if (Array.isArray(data) && data.length){
	        		$(this).displayVals(data);	
	        	}
	        	else{
	        		$(this).displayResult();	
	        	}
	        },
	        error: function (data) {
	            console.log(data);
	        }
	    });
	      
	}); 

	$.fn.displayVals = function(data) {
		$( '#welcome' ).hide();
		$( '#quiz' ).show();
    	$('#question').text(data[0]['question']);
    	$('#question_number').val(data[0]['id']);
        $.each(data[0]['answers'], function (key, val) {
			updatedKey = key +1;		    
	        $('#op'+updatedKey).text(val['answer']);
	        $('#op'+updatedKey+'_input').attr('checked',false).val('');
	        $('#op'+updatedKey+'_input').val(val['answer']);
	        
	    });
	};

	$.fn.displayResult = function() {
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    
    	var formData = {
	    };

	    var type = "GET";
	    var ajaxurl = 'getResult';
	    $.ajax({
	        type: type,
	        url: ajaxurl,
	        data: formData,
	        dataType: 'json',
	        success: function (data) {
	        	$('#quiz').hide();
	        	$('#results').show();
	        	$('#user').text(data['username']);
	        	$('#correct').text(data['correct_ans']);
	        	$('#wrong').text(data['wrong_ans']);
	        	$('#skipped').text(data['skip_ans']);
	        },
	        error: function (data) {
	            console.log(data);
	        }
	    });		
	};

}); 