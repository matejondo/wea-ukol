<?php
class LoginKontroler extends Kontroler {
  
   public function zpracuj($parametry) {
       $spravceUzivatelu = new UserManager;
     
     if (!empty($_POST)) {
        if ($spravceUzivatelu->prihlas($_POST)) {
          $this->pridejZpravu("Přihlášení bylo úspěšné.", "ok");
          if (!empty($_GET) && isset($_GET["from"])){
              $this->presmeruj($_GET["from"]);
          } else {
              $this->presmeruj("");
          }
        }
        else {
          $this->pridejZpravu("Přihlášení nebylo úspěšné.", "error");
        }  
     }

     $this->pohled = "login";
   }

}
?>