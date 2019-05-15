<script src="<?php echo ASSETS ?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS ?>pages/scripts/profile.min.js"></script><!--bootstrap validation js-->
<script src="<?php echo ASSETS ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script>
var TableDatatablesManaged = function () {
var initTable1 = function () {
    var table = $('#user_datatable');
    // begin first table
    table.dataTable({
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
                "first": "First",
                "page": "Page",
                "pageOf": "of"
            }
        },
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        "processing": true,
        "serverSide": true,
        "serverPaging": true,
        "pagination": true,
        "ajax":{
            "url": "<?php echo BASE_URL?>admin/user/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 200,
                    "title" : "Profile",
                    "render": function ( data, type, row, meta) {
                      return '<img src="'+row.picture+'" class="img" heigth="80px" width="80px">';
                    }
                },
                {
                    "width": 100,
                    "class":'text-center',
                    "title" : "First Name",
                    "data" : "first_name",
                },
                {
                    "width": 100,
                    "class":'text-center',
                    "title": "Last Name",
                    "data": "last_name"
                },
                {
                    "title": "Email",
                    "width": 150,
                    "class":'text-center',
                    "data": "email"
                },
                {
                    "title": "Type",
                    "width": 200,
                    "class":'text-center',
                    "render": function ( data, type, row, meta) {
                        return "<label class='label label-info'>"+row.status+"</span>"
                    }
                },
                {
                    "title": "Status",
                    "width": 100,
                    "data": "is_status",
                    "class":'text-center',
                    "render": function ( data, type, row, meta) {
                        if (row.is_active == 'Yes')
                        {
                            return "<span class='label label-sm label-success'> Active </span>";
                        }
                        else{
                            return "<span class='label label-sm label-danger'> In-Active </span>";
                        }
                    }
                },
                {
                    "title": "Action",
                    "sortable": false,
                    "overflow": 'visible',
                    "render": function (data, type, row, meta) {
                        var user_id = row.user_id;
                        var view_url = '<?php echo BASE_URL?>admin/user/view/'+row.user_id;
                        var edit_url = '<?php echo BASE_URL?>admin/user/edit/'+row.user_id;
                        var status_change_url = '<?php echo BASE_URL?>a_chgstatus/'+row.user_id;
                        if (row.is_active == 'No')
                        {
                            var class_name = 'btn-info';
                            var status = '<i class="fa fa-unlock"></i>';
                        }
                        else{
                            var class_name = 'btn-danger';
                            var status = '<i class="fa fa-lock"></i>'
                        }
                            return '\<a href="' + view_url  + '" class="open-viewUserDialog m-portlet__nav-link btn btn-primary m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View">\
                                        <i class="fa fa-eye"></i>\
                                    </a>\
                                    <a href="' + edit_url  + '" class="m-portlet__nav-link btn m-btn btn-warning m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                        <i class="fa fa-pencil"></i>\
                                                </a>\
                                    <a href="' + status_change_url  + '" class="m-portlet__nav-link btn m-btn '+class_name+' m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Active/In-active">\
                                        '+status+'\
                                                </a>\
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

       "bStateSave": true,

        // set the initial value
        "pageLength": 5,  
        "paging": true,          
        "pagingType": "bootstrap_full_number",
        "order": [
            [1, "asc"]
        ] // set first column as a default sort by asc
    });

}

return {
    //main function to initiate the module
    init: function () {
        if (!jQuery().dataTable) {
            return;
        }
        initTable1();
    }
};
}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}

$(document).ready(function () 
{

    $('#edit_user_from').validate({
          rules: {
              first_name : { 
                  required :true,
              },
              last_name : { 
                  required :true,
              },
              email : { 
                  required :true,
              },
              status : { 
                  required :true,
              }
          },
          messages: {
            first_name : {
                 required : 'Please enter first name',
              },
              last_name : {
                 required : 'Please enter last name',
              },
              email : {
                 required : 'Please enter email',
              },
              status : {
                 required : 'Please select status',
              }
          }
    });

});
</script>
