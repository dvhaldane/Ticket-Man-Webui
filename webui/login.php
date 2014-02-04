<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Open tickets</title>
	  <link rel="stylesheet" href="css/style.css">
</head>
<?php

   $server = "127.0.0.1";
   $dbuser = "username";
   $dbpass = "password";
   $dbname = "databasename";
   
mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($dbname);
// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password'];
$reply=$_POST['reply']; 
$ticketit=$_POST['ticketid'];

$sql="SELECT * FROM ticket_login WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Update tickets
mysql_query("UPDATE tickets SET reply='$reply', status= 'answered' WHERE id='$ticketit'");
$sqltickets="SELECT * FROM tickets WHERE status='open' OR status='answered' ORDER BY status DESC";
$resulttickets=mysql_query($sqltickets);
echo "<table width=70% border=1 cellpadding=5 cellspacing=0>";
echo "<tr style=\"font-weight:bold\">
<td>Ticket ID</td>
<td>Status</td>
<td>Opened by</td>
<td>Reason</td>
<td>Reply</td>
</tr>";

while($row = mysql_fetch_assoc($resulttickets)){

if($col == "#707070"){
$col = "#4c4949";
}else{
$col = "#707070";
}
echo "<tr bgcolor=$col>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['status']."</td>";
echo "<td>".$row['name']."</td>";
echo "<td>".$row['reason']."</td>";
if(empty($row['reply'])){
echo "<td>Awaiting reply...</td>";
}else{
echo "<td>".$row['reply']."</td>";
}
echo "</tr>";
}
echo"</table>";
echo "<form method=post action=login.php class=login>";
echo "<p>";
echo "<label for=ticketid>Ticket ID:</label>";
echo "<input type=text name=ticketid id=ticketid>";
echo "</p>";
echo "<p>";
echo "<label for=Reply>Reply:</label>";
echo "<input type=text name=reply id=reply>";
echo "<input type=hidden name=username value='$myusername'>";
echo "<input type=hidden name=password value='$mypassword'>";
echo "</p>";
echo "<p>";
echo "<p class=login-submit>";
echo "<button type=submit class=login-button>Login</button>";
echo "</p>";
//echo "<button type=submit class=login-button>Update ticket</button>";
//echo "</p>";
echo "</form>";
}else{
echo "login failed";
}
?>
Created by:
<a href="http://reemcraft.com">ReemCraft</a>
</html>