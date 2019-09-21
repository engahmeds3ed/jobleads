$(document).ready( function () {
    if( $('.datatable').length )
    {
        $('.datatable').each(function(){
            var currentTable = $(this);
            currentTable.DataTable({
                "ajax": currentTable.data('ajaxurl'),
                "searching": false
            });
        });
    }

    $(document).on('click', '.delete', function(){
        var confirmed = confirm("Are you sure that you want to delete this record?");
        if(confirmed){
            var thisButton = $(this);
            $.ajax({
                type: "DELETE",
                url: encodeURI(thisButton.attr('href')),
                headers: {
                    Accept: "application/json; charset=utf-8",
                    "Content-Type": "application/json; charset=utf-8",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(msg){
                    thisButton.parents('tr').remove();
                }
            });
        }
        return false;
    });
} );
