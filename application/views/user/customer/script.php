<script src="<?php echo ASSETS ?>global/scripts/multiple-emails.js"></script>
<script>
       jQuery(document).ready(function(){
        let example = $('#orderTable').DataTable({
            responsive: true,
        columnDefs: [{
            // orderable: false,
            // className: 'select-checkbox',
            // targets: 0
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
    });
</script>