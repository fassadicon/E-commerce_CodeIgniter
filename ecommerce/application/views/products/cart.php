<div class="container">
    <div id="table"></div>
    <h6 class="">Total: PHP <?= $totalAmount['totalAmount'] ?></h6>
    <form action="/orders/add" method="post" class="form" id="orderForm">
        <div class="row">
            <div class="col-6">
                <h5>Shipping Information</h5>
                <label for="">First Name: </label>
                <input type="text" name="ship_first_name" id="ship_first_name" class="form-control" value="Frans">
                <label for="">Last Name: </label>
                <input type="text" name="ship_last_name" id="ship_last_name" class="form-control" value="Sadicon">
                <label for="">Address </label>
                <input type="text" name="ship_address" id="ship_address" class="form-control" value="Blk 2 Lt 8 Buena Homes subd.">
                <label for="">Address 2</label>
                <input type="text" name="ship_address2" id="ship_address2" class="form-control" value="Malanday">
                <label for="">City</label>
                <input type="text" name="ship_city" id="ship_city" class="form-control" value="San Mateo">
                <label for="">State</label>
                <input type="text" name="ship_state" id="ship_state" class="form-control" value="Rizal">
                <label for="">Zipcode</label>
                <input type="number" name="ship_zipcode" id="ship_zipcode" class="form-control" value="1850">
            </div>
            <div class="col-6">
                <h5>Billing Information</h5>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same_as_shipping">
                    <label for="" class="form-check-label">Same as shipping</label>
                </div>
                <label for="">First Name: </label>
                <input type="text" name="bill_first_name" id="bill_first_name" class="form-control">
                <label for="">Last Name: </label>
                <input type="text" name="bill_last_name" id="bill_last_name" class="form-control">
                <label for="">Address </label>
                <input type="text" name="bill_address" id="bill_address" class="form-control">
                <label for="">Address 2</label>
                <input type="text" name="bill_address2" id="bill_address2" class="form-control">
                <label for="">City</label>
                <input type="text" name="bill_city" id="bill_city" class="form-control">
                <label for="">State</label>
                <input type="text" name="bill_state" id="bill_state" class="form-control">
                <label for="">Zipcode</label>
                <input type="number" name="bill_zipcode" id="bill_zipcode" class="form-control">
                <input type="hidden" value="<?= $totalAmount['totalAmount'] ?>" name="total_amount">
            </div>
        </div>
        <!-- <input type="submit" value="Pay" class="btn btn-primary mt-2" onclick="pay(100)"> -->
    </form>
    <button class="btn btn-primary mt-2" onclick="pay(<?= $totalAmount['totalAmount'] ?>)">Pay PHP <?= $totalAmount['totalAmount'] ?></button>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p id="token_response"></p>
            </div>
        </div>
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
</body>

<script type="text/javascript">
    function pay(amount) {
        var handler = StripeCheckout.configure({
            key: 'pk_test_51MefmzIQRTxBN7MhqYYHNfSUjSNy332yiTC8ajlr7TnsI5Zj2mKRKSiFPbf75UozwjcfGmTluy9q4caKCi2DGb1f0055IaJPhD', // your publisher key id
            locale: 'auto',
            token: function(token) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
                // console.log('Token Created!!');
                // console.log(token)
                // $('#token_response').html(JSON.stringify(token));
                $.ajax({
                    url: "<?php echo base_url(); ?>stripe/payment",
                    method: 'post',
                    data: {
                        tokenId: token.id,
                        amount: amount
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.data);
                        // $('#token_response').append('<br />' + JSON.stringify(response.data));
                        $.post($('#orderForm').attr('action'), $('#orderForm').serialize(), function(res) {
                            console.log(res);
                        })
                        // console.log($('#orderForm').attr('action'));
                    }
                })
            }
        });
        handler.open({
            name: 'Sixenart Clothing',
            amount: amount * 100
        });
    }

    $(document).ready(function() {
        $.get('/carts/cart_items', function(res) {
            $('#table').html(res);
        })

        $("#same_as_shipping").click(function() {
            if ($("#same_as_shipping").prop('checked') == true) {
                $('#bill_first_name').val($('#ship_first_name').val());
                $('#bill_last_name').val($('#ship_last_name').val());
                $('#bill_address').val($('#ship_address').val());
                $('#bill_address2').val($('#ship_address2').val());
                $('#bill_city').val($('#ship_city').val());
                $('#bill_state').val($('#ship_state').val());
                $('#bill_zipcode').val($('#ship_zipcode').val());
            } else {
                $('#bill_first_name').val('');
                $('#bill_last_name').val('');
                $('#bill_address').val('');
                $('#bill_address2').val('');
                $('#bill_city').val('');
                $('#bill_state').val('');
                $('#bill_zipcode').val('');
            }
        });
    });
</script>

</html>