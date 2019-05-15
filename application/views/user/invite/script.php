<script>
    
    var copy = function(elementId) {

        var input = document.getElementById(elementId);
        var isiOSDevice = navigator.userAgent.match(/ipad|iphone/i);

        if (isiOSDevice) {
        
            var editable = input.contentEditable;
            var readOnly = input.readOnly;

            input.contentEditable = true;
            input.readOnly = false;

            var range = document.createRange();
            range.selectNodeContents(input);

            var selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);

            input.setSelectionRange(0, 999999);
            input.contentEditable = editable;
            input.readOnly = readOnly;

        } else {
            input.select();
        }

        document.execCommand('copy');
}

  
    $(document).ready(function(){

        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="tg-in" id="email"><div class="tg-input-grp"><label for="tg-email"></label><input type="email" name="email[]" class="tg-input"><a href="javascript:void(0);" class="remove_button" id="remove-btn">Remove</a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        $(addButton).click(function(){
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });


         $('#customer_invite_form').validate({
            rules: {
                subject : { 
                    required :true,
                },
                message : { 
                    required :true,
                },
                'email[]' : { 
                    required :true,
                },
            },
            messages: {
                subject : {
                    required : 'Enter subject ',
                },
                message : {
                    required : 'Enter message ',
                },
                'email[]' : {
                    required : 'Enter email',
                },
            }
        });

    });

</script>