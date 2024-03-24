<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="business" value="elsaolander24@gmail.com"> <!-- Replace with your PayPal email -->
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="<?php echo $cart_items['name']; ?>">
        <input type="hidden" name="amount" value="<?php echo $cart_items['price']; ?>"> <!-- Replace with dynamic total amount -->
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="return" value="index.php"> <!-- Replace with your success URL -->
        <input type="hidden" name="cancel_return" value="index.php"> <!-- Replace with your cancel URL -->
        <input type="submit" name="paypal_payment" value="Pay with PayPal">
    </form>