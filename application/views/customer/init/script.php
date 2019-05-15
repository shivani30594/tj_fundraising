<script>
$(document).ready(function (){

    var dateToday = new Date();
        var dates = $("#delivery_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: dateToday,
            onSelect: function(selectedDate) {
                var option = this.id == "project_start" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });


    $("#cust_phone").intlTelInput({
          hiddenInput: "full_number",
          utilsScript: "<?php echo ASSETS.'global/scripts/utils.js' ?>"
        });

    var cart = {};
    cart.products = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    $('#customer_form').validate({
            rules: {
                cust_first_name : { 
                    required :true,
                },
                cust_last_name : { 
                    required :true,
                },
                cust_email : { 
                    required :true,
                },
                cust_address : { 
                    required :true,
                },
                cust_phone : { 
                    required :true,
                },
                shipping : { 
                    required :true,
                },
                agreement : { 
                    required :true,
                },
            },
            messages: {
                cust_first_name : {
                    required : 'Enter a First name ',
                },
                cust_last_name : {
                    required : 'Enter a Last name ',
                },
                cust_email : {
                    required : 'Enter Email ',
                },
                cust_address : {
                    required : 'Enter Address',
                },
                cust_phone : {
                    required : 'Enter Phone',
                },
                shipping : {
                    required : 'Select delievery method',
                },
                agreement : {
                    required : 'Please check the aggreement',
                },
            }
        });

        $(document).on('change', "#shipping", function(){
            if ($(this).val() == 'pickup' || $(this).val() == 'delivered_sales')
            {
                $("#delivery-date").show();
            }
            else{
                $("#delivery-date").hide();
            }
        });

        $(document).on('change', "#shipping", function(){
            if ($(this).val() == 'delivered_fedex' || $(this).val() == 'delivered_sales')
            {
                $("#address-div").show();
            }
            else{
                $("#address-div").hide();
            }
        });
});
</script>