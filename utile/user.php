<?php
    require_once('./db.php');
    function getUserId() {
        $ReqUserId = $db->prepare('SELECT userId FROM session WHERE accesstoken = ?;');
        $ReqUserId->execute(array($userToken));
        $UserId = $ReqUserId->fetch(PDO::FETCH_OBJ);
        if (isset($UserId)) {
            return $UserId;
        }
    }
?>