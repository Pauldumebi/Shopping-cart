<?php
$error = false;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['formShipping'] === "") {
        $error = true;
    } else {
        $cost = (int)$_POST["formShipping"];
        header("Location: index.php?page=summary&shipping=$cost");
    }
}
?>

<?= header('Shipping') ?>

<div class="place-order content-wrapper">
    <h1>Select Shipping Option</h1>
    <div class="shipping-form">
        <?php if ($error) : ?>
            <p style="color: red;">You forgot to select a shipping option</p>
        <?php endif; ?>
        <form action="index.php?page=shipping" method="post">


            <label>Select shipping option?</label>
            <select name="formShipping">
                <option value="">Select...</option>
                <option value="0">pick up(0)</option>
                <option value="5"> UPS ($5)</option>
            </select>

            <div class="buttons shipping-form-submit">
                <input type="submit" value="Place Order" name="place-order" class="next">
            </div>
        </form>
    </div>

</div>

<?= footer() ?>