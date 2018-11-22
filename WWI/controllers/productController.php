<?php
function generateCombiDeals($combiDeals){

    $html = "";

    $html .= "<div class='card-group'>";

    foreach ($combiDeals as $combiDeal){
        $html .= "<div class='card'>";
            $html .= "<img class='card-img-top'
                        heigth='200px' width='300px'
                        src='" . $combiDeal["Link"] . "'
                        alt='Afbeelding mist>";
            $html .= "<div class='card-body'>";
                $html .= "<a href='product.php?product?" . $combiDeal["ID"] . "'>";
                    $html .= "<h5 class='card-title>" . $combiDeal["Naam"] . "</h5>";
                $html .= "</a>";
            $html .= "</div>";
        $html .= "</div>";
    }
    $html .="</div>";

    return $html;
}