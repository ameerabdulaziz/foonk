<?php
/******************************* Requiring Files *************************************/
require_once 'init.php';
/************************ Calling Customer Methods **********************************/
$customer->addProductToCart();
/************************* Including Header View *************************************/
include 'views/header.php';
?>
    <div id="header_wrapper">
        <div id="logo-text"></div>
    </div>
    <div class="container" style="margin-top: 30px;">
        <?php Message::display();?>
        <div class="row">
            <?php
            // Selecting all products
            $result = $category->categoryProducts(4);
            foreach ($result as $category): ?>
                <div class="col-md-3">
                    <div class="col-md-12 item no-padding">
                        <div class="top">
                            <img class="img-responsive" src="<?=PRODUCTS.$category['prod_image']?>" alt="<?=$category['prod_title']?>">
                        </div>
                        <div class="bottom">
                            <h3 class="item-title pull-left"><?=$category['prod_title']?></h3>
                            <div class="pull-right price">$<?= $category['prod_price']; ?></div>
                            <div class="clearfix"></div>
                            <div style="color: #a4a11b" class="text-center">Rating: <?=round($category['rating'])?>/5</div>
                            <form method="post" role="form">
                                <input type="hidden" name="id" value="<?=$category['prod_id']?>">
                                <div class="form-group text-center">
                                    <label for="quantity">Quantity</label>
                                    <input class="form-control text-center" style="width: 25%; margin: 0 auto;" type="number"
                                           name="quantity" id="quantity" value="1">
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-lg btn-warning" type="submit" name="add"
                                            onclick="return addToCart('<?=isset($_SESSION['cust_id']) ? $_SESSION['cust_id'] : false;?>')">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php include 'views/footer.php'; ?>