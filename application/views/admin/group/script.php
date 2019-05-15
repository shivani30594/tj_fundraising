<style>
.order_size{
    width:70px !important;
}
</style>
<script>
var TableDatatablesManaged = function () {
var initTable1 = function () {
    var table = $('#group_datatable');
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
                "first": "First"
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "<?php echo BASE_URL?>admin/group/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 150,
                    "title": "Group Name",
                    "data": "group_name"
                },
                {
                    "title": "Owner Name",
                    "width": 100,
                    "data": "contact_person"
                },
                {
                    "title": "Method",
                    "width": 90,
                    "data": "delivery_method"
                },
                {
                    "title": "Location",
                    "width": 90,
                    "data": "delivery_location"
                },
                {
                    "title": "Project Start",
                    "width": 110,
                    "data": "project_start"
                },
                {
                    "width": 110,
                    "data": "project_end",
                    "title": "Project End",

                },
                {
                    "title": "Status",
                    "width": 60,
                    "class":"text-center",
                    "render": function(data, type, row, meta)
                    {
                        if (row.is_active == 'Yes')
                        {
                            return "<label class='label label-info'>Active</label>"
                        }
                        else{
                            return "<label class='label label-danger'>In-active</label>"
                        }
                    }
                },
                {
                    "title": "Action",
                    "sortable": false,
                    "overflow": 'visible',
                    "render": function (data, type, row, meta) {
                        var user_id = row.user_id;
                        var view_url = '<?php echo BASE_URL?>admin/group/view/'+row.group_id;
                        var edit_url = '<?php echo BASE_URL?>admin/group/edit/'+row.group_id;
                        var status_change_url = '<?php echo BASE_URL?>admin/group/change_status/'+row.group_id;
                        var leader_board = '<?php echo BASE_URL?>admin/group/leader_board/'+row.group_id;
                        var total_sales = '<?php echo BASE_URL?>admin/group/total_sales/'+row.group_id;
                        if (row.is_active == 'No')
                        {
                            var class_name = 'btn-info';
                            var status = '<i class="fa fa-unlock"></i>';
                        }
                        else{
                            var class_name = 'btn-danger';
                            var status = '<i class="fa fa-lock"></i>'
                        }
                            return '\<a href="' + view_url  + '" class=" m-portlet__nav-link btn btn-primary m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="View">\
                                        <i class="fa fa-eye"></i>\
                                    </a>\
                                    <a href="' + edit_url  + '" class="m-portlet__nav-link btn m-btn btn-warning m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                        <i class="fa fa-pencil"></i>\
                                                </a>\
                                    <a href="' + status_change_url  + '" class="m-portlet__nav-link btn m-btn '+class_name+' m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Active/In-active">\
                                        '+status+'\
                                                </a>\
                                    <a href="'+leader_board+'" class="m-portlet__nav-link btn m-btn btn-success m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="LeaderBoard">\
                                        <i class="fa fa-tree"></i>\
                                    </a>\
                                    <a href="'+total_sales+'" class="m-portlet__nav-link btn m-btn btn-info m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Total number of sales">\
                                        <i class="icon-bar-chart"></i>\
                                    </a>\
                                ';
                        }
                },
               ] , 
        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "columnDefs": [ {
            "targets": 0,
            "orderable": false,
            "searchable": false
        }],

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,            
        "pagingType": "bootstrap_full_number",
        "columnDefs": [{  // set default column settings
            'orderable': false,
            'targets': [0]
        }, {
            "searchable": false,
            "targets": [0]
        }],
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
jQuery(document).ready(function() {
    $("#contact_phone").intlTelInput({
          hiddenInput: "full_number",
          utilsScript: "../../../assets/global/scripts/utils.js"
        });

    $('#edit_group_form').validate({
            rules: {
                group_name : { 
                    required :true,
                },
                address : { 
                    required :true,
                },
                email : { 
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
                email : {
                    required : 'Enter an email ',
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
});
</script>