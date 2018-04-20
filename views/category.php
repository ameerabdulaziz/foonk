<?php
require_once 'includes/init.php';
$pdo = connectToDatabase();
include TEMPLATES.'header.php';
?>

<table>
    <tbody>
    <tr>
        <?php
        $query = 'SELECT * FROM products WHERE cat_id = 1';
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $product): ?>
            <td>
                <form method="post">
                    <h1><?=$product['prod_title']?></h1>
                    <p><?=$product['prod_title']?></p>
                    <p><?=$product['prod_price']?></p>
                    <input type="submit" name="add" value="Add to Cart">
                </form>
            </td>
        <?php endforeach; ?>
    </tr>
    </tbody>
</table>
</body>
</html>