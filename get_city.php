<?php
	require_once("db.php");
	if(!empty($_POST["city_id"])) 
	{
		$query ="SELECT * FROM city WHERE did= '" . $_POST["city_id"] . "'";
		$results = mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($results)) 
		{
				$resultset[] = $row;
		}
?>
		<option value="">--Select City--</option>
<?php
		foreach($results as $city) {
?>
		<option value="<?php echo $city["cid"]; ?>"><?php echo $city["cname"]; ?></option>
<?php
		}
	}
?>