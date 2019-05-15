<script>
$(document).ready(function () 
{
    var table = $('#commission_datatable').DataTable({
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
            "url": "<?php echo BASE_URL?>admin/commission/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 300,
                    "title" : "Group Name",
                    "data" : "group_name",
                    "class" : "text-center",

                },
                {
                    "title": "Ratio",
                    "width": 100,
                    "class" : "text-center",

                    // "data": "commission_ratio"
                    "render": function ( data, type, row, meta) {
                        if(row.commission_ratio == '0')
                        {
                            return '70/30';
                        }
                        else{
                            return '60/40';
                        }
                    }
                },
                {
                    "width": 110,
                    "title": "Total",
                    "data": "total_amount",
                    "class" : "text-center",

                },
                {
                    "title": "Owner Comm.",
                    "width": 140,
                    "data": "owner_comm",
                    "class" : "text-center",

                    // "render": function ( data, type, row, meta) {
                    //     return row.product_description.length > 100 ?
                    //         row.product_description.substr( 0, 100 ) +'…' :
                    //         row.product_description;
                    // }
                },
                {
                    "title": "Fundraiser Comm.",
                    "width": 140,
                    "data": "fundraiser_comm",
                    "class" : "text-center",

                    // "render": function ( data, type, row, meta) {
                    //     return row.nutrition_facts.length > 100 ?
                    //         row.nutrition_facts.substr( 0, 100 ) +'…' :
                    //         row.nutrition_facts;
                    // }
                },
                {
                    "title": "Status",
                    "width": 110,
                    "class" : "text-center",
                    "render": function ( data, type, row, meta) {
                       if (row.status == 'pending')
                       {
                           return "<span class='label label-danger'>Pending</span>"
                       }
                       else
                       {
                            return "<span class='label label-success'>Paid</span>"
                       }
                    }
                },
                {
                    "width": 190,
                    "title": "Calculated At",
                    "data" : "created",
                    "class" : "text-center",


                },
                {
                    "width": 190,
                    "title": "Paid At",
                    "data" : "updated",
                    "class" : "text-center",


                },
                {
                    "title": "Action",
                    "width": 140,
                    "sortable": false,
                    "overflow": 'visible',
                    "class":"text-center",
                    "render": function (data, type, row, meta) {
                        if (row.status == 'paid')
                        {
                            var class_name = "disabled";
                        }
                        return '<button '+class_name+' data-commissionid = "'+row.commission_id+'" id="delete_btn" class="m-portlet__nav-link btn m-btn btn-primary m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                    <i class="fa fa-edit"></i>\
                                            </button>\
                            ';
                    }
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

     $(document).on('click', '#delete_btn', function() {
        var commissionid = $(this).attr("data-commissionid");
        swal({
            title: 'Are you sure?',
            text: "You would like to mark this as 'paid'",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Mark as Paid!',
            cancelButtonText: 'No',
            closeOnConfirm: false
        }).then(function (result) {
            if( result == true){
                jQuery.ajax({
                    url : '<?php echo BASE_URL?>admin/commission/change_status',
                    method: 'post',
                    dataType: 'json',
                    data: {commission_id: commissionid},
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
    });
});
</script>