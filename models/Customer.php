<?php
/**
 * Created by PhpStorm.
 * User: EngAm
 * Date: 2/20/2018
 * Time: 11:27
 *
 * This is a Customer class that extends from Model Class and has eight functions
 *      - Sign Up to Shop
 *      - Login to Shop
 *      - Setting Customer data in SESSIONS
 *      - Add Product to Customer's Cart
 *      - Increase Quantity of any Product
 *      - Delete Item from Cart
 *      - Checkout
 *      - Rate Products
 */

class Customer extends Model {

    /**
     * This method registers the customer data
     */
    public function signUp()
    {
        if (isset($_POST['sign_up'])):
            $fullName = ucwords($_POST['full_name']);                       // Full Name
            $username = $_POST['username'];                                 // Username
            $email = $_POST['email'];                                       // Email
            $password = $_POST['password'];                                 // Password
            $salt = 'XyZzy12*_';                                            // Garbage characters to add to password
            $passwordHashed = hash('md5', $salt.$password);      // Hashed Password
            $address = $_POST['address'];                                   // Address
            $phone = $_POST['phone'];                                       // Phone

            // Check if the form is empty
            if (empty($fullName) || empty($username) || empty($email) || empty($passwordHashed)):
                Message::setMsg('Full Name, Username, Email, and password are required', 'error');
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            // Check if the email is not valid
            elseif (!strpos($email, '@')):
                Message::setMsg('Email must have an at-sign (@)', 'error');
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            // Insert the form data into the customer table
            else:
                $this->query('INSERT INTO customers (full_name, username, email, password, address, phone) VALUES (:fn, :un, :em, :pass, :adds , :ph)');
                $this->bind(':fn', $fullName);
                $this->bind(':un', $username);
                $this->bind(':em', $email);
                $this->bind(':pass', $passwordHashed);
                $this->bind(':adds', $address);
                $this->bind(':ph', $phone);
                $this->execute();
                $this->query('SELECT cust_id, full_name, balance FROM customers ORDER BY cust_id DESC LIMIT 1');
                $this->execute();
                $result = $this->single();
                $this->setCustomerSessions($result['cust_id'], $result['full_name'], $result['balance']);
                header('Location: ../index.php');
                exit;
            endif;
        endif;
    }

    /**
     * This method allows the customer to log in the shop
     */
    public function logIn() {
        if (isset($_POST['login'])):
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Check if the form is empty
            if (empty($_POST['email']) || empty($_POST['password'])):
                Message::setMsg('All fields are required!', 'error');
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            // Check if the email is not valid
            elseif (!strpos($email, '@')):
                Message::setMsg('Email must contains \'@\' symbol!', 'error');
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            // Check if the email or password are exist in the database customer table
            else:
                $salt = 'XyZzy12*_';
                $hashedPassword = hash('md5',$salt.$password);
                $this->query('SELECT * FROM customers WHERE email = :em AND password = :pass');
                $this->bind(':em', $email);
                $this->bind(':pass', $hashedPassword);
                $this->execute();
                $result = $this->single();
                if ($result > 0):
                    $this->setCustomerSessions($result['cust_id'], $result['full_name'], $result['balance']);
                    header('Location: ../index.php');
                    exit;
                else:
                    Message::setMsg('Incorrect Email or Password', 'error');
                    header('Location: '.$_SERVER['PHP_SELF']);
                    exit;
                endif;
            endif;
        endif;
    }

    /**
     * This function sets customer data into SESSIONS
     *
     * @param $id
     * @param $fullName
     * @param $balance
     */
    private function setCustomerSessions($id, $fullName, $balance) {
        $_SESSION['cust_id'] = $id;
        $_SESSION['full_name'] = $fullName;
        $_SESSION['balance'] = $balance;
        $_SESSION['max_buying'] = $_SESSION['balance'];
    }

    /**
     * This methods allows a customer ot add product to this cart
     */
    public function addProductToCart() {
        // Check if add button is submitted
        if (isset($_POST['add'])):
            // Get product data by its id
            $this->query("SELECT * FROM products WHERE prod_id= '$_POST[id]'");
            $this->execute();
            $result = $this->single();
            // Set max_buying SESSION equals to product price and the quantity that customer selected
            $_SESSION['max_buying'] -= $result['prod_price'] * $_POST['quantity'];
            // Check if the customer select products more than his cache
            if ($_SESSION['max_buying'] >= 0):
                // Check if the shopping cart has been set
                if (isset($_SESSION['shopping_cart'])):
                    $count = count($_SESSION['shopping_cart']);
                    $product_ids = array_column($_SESSION['shopping_cart'], 'id');
                    for ($i = 0, $iMax = count($product_ids); $i < $iMax; $i++):
                        // Check if the product is already exist in the cart so the quantity will increase
                        if ($product_ids[$i] === $_POST['id']):
                            $_SESSION['shopping_cart'][$i]['quantity'] += $_POST['quantity'];
                            $_SESSION['shopping_cart'][$i]['subTotal'] += $result['prod_price'] * $_POST['quantity'];
                            Message::setMsg('Product\'s quantity is increased', 'success');
                            header('Location: '.$_SERVER['PHP_SELF']);
                            exit;
                        endif;
                    endfor;
                    // Add product to customer's cart
                    $_SESSION['shopping_cart'][$count] = array(
                        'id'        => $_POST['id'],
                        'title'     => $result['prod_title'],
                        'price'     => $result['prod_price'],
                        'image'     => $result['prod_image'],
                        'quantity'  => $_POST['quantity'],
                        'subTotal'  => $result['prod_price'] * $_POST['quantity']);
                    Message::setMsg('Product is added', 'success');
                    header('Location: '.$_SERVER['PHP_SELF']);
                    exit;
                else:
                    // Add product to customer's cart
                    $_SESSION['shopping_cart'] = array();
                    $_SESSION['shopping_cart'][0] = array(
                        'id'        => $_POST['id'],
                        'title'     => $result['prod_title'],
                        'price'     => $result['prod_price'],
                        'image'     => $result['prod_image'],
                        'quantity'  => $_POST['quantity'],
                        'subTotal'  => $result['prod_price'] * $_POST['quantity']);
                    Message::setMsg('Product is added', 'success');
                    header('Location: '.$_SERVER['PHP_SELF']);
                    exit;
                endif;
            else:
                // Cancel adding because balance is not enough
                $_SESSION['max_buying'] += $result['prod_price'] * $_POST['quantity'];
                Message::setMsg('Sorry, you cannot add products to your cart more than your balance!', 'error');
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            endif;
        endif;
    }

    /**
     * This methods increases the quantity of products
     */
    public function increaseQuantity() {
        // Check if the quantity is increased
        if (isset($_REQUEST['qid'], $_REQUEST['quantity'])):
            foreach ($_SESSION['shopping_cart'] as $key => $item):
                // Check which product will be increased
                if ($item['id'] === $_REQUEST['qid']):
                    // Check if the customer has enough balance
                    if ($_SESSION['max_buying'] >= $_SESSION['shopping_cart'][$key]['price']):
                        $_SESSION['shopping_cart'][$key]['quantity'] = $_REQUEST['quantity'];
                        $_SESSION['shopping_cart'][$key]['subTotal'] = $_SESSION['shopping_cart'][$key]['price'] * $_REQUEST['quantity'];
                        $_SESSION['max_buying'] -= $_SESSION['shopping_cart'][$key]['price'];
                        $_SESSION['quantity'] = $_REQUEST['quantity'];
                    else:
                        $_SESSION['error_msg'] = 'Sorry, you cannot add products to your cart more than your balance!';
                        break;
                    endif;
                endif;
            endforeach;
        endif;
    }

    /**
     * This method allows customer to delete products from his cart
     */
    public function deleteItem() {
        // Check if delete button has been submitted
        if (isset($_REQUEST['did'])):
            // Check if the customer will delete all his products in his cart
            if (count($_SESSION['shopping_cart']) === 1):
                unset($_SESSION['shopping_cart']);
                $_SESSION['max_buying'] = $_SESSION['balance'];
                header('Location: '. $_SERVER['PHP_SELF']);
                return;
            else:
                foreach ($_SESSION['shopping_cart'] as $key => $item):
                    // Check which product will be deleted
                    if ($item['id'] === $_REQUEST['did']):
                        $_SESSION['max_buying'] += $item['price'] * $item['quantity'];
                        unset($_SESSION['shopping_cart'][$key]);
                    endif;
                endforeach;
            endif;
        endif;
    }

    /**
     * This method allows the customer to check out
     */
    public function checkOut() {
        // Check if the checkout button has been submitted
        if (isset($_POST['check_out'])):
            // Check if the customer select UPS transport type
            if (isset($_POST['transportation-types']) && $_POST['transportation-types'] === '2'):
                $_SESSION['total'] += 5;
                if ($_SESSION['total'] > $_SESSION['balance']):
                    Message::setMsg('Sorry, you do not have enough balance', 'error');
                    $_SESSION['total'] -= 5;
                    return;
                endif;
            endif;
            // Set the buying history SESSION
            $_SESSION['buying_history'] = array();
            $_SESSION['buying_history'] += $_SESSION['shopping_cart'];
            unset($_SESSION['shopping_cart']);
            $_SESSION['balance'] -= $_SESSION['total'];
            $this->query("UPDATE customers SET balance = :mc WHERE cust_id = '$_SESSION[cust_id]'");
            $this->bind(':mc' , $_SESSION['balance']);
            $this->execute();
            $_SESSION['max_buying'] = $_SESSION['balance'];
            Message::setMsg('Thanks for buying', 'success');
            header('Location: '. $_SERVER['PHP_SELF']);
            exit;
        endif;
    }

    /**
     * This methods allows the customer to rate the products after buying process
     */
    public function rateProducts() {
        // Check if the customer has rated a product
        if (isset($_GET['id'], $_GET['rating'])):
            $productID = (int) $_GET['id'];
            $rating = (int) $_GET['rating'];
            $custID = $_SESSION['cust_id'];
            $this->query('SELECT * FROM products_ratings WHERE cust_id=:cid AND prod_id=:pid');
            $this->bind(':cid', $custID);
            $this->bind(':pid', $productID);
            $this->execute();
            $result = $this->single();
            // Check if the customer has rated this product before
            if ($result > 0):
                $_SESSION['success_msg'] = 'You already voted';
            else:
                // Add the rating to the rating product database table
                $this->query('INSERT INTO products_ratings (rating, prod_id, cust_id) VALUES (:rate, :pid, :cid)');
                $this->bind(':rate', $rating);
                $this->bind(':pid', $productID);
                $this->bind(':cid', $custID);
                $this->execute();
                $_SESSION['success_msg'] = 'Thanks for your opinion';
            endif;
            header('Location: '. $_SERVER['PHP_SELF']);
            exit;
        endif;
    }

}