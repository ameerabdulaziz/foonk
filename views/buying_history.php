<div class="row">
    <h1 class="text-center">Buying History</h1>
    <hr style="border: solid #a4a11b 2px">
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Product</th>
        <th>Rate</th>
    </tr>
    </thead>
    <tbody>
    // Showing Buying History
    <?php foreach ($_SESSION['buying_history'] as $product):?>
        <tr>
            <td><?=$product['title']?></td>
            <td>
                <?php foreach (range(1,5) as $rating):?>
                    <a href="cart.php?id=<?=$product['id']?>&rating=<?=$rating?>"><?=$rating?></a>
                <?php endforeach;?>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>