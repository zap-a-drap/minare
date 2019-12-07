<?php
include_once 'database.php';
$result = mysqli_query($conn,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
	<title> Retrive data</title>
	<style type="text/css">
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;

		}

		tr:nth-child(even) {
			background-color: white;
		}

	</style>
</head>
<body>
	<?php
	if (mysqli_num_rows($result) > 0) {
		?>
		<table>

			<tr>
				<td>MINARE ID</td>
				<td>Name</td>
				<td>College Name</td>
				<td>Address</td>
				<td>Email id</td>
				<td>Campus Ambassador</td>
				<td>Gender</td>
			</tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
				?>
				<tr>
					<td><?php echo $row["user_id"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["college"]; ?></td>
					<td><?php echo $row["address"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["ca"]; ?></td>
					<td><?php echo $row["gender"]; ?></td>
				</tr>
				<?php
				$i++;
			}
			?>
		</table>
		<?php
	}
	else{
		echo "No result found";
	}
	?>
</body>
</html>