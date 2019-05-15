<script>
$(document).ready(function () 
{
    var table = $('#paypal_datatable').DataTable({
        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
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
            "url": "<?php echo BASE_URL?>admin/paypal/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 270,
                    "title" : "Order ID",
                    "data" : "order_id",
                },
                {
                    "title": "Payer Email",
                    "width": 40,
                    "data" : "payer_mail"
                },
                {
                    "width": 290,
                    "title": "Payment Id",
                    "data": "payment_id"
                },
                {
                    "title": "Subtotal",
                    "width": 100,
                    "data": "subtotal",
                    // "render": function ( data, type, row, meta) {
                    //     return row.product_description.length > 100 ?
                    //         row.product_description.substr( 0, 100 ) +'…' :
                    //         row.product_description;
                    // }
                },
                {
                    "title": "Total",
                    "width": 100,
                    "data": "total"
                    // "render": function ( data, type, row, meta) {
                    //     return row.nutrition_facts.length > 100 ?
                    //         row.nutrition_facts.substr( 0, 100 ) +'…' :
                    //         row.nutrition_facts;
                    // }
                },
                {
                    "title": "Tax",
                    "width": 80,
                    "data": "tax"
                },
                {
                    "width": 90,
                    "title": "Method",
                    "data" : "payment_method"

                },
                {
                    "width": 90,
                    "title": "Status",
                    "data" : "payment_status"

                },
                {
                    "width": 90,
                    "title": "Transaction Date",
                    "data" : "created_time"

                },
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
});
</script>
