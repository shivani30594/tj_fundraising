<script>
    jQuery(document).ready(function(){
        var example = $('#orderTable').DataTable({
            responsive: true,
        columnDefs: [{
            orderable: false,
            // className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ],
         lengthMenu: [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        });
        $("#ckbCheckAll").click(function () {
        });

        $(document).on('click', '#select_all', function()
        {
            $(".checkbox_select").prop('checked', $(this).prop('checked'));
            if ($(".checkbox_select").prop('checked'))
            {
                var order_id_array =[] ;
                $('.checkbox_select').each(function () {
                    order_id_array.push($(this).attr("id"));
                });
                // console.log(order_id_array)
                swalCalling(order_id_array);
            }
        })

        $(document).on('click', '.checkbox_select', function()
        {
            swalCalling($(this).attr('id'));
        })

        function swalCalling(order_id_array)
        {
            swal({
                    title: 'Are you sure?',
                    text: "Want to change the status of order",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No',
                    closeOnConfirm: false
                }).then(function (result) {
                    if( result == true){
                        jQuery.ajax({
                            url : '<?php echo BASE_URL?>customer/order/change_status',
                            method: 'post',
                            dataType: 'json',
                            data: {order_id: order_id_array, delivery_option: 'delivered'},
                            success: function(response){
                              if (response.success == true)
                              {
                                swal("success", response.message, "success");
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                              }
                              else
                              {
                                swal("error", response.message, "error");
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                              }
                            }
                        });
                    }
                })
        }

    });
</script>