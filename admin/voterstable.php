<?php
	#fetch members table from the database 
require "connection.php";
$sql = "SELECT * FROM nacoss";
$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo "<table align='center'  width='1300' border='' class='c-table'>";
echo "<tr><td colspan='10'><center><p>DATABASE INFORMATION FOR VOTERS<p></center></td></tr>";
echo "<thead>";
echo "<tr class = 'tr1'>";
echo "<th>S/N</th>";
echo "<th>ID_Number</th>";
echo "<th>NAME</th>";
echo "<th>GENDER</th>";
echo "<th>LEVEL</th>";
echo "<th>EMAIL</th>";
echo "<th>STATUS</th>";
echo "<th>OPERTAIONS</th>";
echo "</tr>";
echo "</thead>";


while($row = mysqli_fetch_assoc($query)){
$s_n = $row['id'];
$id = $row['studentid'];
$name = $row['firstname']." ".$row['lastname'];
$gender = $row['gender'];
$level = $row['level'];
$email = $row['email'];
$status = $row['status'];

echo "<tbody>
<tr>
<td>$s_n</td>
<td>$id</td>
<td>$name</td>
<td>$gender</td>
<td>$level</td>
<td>$email</td>
<td>$status</td>
<td><a href='adminview.php?id=$id&opr=delm'>Del</a><br/>
<a href='updatemem.php?id=$id&opr=updtm'>change</a></td>
</tr>
</tbody>";
}
echo "</table>";

?>