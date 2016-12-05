<?php
require_once "shared.php";
// show_title outputs whatever pageTitle is passed into it as the page's title.
// The charset meta tag is the same for all webpages so it is included here.
function show_title($pageTitle) {
    echo ('<title>' . $pageTitle . ' | Donation Box Finder </title>' .
        '<meta charset="utf-8">');
}

// The show_header generates a nav bar template for each page, depending on
// what their "type" is. Possible types are identified in the code below.
function show_header($pageType) {
// Override Individual type pages to point to Search menu button.
    if ($pageType == "Individual")
        $pageType = "Search";
    $pageNames = [];
// Redirect to private home page if user is logged in.
// The Logout and Profile pages are only visible if user is logged in.
    if (isLoggedIn()) {
        $pageNames = [
            "Home"=>"index.php",
            "Search"=>"search.php",
            "Submit"=>"submission.php",
            "Profile"=>"profile.php",
            "Logout"=>"logout.php"
       ];
    }
// The pageNames array contains pages which are linked from the nav bar.
// The search Results and Individual pages are not included in the menu bar.
    else {
        $pageNames = [
            "Home"=>"index.php",
            "Search"=>"search.php",
            "Submit"=>"submission.php",
            "Register"=>"registration.php",
            "Sign in"=>"signin.php"
        ];
    }
// Move the current pageType from the array before modifying links.
    $pageHolder = $pageNames[$pageType];
    $pageNames[$pageType] = "";
// The only difference between pages is the location to which the nav bar links point.
    switch ($pageType) {
// Other pages are contained in a directory named public so it is prepended to the name.
        case "Home":
            $pageNames = array_map(
                function(&$name) {
                    if($name != "")
                        $name = "public/" . $name;
                    return $name;
                },
                $pageNames
            );
            break;
// The Search, Register, Sign in, Profile, Individual and Submit pages are in a subdirectory so
// the Home link is prepended to point to the parent directory.
        case "Search":
        case "Register":
        case "Sign in":
        case "Submit":
        case "Profile":
            $pageNames["Home"] = "../" . $pageNames["Home"];
            break;
    }
// Put the current page back into the array.
    $pageNames[$pageType] = $pageHolder;

// The header is the same for all nav bars.
    echo ('<h1 id="headertitle"><a href=' . $pageNames["Home"] . ' >Donation Box Finder</a></h1>'
        . '<h2 id="headersubtitle">Find donation centres near you</h2>'
        . '<div id="nav">'
        . '<ul>');
// Loop through pageNames key-value pairs to generate HTML code.
    foreach ($pageNames as $k=>$v) {
// The pageType's nav bar link should look active.
        if($k == $pageType) {
            echo ('<li><a class="menubutton" id="active" href="' . $v . '">' . $k . '</a></li>');
        }
// Otherwise, generate menu buttons (links).
        else {
            echo ('<li><a class="menubutton" href="' . $v . '">' . $k . '</a></li>');
        }
    }
// End the nav bar links list and the div.
    echo ('     </ul>'
        . '</div>');
}
?>