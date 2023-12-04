<section id="registration">
        <h2>Fill out the form to register:</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required></br>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password" required></br>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required></br>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required></br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required></br>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="555-555-5555" required></br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required></br>

            <input type="submit" value="Register">
        </form>
    </section>
    <p>Already have an account? Click <a href="login.php">here to login</a></p>

