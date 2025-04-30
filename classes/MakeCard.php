<?php
function makeCard($page)
{
    $card = file_get_contents("http://localhost/PHP-PJ/classes/card.html");
    $card = str_replace("Cardtitle", $page["name"], $card);
    $card = str_replace("#link", "http://localhost/PHP-PJ/pages/viewTutorial.php?id=$page[id]", $card);
    $card = addImages($card, $page);
    echo $card;
}

function addImages($card, $page)
{
    if (isset($page["imgs"]) && $page["imgs"] != false) {
        $imgs = $page["imgs"];
        if (count($imgs) == 1) {
            $card = str_replace(
                "<!-- img -->",
                "<img src='$imgs[0]' class='card-img-top' style='max-height: 25vh' alt=':)'>",
                $card
            );
        } else {
            $card = makeCarousel($card, $page);
        }

    }else{
        $card = str_replace(
            "<!-- img -->",
            "<img src='http://localhost/PHP-PJ/images/minecraft.gif' style='max-height: 25vh' class='card-img-top' alt=':)'>",
            $card
        );
    }
    return $card;
}

function makeCarousel($card, $page)
{
    $imgs = $page["imgs"];
    $defImg =
        "<div class='carousel-item'>
            <img src='#src' class='d-block w-100' style='max-height: 25vh' alt=':)'>
         </div>";
    $carou = file_get_contents("http://localhost/PHP-PJ/classes/carousel.html");
    $carou = str_replace("id#", "$page[name]$page[id]", $carou);
    $totImgs = "";
    for ($i = 0; $i < count($imgs); $i++) {
        if ($i == 0) {
            $tmp = str_replace("carousel-item", "carousel-item active", $defImg);
            $tmp = str_replace("#src", "$imgs[$i]", $tmp);
            $totImgs .= $tmp;
        } else {
            $totImgs .= str_replace("#src", "$imgs[$i]", $defImg);
        }
    }
    $carou = str_replace("<!-- OtherImg -->", "$totImgs", $carou);
    $card = str_replace("<!-- img -->", $carou, $card);
    return $card;
}
?>