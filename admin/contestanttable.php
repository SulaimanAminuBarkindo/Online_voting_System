<?php
require "connection.php";
$president = "President";
$status = 'draft';
$sql = "SELECT * FROM contestants WHERE status=?;";
$stmt = mysqli_stmt_init($conn);
if(!$stmt->prepare($sql)){
echo "QUERY ERROR";
}else{
$stmt->bind_param('s',$status);
$stmt->execute();
$result = mysqli_stmt_get_result($stmt);

echo "<table align='center'  width='1300' border='' class='c-table'>";
echo "<tr><td colspan='10'><center><p>DATABASE INFORMATION FOR CONTESTANTS<p></center></td></tr>";
echo "<thead>";
echo "<tr class = 'tr1'>";
echo "<th>Image</th>";
echo "<th>S/N</th>";
echo "<th>ID_Number</th>";
echo "<th>Name</th>";
echo "<th>Position</th>";
echo "<th>gender</th>";
echo "<th>Level</th>";
echo "<th>Email</th>";
echo "<th>Phone Number</th>";
echo "<th>Oprations</th>";
echo "</tr>";
echo "</thead>";

while($row =mysqli_fetch_assoc($result) ){
$s_n = $row['id'];
$id = $row['studentid'];
$fullname = $row['fullname'];
$nickname = $row['nickname'];
$position = $row['position'];
$gender = $row['gender'];
$level = $row['level'];
$email = $row['email'];
$gender = $row['gender'];
$phone_number = $row['phone_number'];
$photo = $row['photo'];
echo "<tbody>

<tr>
<td><img src ='files/".$photo."' width=150px height=100px></td>
<td>$s_n</td>
<td>$id</td>
<td>$fullname</td>
<td>$nickname</td>
<td>$position</td>
<td>$gender</td>
<td>$level</td>
<td>$email</td>
<td>$phone_number</td>
<td><a href='approve.php?id=$id&position=$position&opr=approve&nickname=$nickname&fullname=$fullname'>approve</a><br/>
<a href='adminview.php?id=$id&position=$position&opr=delcont'>Del</a><br/>
<a href='updatecont.php?id=$id&position=$position&opr=updtcont'>change</a>
</tr>
</tbody>";
}
}

echo "</table>";
?>
<a href="results.php">Proceed to view result</a>