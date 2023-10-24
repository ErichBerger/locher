<?php

class Template {
   
    public function start($title = "locher") {?>
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <link href="stylesheet.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Martian+Mono&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <a href="index.php" <?php $this->currentTab("index.php")?>>Home</a>
                <a href="menu.php" <?php $this->currentTab("menu.php")?>>Menu</a>
                <a href="checkout.php" <?php $this->currentTab("checkout.php")?>>Checkout</a>
                <a href="myaccount.php" <?php $this->currentTab("myaccount.php")?>>My Account</a>
            </nav>
        </header>
        <main>   
    <?php
    }
    //closes the page. Everything added between start and end will be placed in the main tag.
    public function end() {?>
        </main>
        <footer>

        </footer>
    </body>
    
    <?php
    }

    private function currentTab($current) {
        if ($current == basename($_SERVER['REQUEST_URI'])) {
            echo 'id="current-tab"';
        }
    }
}

?>