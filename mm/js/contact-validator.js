/**
 *  File contact-validator
 * 
 *  Dynamic form validation
 * 
 */

( function($){
   
    // Confirmation variables for submit button availability
    let nameCon = false;
    let emailCon = false;
    let feedbackCon = false;

    // Checks form values and then activates button for submission
    $('#contact_name').keypress(function(event){
        name_value = event.target.value;
        
        if(name_value.length >= 2){
            $('#contact-name-label').html('Name: <i class="fa fa-check" style="color:#40ff00">');
            nameCon = true;
        } else {
            $('#contact-name-label').html('Name:');
            nameCon = false;
        }
        
        sumbitState(nameCon, emailCon, feedbackCon);
    });

    $('#contact_name').keydown(function(event){
        key = event.key;
        name_value = event.target.value;
        if(key === 'Delete' || key === 'Backspace'){
            if( name_value.length <= 3 ){
                $('#contact-name-label').html('Name:');
                nameCon = false;
            } else {
                $('#contact-name-label').html('Name: <i class="fa fa-check" style="color:#40ff00">');
                nameCon = true;
            }
        }
        sumbitState(nameCon, emailCon, feedbackCon);
    });

    $('#email_input').keydown(function(event){
        pattern = new RegExp(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{1,2}$/);

        
        if(pattern.test(event.target.value)){
            $('#email-input-label').html('Email: <i class="fa fa-check" style="color:#40ff00">');
            emailCon = true;
        } else {
            $('#email-input-label').html("Email:");
            emailCon = false;
        }
        sumbitState(nameCon, emailCon, feedbackCon);
    });

    $('#feedback').keypress(function(event){
        name_value = event.target.value;

        if(name_value.length >=2){
            $('#feedback-label').html('Message: <i class="fa fa-check" style="color:#40ff00">');
            feedbackCon = true;
        } else {
            $('#feedback-label').html("Message:");
            feedbackCon = false
        }
        sumbitState(nameCon, emailCon, feedbackCon);
    });

    $('#feedback').keydown(function(event){
        $key = event.key;
        $name_value = event.target.value;
        if($key === 'Delete' || $key === 'Backspace'){
            $('#feedback-label').html("Message:");
            feedbackCon = false;
        } else {
            $('#feedback-label').html('Message: <i class="fa fa-check" style="color:#40ff00">');
            feedbackCon = true;
        }

        sumbitState(nameCon, emailCon, feedbackCon);
    });

    

    const sumbitState = (nameCon, emailCon, feedbackCon) => {
        if(nameCon && emailCon && feedbackCon){
            $('#submit-button').prop('disabled', false).css({
                'opacity': '1.0',
                'cursor': 'pointer'
            });
        } else {
            $('#submit-button').prop('disabled', true).css({
                'opacity': '0.5',
                'cursor': 'default'
            });
            
        }
    }

})(jQuery);
