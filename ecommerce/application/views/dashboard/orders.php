<div class="container">
    <form action="" method="post" id="orderSearch">
        <input type="text" name="name" id="name">
    </form>
    <div id="table"></div>
</div>
</body>
<script>
    $(document).ready(function() {
        // Search and load table
        $(document).on('submit', '#orderSearch', function() {
            $.post('/dashboard/orders/search', $(this).serialize(), function(res) {
                $('#table').html(res);
            })
            return false;
        });
        $(document).on('keyup', '#orderSearch input', function() {
            $(this).parent().submit();
        });
        $('#orderSearch').submit();

        $(document).on('change', 'select', function() {
            let order_id = $(this).parent().siblings('.order_id').contents().text();
            let status = $('.status').find(":selected").val();
            $.post('/orders/update_status', 
            {status: status, id: order_id},
            function(res){
                $('#orderSearch').submit();
            });
        });
    });
</script>
</html>