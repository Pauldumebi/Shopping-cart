<?php
unset($_SESSION['cart'])
?>

<?= header('Place Order') ?>

<div class="place-order content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
</div>

<?= footer() ?>