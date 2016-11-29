<?php
// The show_header generates a nav bar template for each page, depending on
// what their "type" is. Possible types are identified in the code below.
    function show_header($pageType) {
// The header is the same for all nav bars.
        echo ('<h1 id="headertitle"><a href="index.php" >Donation Box Finder</a></h1>'
            . '<h2 id="headersubtitle">Find donation centres near you</h2>'
            . '<div id="nav">'
            . '<ul>');
// The pageNames array contains pages which are linked from the nav bar.
// The searcg Results and Individual pages are not included in the sidebar.
        $pageNames = [
            "Home"=>"index.php",
            "Submit"=>"submission.php",
            "Register"=>"registration.php",
            "Sign in"=>"signin.php"
        ];
// Move the current pageType from the array before modifying links.
        $pageHolder = $pageNames[$pageType];
        $pageNames[$pageType] = "";
// The only difference between pages is the location to which the nav bar links point.
        switch ($pageType) {
// The Home, Results and Individual pages set Home as the active page.
// Other pages are contained in a directory named public so it is prepended to the name.
            case "Home":
            case "Results":
            case "Individual":
                $pageNames = array_map(
                    function(&$name) {
                        if($name != "")
                            $name = "public/" . $name;
                        return $name;
                    },
                    $pageNames
                );
                break;
// The Register, Sign in and Submit pages are in a subdirectory so
// the Home link is prepended to point to the parent directory.
            case "Register":
            case "Sign in":
            case "Submit":
                $pageNames["Home"] = "../" . $pageNames["Home"];
                break;
        }
// Put the current page back into the array.
        $pageNames[$pageType] = $pageHolder;
// Loop through pageNames key-value pairs to generate HTML code.
        foreach ($pageNames as $k=>$v) {
// There is no nav bar link for Results and Individual so make it look like they point to Home.
            if ($pageType == "Results" || $pageType == "Individual")
                $pageType = "Home";
// The pageType's nav bar link should look active.
            if($k == $pageType){
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