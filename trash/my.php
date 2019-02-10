<?php
$db = mysqli_connect("localhost","root","" ,"my");
$sql=mysqli_query( $db, "SELECT * FROM imenna");
for ($j=0; $j < 2 ; $j++) { 
 $dan = mysqli_fetch_row($sql);
for ($i=0; $i < 7 ; $i++) { 
	echo $dan[$i];
	echo "</br>";
}
}
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";


$dan = mysqli_fetch_all($sql, MYSQLI_ASSOC);
foreach ($dan as $i) {
	echo $i['text'];
	echo "</br>";
}
?>