<?php
/******************************* Requiring Files *************************************/
require_once 'init.php';
/************************ Calling Customer Methods **********************************/
$customer->addProductToCart();
$customer->checkOut();
$customer->rateProducts();
/************************* Including Header View *************************************/
include 'views/header.php';
?>
    <div id="header_wrapper">
        <div id="logo-text"></div>
    </div>
    <div class="container">
        <div class="row">
            <h1 class="text-center">My Shopping Cart</h1>
            <?php Message::display();?>
            <hr style="border: solid #a4a11b 2px">
        </div>
        <div>
            <form method="post">
                <select class="form-control pull-left" style="width: 25%;" name="id" id="select-product">
                    <option value="0">Select Product</option>
                    <?php
                    // Selecting all products
                    $result = $products->selectAllProducts();
                    foreach ($result as $product): ?>
                        <option value="<?=$product['prod_id']?>"><?=$product['prod_title']?> = $<?=$product['prod_price']?></option>
                    <?php endforeach; ?>
                </select>
                <input class="form-control pull-left text-center" style="width: 6%; smargin: 0 auto;" type="number"
                       name="quantity" id="quantity" value="1">
                <input class="btn btn-warning" type="submit" name="add" value="Add to cart">
                <div class="clearfix"></div>
            </form>
        </div>
        <?php if (isset($_SESSION['shopping_cart'])): ?>
            <div id="check-out"></div>
        <?php else: ?>
            <h3 class="text-center text-warning">Your cart is empty!</h3>
            <hr style="border: solid #a4a11b 1px">
        <?php endif; ?>

        <?php if (isset($_SESSION['buying_history'])):
            include VIEWS.'buying_history.php';
        endif; ?>
    </div>
<?php include 'views/footer.php'; ?>