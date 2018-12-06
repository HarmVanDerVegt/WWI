<?php

// doel: laad afbeeldingen van database
// in: $id verwacht een stockitemID
// uit: geeft een array met strings terug die base64 codes bevat van afbeeldingen
function laad_afbeelding($id) {
    // voorkom sql injectie door $id te testen of het een int is
    $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
    
    // maak connectie
    $sql_connectie = mysqli_connect('localhost', 'root', 'Q9sZbU9Tp9uvugE', 'wideworldimporters');


    if ($sql_connectie) { // check of connectie maken sucessvol was
        // vraag afbeeldingen op
        $res = mysqli_query($sql_connectie, "SELECT photo FROM photo_list WHERE stockitemID=" . $id);

        // maak een array met afbeeldingen in base64 formaat
        $lijst = array();
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $lijst[$i++] = base64_encode($row['photo']);
        }

        // eindig connectie met database
        $sql_connectie = NULL;

        // geef resultaat
        return $lijst;
    } else {
        return False;
    }
}

// doel: geef de afbeeldingen weer
// in: $foto_lijst verwacht een array met bae64 codes van type string
//     $y en $x om de groote te bepalen van de afbeelding
// uit: de functie geeft geen waarde terug
function show_afbeelding($foto_lijst,$y=400,$x=400) {
    // zorgt dat het een standaard ruimte inneemt
    print('<div style="height:'.$y.'px; width: '.$x.'px;">');
    // belangrijke variablen
    $aantal_afbeeldingen = count($foto_lijst);

    if ($aantal_afbeeldingen > 0) {
        // begin afbeelding element
        print('<div class="slideshow">
           <div class="container" style="height: '.$y.'px; width: '.$x.'px;"> 
           <div id="myCarousel" class="carousel slide" data-ride="carousel">');

        // indicators
        if ($aantal_afbeeldingen > 1) {
            print('<ol class="carousel-indicators">');
            for ($i = 0; $i < $aantal_afbeeldingen; $i++) {
                print('<li data-target="#myCarousel" data-slide-to="' . $i . '" class="' . (($i == 0) ? 'active' : '') . '"></li>');
            }
            print('</ol>');
        }

        // afbeeldingen
        print('<div class="carousel-inner">');
        $i = 0;
        foreach ($foto_lijst as $foto) {
            print('<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">
               <img src="data:image/jpeg;base64,' . $foto . '" style="width:'.$x.'px; max-height: '.$y.'px;"/>
               </div>');
            $i = 1;
        }
        print('</div>');

        // knoppen
        if ($aantal_afbeeldingen > 1) {
            print('<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>
               </a>');
        }

        // eindig afbeelding element
        print('</div></div></div>');
    }
    else{
        print("Er zijn geen fotos voor dit product beschikbaar<br>");
    }
    print('</div>');
}
?>

