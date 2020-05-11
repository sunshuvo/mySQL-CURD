<?php
	$dbhost="localhost";
	$dbuser="dbtest";
	$dbpass="dbtest";
	$dbname="testdb";
	$connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	if(!mysqli_connect_errno()){
		echo "Mysql successfully connected...";
	}
	else{
		die("There are some error to connect Mysql. Error:".mysqli_connect_error()."<br>");
	}

	if(!isset($_POST["insert"])){$_POST["insert"]=null;}
	if($_POST["insert"]=="Insert"){
		//print_r($_POST);
		$insert_menu=$_POST["insert_menu"];		$insert_menu=mysqli_real_escape_string($connect,$insert_menu);
		$insert_position=(int) $_POST["insert_position"];
		$insert_visibility=(int) $_POST["insert_visibility"];
		
		$qry_insert  = "Insert into test_table ";
		$qry_insert .= "(menu_name, position, visibility) values ";
		$qry_insert .= "('$insert_menu',$insert_position, $insert_visibility)";
		if(!empty($insert_menu)){
			$insert = mysqli_query($connect,$qry_insert);
		}
	}

	if(!isset($_POST["update"])){$_POST["update"]=null;}
	if($_POST["update"]=="Update"){
		//print_r($_POST);
		$previous_menu=$_POST["previous_menu"];		$previous_menu=mysqli_real_escape_string($connect,$previous_menu);
		$update_menu=$_POST["update_menu"];		$update_menu=mysqli_real_escape_string($connect,$update_menu);
		$update_position=(int) $_POST["update_position"];
		$update_visibility=(int) $_POST["update_visibility"];
		
		$qry_update  = "update test_table set ";
		$qry_update .= "menu_name = '$update_menu', ";
		$qry_update .= "position = $update_position, ";
		$qry_update .= "visibility = $update_visibility ";
		$qry_update .= "where menu_name = '$previous_menu'";
		
		$chk_menu  = "select menu_name from test_table ";
		$chk_menu .= "where menu_name='$previous_menu'";
		$chk_menu_query = mysqli_query($connect,$chk_menu);
		
		if((mysqli_num_rows($chk_menu_query)==1)){
			mysqli_free_result($chk_menu_query);
			$update = mysqli_query($connect,$qry_update);
		}
		else{
			mysqli_free_result($chk_menu_query);
		}
	}

	if(!isset($_POST["delete"])){$_POST["delete"]=null;}
	if($_POST["delete"]=="Delete"){
		//print_r($_POST);
		$delete_menu=$_POST["delete_menu"];		$delete_menu=mysqli_real_escape_string($connect,$delete_menu);
		
		$qry_delete  = "delete from test_table ";
		$qry_delete .= "where menu_name = '$delete_menu'";
		
		$chk_menu  = "select menu_name from test_table ";
		$chk_menu .= "where menu_name='$delete_menu'";
		$chk_menu_query = mysqli_query($connect,$chk_menu);
		
		if(mysqli_num_rows($chk_menu_query)==1){
			mysqli_free_result($chk_menu_query);
			$delete = mysqli_query($connect,$qry_delete);
		}
		else{
			mysqli_free_result($chk_menu_query);
		}
	}
?>
	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mysql all in form</title>
<link rel="stylesheet" type="text/css" href="css/mysqlALL.css">
</head>

<body>

<div width=100%>
	<h2>Mysql Read, Insert, Update and Delete using form. This experiment page created by Md. Tarikul Islam</h2>
</div>
	
<div class="content">

	<div class="cud">
		<div>
			<h3>Mysql Table Insert</h3>
			<hr>
			<form action="mysqlALL.php" method="post">
				Menu:<input type="text" name="insert_menu" value=""><br>
				position: <input type="text" name="insert_position" value=""><br>
				Visibility: <input type="text" name="insert_visibility" value=""><br>
				<input type="submit" name="insert" value="Insert">
			</form>
			<?php
				if(isset($insert)){
					if($insert){
						echo "<br>";
						echo "<strong>Mysql Query:</strong> $qry_insert<br>";
							echo "Menu successfully created";
					}
					else{
						echo "<br>";
						echo "<strong>Mysql Query:</strong> $qry_insert<br>";
						die("There some error to create");

					}
				}
				if(!isset($insert) && $_POST["insert"]=="Insert"){
					echo "<br>";
					echo "Menu can not be blank";
				}
				?>
		</div>

		<div>
			<h3>Mysql Table Update</h3>
			<hr>
			<form action="mysqlALL.php" method="post">
				Previous Menu :<input type="text" name="previous_menu" value=""><br>
				New Menu:<input type="text" name="update_menu" value=""><br>
				New Position:<input type="text" name="update_position" value=""><br>
				New Visibility:<input type="text" name="update_visibility" value=""><br>
				<input type="submit" name="update" value="Update">
				<?php
					if(isset($update)){
						if($update){
							echo "<br>";
							echo "<strong>Mysql Query:</strong> $qry_update<br>";
							echo "Table Successfully updated";
						}
						else{
							echo "<br>";
							echo "<strong>Mysql Query:</strong> $qry_update<br>";
							die("There some error to update");

						}
					}
					if(!isset($update) && $_POST["update"]=="Update"){
						echo "<br>";
						echo "Menu name not match";
					}
				?>
			</form>
		</div>
		
		<div>
			<h3>Mysql Table Delete</h3>
			<hr>
			<form action="mysqlALL.php" method="post">
				Menu:<input type="text" name="delete_menu" value=""><br>
				<input type="submit" name="delete" value="Delete">
			</form>
			<?php
				if(isset($delete)){
					if($delete){
						echo "<br>";
						echo "<strong>Mysql Query:</strong> $qry_delete<br>";
						echo "Table Successfully deleted";
					}
					else{
						echo "<br>";
						echo "<strong>Mysql Query:</strong> $qry_delete<br>";
						die("There some error to delete");

					}
				}
				if(!isset($delete) && $_POST["delete"]=="Delete"){
					echo "<br>";
					echo "Menu name not match";
				}
				?>
		</div>
		
	</div>
	
	<div class="read">
		<div class="table">
		<h3>Mysql Table Read</h3>
		<hr>
		
			<div class="tableROW">
				<div class="tableCUL"><strong>Menu</strong></div>
				<div class="tableCUL" style= text-align:center><strong>Position</strong></div>
				<div class="tableCUL" style= text-align:center><strong>Visibility</strong></div>
			</div>
			
			
			<?php
			
			$id_query = "select id from test_table";
			$id_res = mysqli_query($connect,$id_query);		
			
			while($row=mysqli_fetch_assoc($id_res)){
				$id = $row["id"];
				echo "<div class=\"tableROW\">";
				
				$read  = "select * from test_table ";
				$read .= "where id=$id ";
				//$read .= "order by menu_name ASC";
			
				$read_result= mysqli_query($connect,$read);
				if($read_result){
					$read_row=mysqli_fetch_assoc($read_result);
					echo "<div class=\"tableCUL\">";
					echo $read_row["menu_name"];
					echo "</div>";
					mysqli_free_result($read_result);
				}
				else{die("There are some error to Read Mysql Table");}
		
				$read_result= mysqli_query($connect,$read);
				
				if($read_result){
					$read_row=mysqli_fetch_assoc($read_result);
					echo "<div class=\"tableCUL\" style= text-align:center>";
					echo $read_row["position"];
					echo "</div>";

				}
				else{die("There are some error to Read Mysql Table");}

				$read_result= mysqli_query($connect,$read);
				if($read_result){
					$read_row=mysqli_fetch_assoc($read_result);
					echo "<div class=\"tableCUL\" style= text-align:center>";
					echo $read_row["visibility"];
					echo "</div>";
				}
				else{die("There are some error to Read Mysql Table");}
			echo "</div>";
			}
			
			?>
			
		</div>
	</div>
		
		
			
	</div>
</div>

<?php mysqli_close($connect); ?>
</body>
</html>