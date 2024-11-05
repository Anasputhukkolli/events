<?php
session_start(); // Start the session to check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>


<header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="#">home</a></li>
                                            <li><a href="#about">about</a></li>
                                            <li><a href="#events">Events <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="#mecasm">MECASM</a></li>
                                                    <li><a href="#mecaf">MECAF</a></li>
                                                    <li><a href="Venue.html">ieee</a></li>
                                                    <li><a href="elements.html">iedc</a></li>
                                                </ul>
                                            </li>
                                            
                                            
                                            <li><a href="#blog">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="#blog">blog</a></li>
                                                    <li><a href="#booking">booking</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#contact">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="buy_tkt">
                                    <div class="book_btn d-none d-lg-flex">
                                        <?php if ($isLoggedIn): ?>
                                            <li class="user">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</li> <!-- Display username -->
                                            <a href="logout.php">logout</a>
                                        <?php else: ?>
                                            <a href="login.php">login</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</header>




