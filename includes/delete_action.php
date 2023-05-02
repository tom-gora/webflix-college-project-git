<?php session_start();

require("connect_db.php");
$q = "DELETE FROM users WHERE user_id={$_SESSION['user_id']}";
$stmt = $link->prepare($q);
$stmt->execute();
if (mysqli_affected_rows($link) > 0) {
    mysqli_close($link);
    session_destroy();
    header("Location: ../index.php#goodbyeModal");
}
;
?>