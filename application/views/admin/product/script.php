<script>
$(document).ready(function () 
{
    var table = $('#product_datatable').DataTable({
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
            "url": "<?php echo BASE_URL?>admin/product/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 130,
                    "title" : "UPC/SKU",
                    "data" : "product_sku",
                },
                {
                    "title": "Image",
                    "width": 100,
                    "render": function ( data, type, row, meta) {
                      return '<img src="<?php echo ASSETS.'uploads/products/'?>'+row.product_image+'" class="img" heigth="100px" width="100px">';
                    }
                },
                {
                    "width": 140,
                    "title": "Name",
                    "data": "product_name"
                },
                {
                    "title": "Description",
                    "width": 340,
                    // "data": "product_description",
                    "render": function ( data, type, row, meta) {
                        return row.product_description.length > 100 ?
                            row.product_description.substr( 0, 100 ) +'…' :
                            row.product_description;
                    }
                },
                {
                    "title": "Nutrition Facts",
                    "width": 340,
                    // "data": "nutrition_facts"
                    "render": function ( data, type, row, meta) {
                        return row.nutrition_facts.length > 100 ?
                            row.nutrition_facts.substr( 0, 100 ) +'…' :
                            row.nutrition_facts;
                    }
                },
                {
                    "title": "Price",
                    "width": 80,
                    //"data": "product_price"
                     "render": function ( data, type, row, meta) {
                        return row.product_price+"$";
                    }
                },
                {
                    "width": 90,
                    "title": "Stock",
                    "data" : "product_stock"

                },
                {
                    "title": "Action",
                    "width": 250,
                    "sortable": false,
                    "overflow": 'visible',
                    "render": function (data, type, row, meta) {
                        var view_url = "<?php echo BASE_URL?>a_product_info/"+row.product_id;
                        var edit_url = "<?php echo BASE_URL?>admin/product/add/"+row.product_id;
                        return '<a href="'+view_url+'" class="m-portlet__nav-link btn m-btn btn-info m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                    <i class="fa fa-eye"></i>\
                                            </a>\
                                <a href="'+edit_url+'" class="m-portlet__nav-link btn m-btn btn-success m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                    <i class="fa fa-pencil"></i>\
                                            </a>\
                                <button data-productid = "'+row.product_id+'" id="delete_btn" class="m-portlet__nav-link btn m-btn btn-danger m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                    <i class="fa fa-trash"></i>\
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

    $('#add_product_from').validate({
          rules: {
            product_name : { 
                  required :true,
              },
              product_description : { 
                  required :true,
              },
              category_id : { 
                  required :true,
              },
              product_price : { 
                  required :true,
              },
              product_stock : { 
                  required :true,
              },
              nutrition_facts : {
                  required: true
              }
          },
          messages: {
            product_name : {
                 required : 'Please enter product name',
              },
              product_description : {
                 required : 'Please enter description',
              },
              category_id : {
                 required : 'Please select category',
              },
              product_price : {
                 required : 'Please enter valid price',
              },
              product_stock : {
                 required : 'Please enter valid stock quantity',
              },
              nutrition_facts : {
                  required: 'Please enter nutrition facts',
              }
          }
    });

     $(document).on('click', '#delete_btn', function() {
             var product_id = $(this).attr("data-productid");
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
                            url : '<?php echo BASE_URL?>admin/product/delete',
                            method: 'post',
                            dataType: 'json',
                            data: {product_id: product_id},
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