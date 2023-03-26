<?php
class OdhlaseniKontroler extends Kontroler {
	
   public function zpracuj($parametry) {
     $spravceUzivatelu = new UserManager;
     if ($spravceUzivatelu->odhlas()) {
        $this->pridejZpravu("Odhlášení bylo úspěšné.", "ok");
     }   
     $this->presmeruj("");
   }

}
?>