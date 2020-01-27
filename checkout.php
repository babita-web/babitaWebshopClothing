

<?php

include "includes/header.php";
include "includes/babita.php";
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$user = User::find_by_id($_SESSION['user_id']);
$products= Product::find_all();
$shopping_cart=New Shopping_cart();
$shopping_cart=$_SESSION['shopping_cart'];


/*if (isset($_GET["id"])) {*/
if(isset($_POST['submitorder'])){
        $order=new Order();
        $order->user_id=$user->id;
        $order->total_price=$_SESSION['total_price'];
        $order->username;
        $order->address;
        $order->email=$user->email;
        $order->date_order = date('Y-m-d h:i:s',time());

        $order->create();
        $user_orders=Order::find_the_user_orders($user->id);
        $last_order= $user_orders[array_key_last($user_orders)];
       /* foreach ($shopping_cart->items as $Qnt=>$product):
            $order_details=new Order_details();
            $order_details->order_id=$last_order->id;
            $order_details->quantity=$quantities[$Qnt];
            $order_details->product_id=$product->id;
            $order_details->title=$product->title;
            $order_details->price=$product->price;
            $order_details->create();
        endforeach;*/


    }
?>


    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Checkout
			</span>
        </div>
    </div>
    <body>
    <div class="loader"></div>

    <main id="main" role="main">
        <section id="checkout-banner">
            <div class="container py-5 text-center">
                <i class="fa fa-credit-card fa-3x text-dark"></i>
                <h2 class="my-3">Checkout form</h2>
                <p class="lead">Below fill all details to pay your order.</p>
            </div>
        </section>
        <section id="checkout-container">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>


    <ul class="list-group mb-3">
    <table class="table">
        <thead>
        <tr>

            <th scope="col">Product</th>

            <th scope="col">Product name</th>
            <th scope="col">Price</th>
            <th scope="col">Qnty</th>
            <th scope="col">Total Price</th>

        </tr>
        </thead>

        <tbody>
        <?php if(!empty($_SESSION["shopping_cart"])) {
            $total = 0;
            $tellen= 0;?>
            <?php foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                ?>

                <tr>
                <!-- <form method="post" action="product.php?action=add&id=<?php /*echo $product->id; */?>">-->
                <div class="col">
                    <td>
                        <a href="view.php?id=<?php echo $values['item_id']; ?>">
                            <img src="admin/img/products/<?php echo $values['item_id']; ?>" width="40px" height="40px">
                        </a></td>
                    <td> <h6 class="my-0"><?php echo $values["item_name"]; ?></h6></td>
                    <td> <h6 class="my-0"><?php echo $values["item_price"]; ?></h6></td>
                    <td>  <h6 class="my-0"> <?php echo $values["item_quantity"]; ?></h6></td>

                    <td><h6 class="my-0"><?php echo ($values["item_quantity"] * $values["item_price"]); ?></h6>
                    </td>
                    <?php $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        $tellen = $tellen + $values["item_quantity"];?>

                </div>
                </tr>
            <?php  }?>

        <?php }?>
        </tbody>

    </table>
    <hr>

    <div class="m-l-25 m-r--38 m-lr-0-xl">
        <?php if($total<100) {
            $total = 6 + $total;
            echo " 6 euro for shipping charge for a order under 100 €";
        } ?><br>
    </div>

        <h3 class="mtext-109 cl2 p-b-30">
            Total : <?php echo number_format($total,2);?>  €
            <br>
            Total items:  <?php echo $tellen;?></h3>
    </ul>





                        <ul class="list-group mb-3">
<!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->
        <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

            <script>
    // Render the PayPal button into #paypal-button-container
                paypal.Buttons({

        // Set up the transaction
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value:<?php echo number_format($total,2);?>
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                alert('Transaction completed by ' + details.payer.name.given_name + '!');

                // Call your server to save the transaction
                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }


    }).render('#paypal-button-container');
</script>



                        </ul>


                            <p>* 6 euro for shipping charge for a order under 100 €</p>
                            <hr>
                    </div>


                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Billing address</h4>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email
                                    <span class="text-muted">(Optional)</span>
                                </label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address2">Address 2
                                    <span class="text-muted">(Optional)</span>
                                </label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" id="country" required>
                                        <option value="">Choose...</option>
                                        <option>Belgium</option>
                                        <option>Nederlands</option>
                                        <option>France</option>
                                        <option>Germany</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>


                            <h4 class="mb-3">Payment</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <a href="checkout_user.php" button class="btn btn-primary btn-lg btn-block" name="submitorder" type="submit">
                                <i class="fa fa-credit-card"></i> </button></a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    </body>

<?php include ("includes/footer.php");?>