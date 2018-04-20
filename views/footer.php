<footer>
    <h4 class="text-center">Copyrights &copy; Ameer Abdulaziz 2018</h4>
</footer>
<script src="<?=JS?>jquery.js"></script>
<script src="<?=JS?>bootstrap.js"></script>
<script>
    $(function () {
        $(window).scroll(function () {
            var v_scroll = $(this).scrollTop();
            $('#logo-text').css({
                "transform" : "translate(0px, "+v_scroll/2+"px)"
            });
        });
    });
    function addToCart(session) {
        if (session === '') {
            alert('Sorry, you must log in to be able to add products to your cart');
            return false;
        }
        return true;
    }
    function loadCart() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById('check-out').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open('GET', 'includes/cart_processed.php', true);
        xmlhttp.send();
    }
    function deleteItem(id) {
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById('check-out').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open('GET', 'includes/cart_processed.php?did=' + id, true);
        xmlhttp.send();
    }
    function changeQuantity(id, quantity) {
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById('check-out').innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open('GET', 'includes/cart_processed.php?qid=' + id + '&quantity=' + quantity, true);
        xmlhttp.send();
    }
    function checkTransportationSelected(total) {
        var selectedValue = document.getElementById('transportation-types').value;
        if (selectedValue === '0') {
            alert('Sorry, you must choose transport type before checking out process');
            document.getElementById('grand-total').innerText = parseFloat(total);
            return false;
        } else if (selectedValue === '1') {
            document.getElementById('grand-total').innerText = parseFloat(total);
            return true;
        } else {
            document.getElementById('grand-total').innerText = parseFloat(total) + 5;
            return true;
        }
    }
</script>
</body>
</html>