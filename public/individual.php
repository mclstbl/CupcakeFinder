<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Donation Box Finder | Review</title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/individual.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("individual");
            ?>
        </div>
        
        <div id="content-container">
            <div id="individual-content">
                <h3 id="placename">The Salvation Army</h3>
                <h4>1280 Main Street West, Hamilton ON L8S2L8</h4>
                <div id="productpane">
                    <div id="description">
                    The Salvation Army donation box is very close to McMaster University. It is also located near a grocery store and a bus stop.
                    This box can fit at least 20 bags of clothing. Definitely worth a visit.
                    </div>
                    <div id="pictures">
                        <!-- TODO: this will be a list of images scrollable horizontally once the full website is implemented and there are more imgs"-->
                        <img id="pic" src="images/sample.jpg" alt="Photo of location">
                    </div>
                    <div id="map">
                    </div>
                </div>

                <div id="reviewpane">
                    <!--TODO: this should be a list of review items when there is a database available-->
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                    <div class="review">
                        <div class="user">
                            <img src=images/logo.png alt="User's photo">
                            <h4>Micaela</h4>
                        </div>
                        <div class="star-rating">
                            ☆☆☆☆☆
                        </div>
                        <div class="comment">
                            "The big red box is big and fits all of my unwanted stuff""
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</html>