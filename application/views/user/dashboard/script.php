<script>
    $(document).on('change', 'input[type="radio"]', function() {
        var selValue = $('input[name=status]:checked').val();
        if (selValue == 'group')
        {
            $("#group_active").show();
            $('#active_group').prop('required',true);
        }
        else{
            $('#active_group').removeAttr('required');
            $("#group_active").hide();
        }
    })


</script>
