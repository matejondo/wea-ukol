<?php
class OpravneniKontroler extends Kontroler {

    public function zpracuj($parametry) {
        if ($this->prihlasenyUzivatel["user_permissions"] < Permissions::Manager->value) {
            $this->pridejZpravu("Pro zobrazení oprávnění uživatelů musíte mít vyšší oprávnění!", "error");
            $this->presmeruj("uvod");
        }

        $userManager = new UserManager();
        $this->data["users"] = $userManager->vratVsechnyUzivatele();
        $this->pohled = "opravneni";
        if (!empty($parametry[0])) {
            $idUser = $parametry[0];

            if (!empty($parametry[1]))
                switch ($parametry[1]) {
                    case "detail":
                        if (isset($_POST["opravneni"])){
                            $opravneni = Permissions::tryFrom(intval($_POST["opravneni"]));
                            if (!$opravneni){
                                $this->pridejZpravu("Tohle oprávnění neexistuje.", "error");
                            }

                            elseif ($opravneni->value >= $this->prihlasenyUzivatel["user_permissions"]){
                                $this->pridejZpravu("Nelze nastavit oprávnění vyšší než tvoje.", "error");
                            }

                            else {
                                $userManager->zmenOpravneni($idUser, $opravneni->value);
                                $this->pridejZpravu("Oprávnění bylo úspěšně změněno.", "ok");
                            }
                        }
                        $this->pohled = "detailOpravneni";
                        $user = $userManager->getUser($idUser);
                        $this->data["user"] = $user;
                        break;
                }
        }
    }
}
?>