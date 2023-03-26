<?php
abstract class Kontroler {
    protected $prihlasenyUzivatel;
    protected $pohled = "";
    protected $data = [];
    protected $title = "Body";
    public function __construct() {
        $spravceUzivatelu = new UserManager;
        $this->prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    }
    abstract public function zpracuj($parametry);
    public function vypisPohled() {
        extract($this->data); // extrahuje z pole data jednotlivé proměnné s názvy podle klíčů pole data
        require "pohledy/{$this->pohled}.phtml";
    }
    public function presmeruj($url) {
        header("Location: /$url");
        exit;
    }

    public function pridejZpravu($zprava, $typ) {
        $_SESSION["zpravy"][] = [
            "zprava" => $zprava,
            "typ" => $typ
        ];    
    }

    public function vratZpravy() {
        $zpravy = isset($_SESSION["zpravy"]) ? $_SESSION["zpravy"] : [];
        unset($_SESSION["zpravy"]);
        return $zpravy;
    }
}