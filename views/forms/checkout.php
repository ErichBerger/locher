<form action="checkout.php" method="post">
    <p>
        <label for="type">I want this for: </label>
        <input type="radio" name="type" id="delivery" value="delivery" required>
        <label for="delivery">Delivery</label>
        
        <input type="radio" name="type" id="pickup" value="pickup" required>
        <label for="pickup">Pickup</label>
        
    </p>
    <p>
        <label for="address">Address: </label>
        <input type="text" name="address" id="address" required>
    </p>  
    <p>
        <label for="tipAmount">Tip Amount: $</label>
        <input type="text" name="tipAmount" id="tipAmount">
    </p> 
    <input type="submit" value="Purchase">
</form>