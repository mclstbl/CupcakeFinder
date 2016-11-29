<!DOCTYPE php>
<php lang="en">
    <head>
        <title>Donation Box Finder | Search Results</title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/results.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Results");
            ?>
        </div>
        
        <div id="content-container">
            <div id="results-content">
                <div id="mini-search">
                    <form id="search" action="#">
                        <legend>Donate </legend>
                        <fieldset>
                        <input id="clothing" type="checkbox" value="clothing"><label for="clothing"> Clothing</label>
                        <input id="electronics" type="checkbox" value="electronics"><label for="electronics"> Electronics</label>
                        <input id="food" type="checkbox" value="food"><label for="food"> Food</label><br>
                        </fieldset>

                        <label for="near">Near</label>
                        <input id="near" type="text" name="location" placeholder="My location">
                        <input type="submit" value="Search">
                    </form>
                </div>
                <a name="results">
                <div id="list">
                <h3>Search results</h3>
                    <h4>Click name to see details</h4>
                    <ol class="hits">
                        <li>
                            <img class="pic" src="images/sample.jpg" alt="Location photo">
                            <a href="individual.php">The Salvation Army</a>
                            
                            <div class="left">
                                <div class="review">
                                    <div class="stars">
                                        ☆☆☆☆☆
                                        <div class="numberofreviews">
                                            150 reviews
                                        </div>
                                    </div>
                                    <ul class="types">
                                        <li>Clothing</li>
                                        <li>Electronics</li>
                                        <li>Food</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="right">
                                <p class="address">1280 Main Street West, Hamilton ON L8S2R2</p>
                            </div>

                            <div class="bottom">
                                <p class="topcomment"> "The red box is big and fits all of my unwanted stuff"</p>
                            </div>
                        </li>
                        <li>
                            <img alt="Result location image" class="pic" src="images/sample.jpg">
                            <a href="individual.php">Goodwill Donation Centre</a>
                            
                            <div class="left">
                                <div class="review">
                                    <div class="stars">
                                        ☆☆☆☆☆
                                        <div class="numberofreviews">
                                            100 reviews
                                        </div>
                                    </div>
                                    <ul class="types">
                                        <li>Clothing</li>
                                        <li>Electronics</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="right">
                                <p class="address">90 Glenmount Avenue, Hamilton ON L8S2R2</p>
                            </div>

                            <div class="bottom">
                                <p class="topcomment"> "Much wow"</p>
                            </div>
                        </li>
                        <li>
                            <img class="pic" alt="Result location image" src="images/sample.jpg">
                            <a href="individual.php">Good Shepherd</a>
                            
                            <div class="left">
                                <div class="review">
                                    <div class="stars">
                                        ☆☆☆☆☆
                                        <div class="numberofreviews">
                                            42 reviews
                                        </div>
                                    </div>
                                    <ul class="types">
                                        <li>Clothing</li>
                                        <li>Food</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="right">
                                <p class="address">2 Gary Avenue, Hamilton ON L8S2R2</p>
                            </div>

                            <div class="bottom">
                                <p class="topcomment"> "They have a recycling bin which helps me sort my giveaways"</p>
                            </div>
                        </li>
                    </ol>
                </div>

                <div id="map">
                </div>
            </div>
        </div>

        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</php>