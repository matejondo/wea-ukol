<?php
class RegistraceKontroler extends Kontroler {

    public function zpracuj($parametry) {
        $spravceUzivatelu = new UserManager;

        if (!empty($_POST)) {
            $result = $spravceUzivatelu->registrace($_POST);
            if ($result["success"]){
                $this->pridejZpravu("Registrace byla úspěšná.", "ok");
                $this->presmeruj("");
                return;
            }

            else {
                if ($result["error"]){
                    $this->pridejZpravu($result["error"], "error");
                }
            }
        }

        $this->pohled = "register";
    }

}
?>
