<?php
include_once 'includes/connect.php';
?>


<html>
	<head>
		<title>Records</title>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<table>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Address</th>
				<th>Timestamp</th>
			</tr>
			
			<?php
			
			$sql = "SELECT * FROM formdata WHERE 1";
			$result = mysqli_query($connect, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result)){
				
				?>
			
				<tr>
					<td><?=$row['id']?></td>
					<td><?=$row['first_name']?></td>
					<td><?=$row['last_name']?></td>
					<td><?=$row['email']?></td>
					<td><?=$row['address']?></td>
					<td><?=$row['timestamp']?></td>
				</tr>

				<?php
				
				}
			}
			
			?>

        </table>
	</body>
</html>
