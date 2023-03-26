<?php
class SmerovacKontroler extends Kontroler {
    protected $kontroler;
    public function zpracuj($parametry) {
        $url = $parametry[0];
        $castiCesty = $this->parsujURL($url);
        if (!empty($castiCesty[0])) {
            $castNazvuKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($castiCesty));
            $nazevKontroleru = $castNazvuKontroleru . "Kontroler";
            if (file_exists("kontrolery/$nazevKontroleru.php")) {
                $this->kontroler = new $nazevKontroleru;
                $this->kontroler->zpracuj($castiCesty);
                $this->pohled = "rozlozeni";
            }
            else {
               $this->presmeruj("chyba"); 
            }
        }
        else {
            $this->presmeruj("uvod");
        }

        $this->data["zpravy"] = $this->vratZpravy();
    }

    // z editace-studenta udělá EditaceStudenta
    private function pomlckyDoVelbloudiNotace($text) {
        $text = str_replace("-", " ", $text);
        $text = ucwords($text);
        $text = str_replace(" ", "", $text);
        return $text;
    }

    private function parsujURL($url) {
        $naparsovanaURL = parse_url($url);
        $cesta = $naparsovanaURL["path"];
        
        $cesta = ltrim($cesta, "/"); // odebere počáteční lomítko
        $cesta = trim($cesta); // odebere bílé znaky
        
        $rozdelenaCesta = explode("/", $cesta);
        
        return $rozdelenaCesta;
    }
}