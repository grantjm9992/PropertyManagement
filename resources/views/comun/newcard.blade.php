<script>
    $(document).ready( function()
    {
        var sortables = $('.cc-sortable');
        var id = $(sortables[sortables.length - 1]).attr('data-id');
        $('[divid="'+id+'"]').click();
    })
</script>