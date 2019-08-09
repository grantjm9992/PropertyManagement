<div class="row" id="contacts">
    {!! $contacts !!}
</div>

<script>
    $(document).ready( function() {
        var list = $('#contacts').grantnate();
        list.init();

        nextPage = function()
        {
            list.nextPage();
        }

        prevPage = function()
        {
            list.prevPage();
        }        
    })


</script>