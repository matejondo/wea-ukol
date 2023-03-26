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
                    switch ($result["error"]){
                        case "user_name":
                            $this->pridejZpravu("Uživatelské jméno je už zabráno", "error");
                            break;

                        case "user_email":
                            $this->pridejZpravu("Tento email už použivá jiný účet", "error");
                            break;

                        default:
                            $this->pridejZpravu("Nastala neznámá chyba :(", "error");
                            break;
                    }
                }
            }
        }

        $this->pohled = "register";
    }

}
?>