<?php
    require_once('./db.php');
    //
    function getUserId($access_token) {
        $ReqUserId=$db->prepare('SELECT userId FROM session WHERE accesstoken=:access_token;');
        $ReqUserId->bindParam(":access_token",$access_token,PDO::PARAM_STR);
        $ReqUserId->execute();
        return $UserId=$ReqUserId->fetch(PDO::FETCH_ASSOC) ? $UserId : false;
        }
    }
?>
