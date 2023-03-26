<?php
class PointKontroler extends Kontroler {
    public function zpracuj($parametry) {
        if (!$this->prihlasenyUzivatel) {
            $this->pridejZpravu("Pro zobrazení této stránky se musíte přihlásit.", "error");
            $this->presmeruj("login?from=point");
        }

        $this->pohled = "body";

        $pointManager = new PointManager;

        if (!empty($parametry[0])) {
            $idBodu = $parametry[0];

            if (!empty($parametry[1]))
                switch ($parametry[1]) {
                    case "detail":
                        if ($this->prihlasenyUzivatel["user_permissions"] < Permissions::Administrator->value) {
                            $this->pridejZpravu("Pro zobrazení detailu bodu musíte mít administrátorské oprávnění!", "error");
                            $this->presmeruj("point");
                        }
                            $this->pohled = "detailBodu";
                            $bodDB = $pointManager->getPoint($idBodu);
                            $this->data["bod"] = 
                                $pointManager->convertRecordToObject($bodDB);
                        break;

                    case "delete":

                        break;    

                    case "edit":

                        break;    

                }

        }


        $bodyDB = $pointManager->getPoints();

        $this->data["body"] = 
            $pointManager->convertRecordsToObjects($bodyDB);
    }
}