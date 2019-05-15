<script>
 jQuery(document).ready(function() {
    // begin first table
    var table = $('#category_datatable').DataTable({
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
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "<?php echo BASE_URL?>admin/category/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 140,
                    "title": "category_image",
                    "render": function ( data, type, row, meta) {
                      return '<img src="<?php echo ASSETS.'uploads/catgeory/'?>'+row.category_image+'" class="img" heigth="80px" width="80px">';
                    }
                },
                {
                    "title": "category_name",
                    "width": 140,
                    "data": "category_name"
                },
                {
                    "title": "category_description",
                    "width": 340,
                    "data": "category_description"
                },
                {
                    "title": "Action",
                    "width": 140,
                    "sortable": false,
                    "overflow": 'visible',
                    "class":"text-center",
                    "render": function (data, type, row, meta) {
                        var category_id = row.category_id;
                        var edit_url = '<?php echo BASE_URL?>admin/category/edit/'+row.category_id;
                        if (row.is_active == 'No')
                        {
                            var class_name = 'btn-info';
                            var status = '<i class="fa fa-unlock"></i>';
                        }
                        else{
                            var class_name = 'btn-danger';
                            var status = '<i class="fa fa-lock"></i>'
                        }
                            return '<a href="' + edit_url  + '" class="m-portlet__nav-link btn m-btn btn-success m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                        <i class="fa fa-pencil"></i>\
                                                </a>\
                                    <button id="delete_btn" data-categoryid = "'+row.category_id+'" class="m-portlet__nav-link btn m-btn btn-danger m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                                        <i class="fa fa-trash"></i>\
                                                </button>\
                                ';
                        }
                },
               ] , 
        //"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "columnDefs": [ {
            "targets": 0,
            "orderable": false,
            "searchable": false
        }],

       
        // set the initial value
        "pageLength": 5,  
        // "paging": true,          
        "pagingType": "bootstrap_full_number",
        "order": [
            [1, "asc"]
        ] // set first column as a default sort by asc
    });

    $(document).on('click', '#delete_btn', function() {
        var category_id = $(this).attr("data-categoryid");
        swal({
            title: 'Are you sure?',
            text: "You would like to delete this record.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No',
            closeOnConfirm: false
        }).then(function (result) {
            if( result == true){
                jQuery.ajax({
                    url : '<?php echo BASE_URL?>admin/category/delete',
                    method: 'post',
                    dataType: 'json',
                    data: {category_id: category_id},
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