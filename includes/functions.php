<?php require_once("includes/db.php"); ?>

<?php
function redirectTo($newLocation)
{
    header('Location:' . $newLocation);
    exit;
}
?>