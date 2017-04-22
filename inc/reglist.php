
<?php
echo "<h1><center>Registration List</center></h1>";
$con=mysqli_connect("localhost", "u616683551_rithm", "regency","u616683551_rithm"); 
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$result = mysqli_query($con,"SELECT * FROM reg");

echo "<center><table border='1'>
<tr>
<th>Sl.no</th>
<th>Name</th>
<th>College Name</th>
<th>Phone</th>
<th>Email</th>
<th>Event</th>
<th>Branch</th>
<th>Topic</th>
</tr>";
$serial = 1;
while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $serial++ . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['college'] . "</td>";
  echo "<td>" . $row['number'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['event'] . "</td>";
  echo "<td>" . $row['branch'] . "</td>";
  echo "<td>" . $row['topic'] . "</td>";
  echo "</tr>";
  }
echo "</table></center>";

mysqli_close($con);
?> 

<html><body><center><a href="regexport.php">Import Registrion list as Excel file</a></center></body></html>