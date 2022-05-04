<?php
try {
	$base = new PDO('mysql:host=localhost; dbname=pfy; charset=utf8','root','Ades86B3');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>