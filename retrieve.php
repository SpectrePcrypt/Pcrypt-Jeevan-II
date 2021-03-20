<?php
	include ('config.php');
	
	$sql = "SELECT * FROM time1";
	$sqldata = mysqli_query($conn, $sql) or die('ERROR');
	echo "<table>";
	echo "<tr><th>Time Slot</th></tr>";
	
	while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
		echo "<tr><td>";
		
		echo $row['time_slot'];
		
		echo "</td></tr>";
	}
	
	echo "</table>"; 

?>