<?php
class UserManager {

    public function prihlas($prihlasovaciUdaje) {
        
      $sql = "
         SELECT *
         FROM users
         WHERE user_name = ?
         AND user_password = crypt(?, user_password)
        ";

      $uzivatel = Db::dotazJeden($sql, 
          [
            $prihlasovaciUdaje["name"],
            $prihlasovaciUdaje["password"]
          ]  
      );
          
      if ($uzivatel) {
          $_SESSION["uzivatel"] = $uzivatel;
          return 1;
      }
      return 0;    

    }

    public function registrace($data){
        if (Db::dotazJeden("SELECT * FROM users WHERE user_name = ?", [$data["name"]])){
            return [
                "success" => false,
                "error" => "Uživatelské jméno je už zabráno."
            ];
        }

        if (Db::dotazJeden("SELECT * FROM users WHERE user_email = ?", [$data["email"]])){
            return [
                "success" => false,
                "error" => "Email je už zabráný."
            ];
        }

        $sql = "
         INSERT INTO users (user_name, user_email, user_password) VALUES 
         (?, ?, crypt(?, gen_salt('md5')))
         RETURNING user_name, user_email, user_permissions
        ";

        $uzivatel = Db::dotazJeden($sql, [
                $data["name"],
                $data["email"],
                $data["password"]
        ]);

        if ($uzivatel) {
            $_SESSION["uzivatel"] = $uzivatel;
            return [
                "success" => true,
                "result" => $uzivatel
            ];
        }
        return [
            "success" => false,
            "error" => null
        ];
    }

    
    public function odhlas() {

        if ($this->vratPrihlasenehoUzivatele()) {
          unset($_SESSION["uzivatel"]);
          return 1;
        }
        return 0;

    }
    
    public function vratPrihlasenehoUzivatele() {

        return $_SESSION["uzivatel"] ?? false;

    }

    public function vratVsechnyUzivatele(){
        return Db::dotazVsechny("SELECT * FROM users");
    }

    public function getUser($id){
        return Db::dotazJeden("SELECT * FROM users where user_id = ?", [$id]);
    }

    public function zmenOpravneni($id, $opravneni){
        return Db::dotazJeden("UPDATE users SET user_permissions = ? WHERE user_id = ?", [$opravneni, $id]);
    }

}
?>
