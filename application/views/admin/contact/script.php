<script>
$(document).ready(function () 
{
    var table = $('#contact_datatable').DataTable({
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
            "url": "<?php echo BASE_URL?>admin/contact/indexjson",
            "dataType": "json",
            "type": "POST",
            },
            "columns": [
                {
                    "width": 50,
                    "title" : "#",
                    "render" : function(){
                        return "#";
                    }
                },
                {
                    "title": "Email",
                    "width": 150,
                    "data": "email_id"
                       
                },
                {
                    "width": 140,
                    "title": "Subject",
                    "data": "subject"
                },
                {
                    "title": "Message",
                    // "data": "product_description",
                    "data": "message"
                       
                },
                {
                    "title": "Action",
                    "width": 100,
                    "sortable": false,
                    "overflow": 'visible',
                    "class":"text-center",
                    "render": function (data, type, row, meta) {
                        var view_url = "<?php echo BASE_URL?>a_respond/"+row.id;
                        return '<a data-id='+row.id+' data-subject="'+row.subject+'" data-toggle="modal" data-target="#myModal" class="open-AddBookDialog m-portlet__nav-link btn m-btn btn-info m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">\
                                    <i class="fa fa-reply"></i>\
                                            </a>\
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




    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     var subject = $(this).data('subject');
     $(".modal-body #contact_id").val( myBookId );
     $("#subject").text( subject );

     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
    });
});
</script>