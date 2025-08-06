<?php
function render_cart($conn, $user_id) {
    ob_start();
    $grand_total = 0;

    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $select_cart->execute([$user_id]);
    ?>

    <div class="cart-container">
        <button class="close-cart-btn" onclick="toggleCart()">
            <!-- Close icon SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </button> 

        <div class="cart-content">
            <div class="cart-header">
                <h2>Your cart</h2>
                <button class="checkout-btn cart-open-btn" onclick="window.location.href='checkout.php'">Checkout</button>
            </div>

            <div class="cart-bar-break"></div>

            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);

                if($select_cart->rowCount() > 0):
            ?>
                <div class="cart-items">
                <?php 
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)):

                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_product->execute([$fetch_cart['product_id']]);

                    if ($select_product->rowCount() > 0):
                        $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                        $sub_total = $fetch_cart['qty'] * $fetch_cart['price'];
                        $grand_total += $sub_total;
                ?>
                    <form action="" method="POST" class="cart-item box">
                        <input type="hidden" name="cart_id" value="<?= htmlspecialchars($fetch_cart['id']) ?>">

                        <img src="uploads/<?= htmlspecialchars($fetch_product['image'] ?? 'default.png') ?>" alt="<?= htmlspecialchars($fetch_product['name']) ?>" class="image" />

                        <div class="cart-item-description">
                            <h3><?= htmlspecialchars($fetch_product['name']) ?></h3>
                            <p class="item-description">This is some random description text blah blah blah b;sgf dsaf ads...</p>
                            <p class="item-price">NZ$<?= number_format($fetch_cart['price'], 2) ?></p>
                        </div>

                        <div class="cart-item-quantity">
                            <form method="POST" style="display: flex; align-items: center;">
                                <input type="hidden" name="cart_id" value="<?= htmlspecialchars($fetch_cart['id']) ?>">

                                <button class="decrease-btn" name="decrease_qty" type="submit" value="1" aria-label="Decrease quantity">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9z"/></svg>
                                </button>

                                <p><?php echo (int)$fetch_cart['qty']; ?>x</p>

                                <button class="increase-btn" name="increase_qty" type="submit" value="1" aria-label="Increase quantity">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>
                                </button>
                            </form>
                        </div>
                    </form>

                <?php else: ?>
                    <p class="empty">Product not found!</p>
                <?php
                    endif;
                endwhile;
                ?>
                </div>

                <div class="cart-bar-break"></div>

                <div class="prices">
                    <div class="Subtotal">
                        <h3>Subtotal:</h3>
                        <h3>NZ$<?= number_format($grand_total, 2) ?></h3>
                    </div>
                    <div class="Total">
                        <h3>Total:</h3>
                        <h3>NZ$<?= number_format($grand_total * 1.15, 2) ?></h3>
                    </div>
                </div>

                <form method="POST" style="margin-top: 10px;">
                    <button type="submit" name="clear_cart" onclick="return confirm('Are you sure you want to clear your cart?')">Clear Cart</button>
                </form>

            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}
?>
