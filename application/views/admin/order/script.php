<style>
.order_size{
    width:250px !important;
}
</style>
<script>
$(document).ready(function () 
{
    var table = $('#order_datatable').DataTable({
        // Internationatdsation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No data available in table",
            "info": "Showing _START_ to _END_ of _TOTAL_ records",
            "infoEmpty": "No records found",
            "infoFiltered": "(filtered1 from _MAX_ total records)",
            "lengthMenu": "Show _MENU_",
            "search": "Search:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "previous":"Prev",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "<?php echo BASE_URL?>admin/order/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 200,
                    "class":"order_size",
                    "title" : "Order ID",
                    "data" : "order_id",
                },
                {
                    "width": 90,
                    "class":"text-center",
                    "title" : "Customer Name",
                    "data" : "customer_name",
                },
                {
                    "title": "Order Description",
                    "width": 280,
                    // "data" : "order_details",
                    "render": function ( data, type, row, meta) {
                        var data = JSON.parse(row.order_details);
                        var html = '';
                        html += '<table class="table table-striped"  style="width: 100%;"><thead><tr><th width="30%">Name</th><th width="15%">Price</th><th width="15%">Quantity</th></tr></thead><tbody>';

                        $.each( data, function( key, value ) {
                            html += "<tr><td >"+value.name+"</td>";
                            html += "<td width='90px'>"+value.price+"$</td>";
                            html += "<td width='60px'>"+value.qty+"</td></tr>";
                        });
                        html += '</tbody></table>';
                        return html;
                    }
                },
                {
                    "width": 10,
                    "class":"text-center",
                    "title": "Total",
                    "data": "order_total"
                },
                {
                    "width": 10,
                    "title": "Delivery ",
                    // "data": "delivery_option"
                    "render": function (data, type, row, meta) {
                        var str = (row.delivery_option).split('_').join(' ');
                        return str.charAt(0).toUpperCase() + str.slice(1);;
                    }
                },
                {
                    "width": 10,
                    "class":"text-center",
                    "title": " Quantity",
                    "data": "order_quantity",
                },
                {
                    "title": "Status",
                    "width": 250,
                    // "data": "order_status",
                    "render": function (data, type, row, meta) {
                        if (row.order_status == 'cancel' || row.order_status == 'delivered')
                        {
                            var prop_name = "disabled";
                        }
                        else
                        {
                            var prop_name = '';
                        }

                        if (row.delivery_option == 'pickup')
                        {
                            var $select = $("<select class='form-control order_status' "+prop_name+" name='order_status' id="+row.order_id+"><option value=''>--Select--</option><option value='pending'>Pending</option><option value='delivered'>Delivered</option><option value='cancel'>Cancel</option></select>");
                        }
                        else{
                            var $select = $("<select class='form-control order_status' "+prop_name+" name='order_status' id="+row.order_id+"><option value=''>--Select--</option><option value='pending'>Pending</option><option value='shipped'>Shipped</option><option value='delivered'>Delivered</option><option value='cancel'>Cancel</option></select>");
                        }
                        $select.find('option[value="'+row.order_status+'"]').attr('selected', 'selected');
                        return $select[0].outerHTML;
                                 
                    }
                },
                {
                    "title": "Order Date",
                    "width": 80,
                    "data": "order_date"
                },
                {
                    "width": 90,
                    "title": "Delivery Date",
                    "data" : "delivery_date"

                },
                // {
                //     "title": "Action",
                //     "width": 250,
                //     "sortable": false,
                //     "overflow": 'visible',
                //     "render": function (data, type, row, meta) {
                //         var view_url = "<?php echo BASE_URL?>a_product_info/"+row.id;
                //         return '<a href="'+view_url+'" class="m-portlet__nav-link btn m-btn btn-info m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                //                     <i class="fa fa-eye"></i>\
                //                             </a>\
                //                 ';
                //     }
                // },
               ] , 
        "columnDefs": [ {
            "targets": 0,
            "orderable": false,
            "searchable": false
        }],
        "pageLength": 5,  
        "pagingType": "bootstrap_full_number",
        "order": [
            [1, "asc"]
        ] // set first column as a default sort by asc
    });

    $(document).on('change', ".order_status", function(e)
    {
        var order_id = e.target.id;
        var delivery_option =  $(this).val();
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
                            url : '<?php echo BASE_URL?>admin/order/change_status',
                            method: 'post',
                            dataType: 'json',
                            data: {order_id: order_id, delivery_option: delivery_option},
                            success: function(response){
                              if (response.success == true)
                              {
                                table.ajax.reload();
                                swal("success", response.message, "success");
                              }
                              else
                              {
                                table.ajax.reload();
                                swal("error", response.message, "error");
                              }
                            }
                        });
                    }
                })
        // swal({
        //     title: 'Are you sure want to change the status?',
        //     text: "You would like to delete this record.",
        //     type: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, delete it!',
        //     cancelButtonText: 'No',
        //     // closeOnConfirm: false
        // }).then(function (result) {
        //     if( result == true ){
        //         jQuery.ajax({
        //             url : '<?php echo BASE_URL?>admin/order/change_status',
        //             method: 'post',
        //             dataType: 'json',
        //             data: {delivery_option: $(this).val(), order_id:'ORD5466574'},
        //             success: function(response){
        //                 if (response.success == true)
        //                 {
        //                     table.ajax.reload();
        //                     swal("success", response.message, "success");
        //                 }
        //                 else
        //                 {
        //                     table.ajax.reload();
        //                     swal("error", response.message, "error");
        //                 }
        //             }
        //         });
        //     }
        // })
    });
});
</script>