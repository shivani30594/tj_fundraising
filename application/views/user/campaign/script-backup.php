<script type="text/javascript">
    jQuery(document).ready(function()
    {
        $("#contact_phone").intlTelInput({
          hiddenInput: "full_number",
          utilsScript: "../../assets/global/scripts/utils.js"
        });
        $('#create_campaign_form').validate({
            rules: {
                group_name : { 
                    required :true,
                },
                address : { 
                    required :true,
                },
                project_start : { 
                    required :true,
                },
                project_end : { 
                    required :true,
                },
                delivery_method : { 
                    required :true,
                },
                delivery_location : { 
                    required :true,
                },
                delivery_location : { 
                    required :true,
                },
                contact_phone : { 
                    required :true,
                },
                contact_person : { 
                    required :true,
                },
                // disclaimers : {
                //     required :true,
                // }
            },
            messages: {
                group_name : {
                    required : 'Enter a group name ',
                },
                address : {
                    required : 'Enter an address ',
                },
                project_start : {
                    required : 'Select project start-date ',
                },
                project_end : {
                    required : 'Select project end-date',
                },
                delivery_method : {
                    required : 'Select delivery method',
                },
                delivery_location : {
                    required : 'Enter delivery location',
                },
                contact_phone : {
                    required : 'Enter valid contact number',
                },
                contact_person : {
                    required : 'Enter a contact name',
                },
                // disclaimers : {
                //     required : 'Please read the disclaimers carefully',
                // },
            }
        });
         $(document).on('click', '#same_address', function() {
             if (this.checked)
             {
                 var address = $("#address").val();
                 $("#delivery_location").val(address);
                 $("#delivery_location-error").hide();
             }
             else{
                $("#delivery_location").val('');
             }
         });
         $(document).on('change', '#tax_document', function() {
                var val = this.value;
                var fileName = val.substr(val.lastIndexOf("\\")+1, val.length);
                document.getElementById("tax_document_name").value = fileName;
         });
         $(document).on('change', '#delivery_location', function() {
             if (this.value != '')
             {
                 $("#delivery_location-error").hide();
             }
        });
    });
</script>