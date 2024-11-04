<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Vending Machine</title>
</head>  
<body>

<div class="vending-machine">
    <h2>Vending Machine</h2>
    <form method="post">
        <fieldset>
            <legend>Available Drinks</legend>
            <?php
            $products = [
                'Coke' => 15,
                'Sprite' => 20,
                'Royal' => 20,
                'Pepsi' => 15,
                'Mountain Dew' => 20
            ];
            foreach ($products as $product => $price): ?>
                <label>
                    <input type="checkbox" name="items[]" value="<?= $product ?>"> <?= htmlspecialchars($product) ?> - ₱<?= htmlspecialchars($price) ?>
                </label>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Customize Your Order</legend>
            <div class="select-container">
                <label for="drinkSize">Select Size:</label>
                <select name="drinkSize" id="drinkSize">
                    <option value="regular">Regular</option>
                    <option value="upsized">Up-Sized (+₱5)</option>
                    <option value="jumbo">Jumbo (+₱10)</option>
                </select>
            </div>

            <div class="select-container">
                <label for="amount">Number of Drinks:</label>
                <input type="number" name="amount" id="amount" min="0" max="99" value="0">
            </div>
            
            <button type="submit" name="submitOrder" class="submit-btn">Place Order</button>
        </fieldset>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitOrder'])): ?>
        <div class="order-summary">
            <?php
            $selectedItems = $_POST['items'] ?? [];
            $selectedSize = $_POST['drinkSize'];
            $itemCount = (int)$_POST['amount'];

            if (empty($selectedItems) || $itemCount <= 0 || $itemCount > 99) {
                echo "<p class='error-message'>Please select at least one drink and a valid quantity.</p>";
            } else {
                $additionalCost = ($selectedSize === 'upsized') ? 5 : (($selectedSize === 'jumbo') ? 10 : 0);
                $grandTotal = 0;

                echo "<h3>Your Order Summary</h3><ul>";
                foreach ($selectedItems as $drink) {
                    $basePrice = $products[$drink];
                    $totalCost = ($basePrice + $additionalCost) * $itemCount;
                    $grandTotal += $totalCost;

                    // Determine singular or plural
                    $pieceText = ($itemCount === 1) ? 'piece' : 'pieces';

                    // Display order summary
                    echo "<li>{$itemCount} {$pieceText} of {$drink} (".ucfirst($selectedSize).") = ₱{$totalCost}</li>";
                }
                echo "</ul>";
                echo "<p><strong>Total Amount:</strong> ₱{$grandTotal}</p>";
            }
            ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
