<?php 
include ('connection.php');

$db = getConnection();
$query = "SELECT * FROM d2 where `name` = 'nm'";
$temp = mysqli_query($db, $query);
$temp=mysqli_fetch_assoc($temp)['temp'];
?>

<form method="post" action>

<textarea name="demo" rows="10" placeholder="<?= $temp ?>"></textarea>

echo "<?= $temp ?>";

</form>
<?php

?>