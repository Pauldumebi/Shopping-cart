<?php
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
$shipping = (int)$_GET["shipping"];
if ($products_in_cart) {
    //-------------------------------------- Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?...) -------------------------------------------//
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    //---------------------------- Get array keys, not the values, (ids) --------------------------//
    $stmt->execute(array_keys($products_in_cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}

$total = 100 - $subtotal - $shipping;
?>

<?= header('Summary') ?>

<div class="cart content-wrapper">
    <h1>Order Summary</h1>
    <form action="" method="post">
        <table>

            <tbody>
                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                    </tr>
                <?php else : ?>

                    <tr>
                        <td class="">
                            Balance
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            &dollar;100
                        </td>

                    </tr>
                    <tr>
                        <td class="">
                            Total
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            - &dollar;<?= $subtotal ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="">
                            Shipping
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            - &dollar;<?= $shipping ?>
                        </td>

                    </tr>

                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Total</span>
            <span class="price">&dollar;<?= $total ?></span>
        </div>
        <div class="buttons">
            <a href="index.php?page=place-order" class="next">Place Order</a>
        </div>
    </form>
</div>