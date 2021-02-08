<?php
echo "<table>";
?>
<tr>
	<th>ID</th>
	<th>FIRST_NAME</th>
	<th>LAST_NAME</th>
</tr>
<?php
for ($x = 0; $x < count($persons); $x++) {
    echo "<tr>";
    echo "<td>" . $persons[$x]['ID'] . "</td>" . "<td>" . $persons[$x]['FIRST_NAME'] . "</td>" . 
        "<td>" . $persons[$x]['LAST_NAME'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>