<?php

class PointManager {
    public function getPoints() {
        $sql = "SELECT * FROM points";
        return Db::dotazVsechny($sql);
    }

    public function getPoint($idBodu) {
        $sql = "
            SELECT * 
            FROM points 
            WHERE point_id = ?
        ";
        return Db::dotazJeden($sql, [$idBodu]);
    }

    public function convertRecordToObject($dbRecord) {
        return new Point($dbRecord["point_id"], $dbRecord["point_x"], $dbRecord["point_y"]);
    }

    public function convertRecordsToObjects($dbRecords) {
        $pointObjects = [];
        foreach ($dbRecords as $r) {
            $pointObjects[] = $this->convertRecordToObject($r);
        }
        return $pointObjects;
    }
}