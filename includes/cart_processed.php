<?php
require_once '../init.php';
$customer->increaseQuantity();
$customer->deleteItem();
$i = 0;
?>
<?php if (isset($_SESSION['shopping_cart'])): ?>
  <?php Message::display();?>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th colspan="2">Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delete</th>
            <th>Sub total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['shopping_cart'] as $item): ?>
            <tr>
                <td width="5%"><?=++$i?></td>
                <td width="40%"><?=$item['title']?></td>
                <td width="15%"><img style="width: 70px; height:30px" src="<?=PRODUCTS.$item['image']?>" alt="<?=$item['title']?>"></td>
                <td width="10%"><b>$<?=$item['price']?></b></td>
                <td width="10%"><input type="number" onmouseup="changeQuantity('<?=$item['id']?>', this.value)" value="<?=$item['quantity']?>"></td>
                <td width="10%"><button class="btn btn-danger" onclick="deleteItem('<?=$item['id']?>')">Delete</button></td>
                <td width="10%">
                    <b>$<?=$item['subTotal'];?></b>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <form method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Order Summary</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr><td>No. Items</td><td><?=$i?></td></tr>
                    <tr><td>Total</td><td><b>$<?=$_SESSION['total'] = array_sum(array_column($_SESSION['shopping_cart'], 'subTotal'))?></b></td></tr>
                    <tr>
                        <td>Transportation</td>
                        <td>
                            <label>
                                <select id="transportation-types" name="transportation-types" onchange="checkTransportationSelected('<?=$_SESSION['total']?>')">
                                    <option value="0"></option>
                                    <option value="1">Pick Up = $0</option>
                                    <option value="2">UPS = $5</option>
                                </select>
                            </label>
                        </td>
                    </tr>
                    <tr><td>Grand Total</td><td><b>$<span id="grand-total">
                                <?=$_SESSION['total'] = array_sum(array_column($_SESSION['shopping_cart'], 'subTotal'));?>
                            </span></b></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <input class="btn btn-lg btn-primary pull-right" type="submit" name="check_out" value="Check Out >>"
               onclick="return checkTransportationSelected('<?=$_SESSION['total']?>');">
        <div class="clearfix"></div>
    </form>
<?php else: ?>
    <h3 class="text-center text-warning">Your cart is empty!</h3>
    <hr style="border: solid #a4a11b 1px">
<?php endif; ?>