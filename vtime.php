<?php
	include('db.php');

	$q2=mysqli_query($connection,"SELECT * FROM worker_time WHERE conf_code=1");
	while($row2=mysqli_fetch_assoc($q2))
	{
		$wkid=$row2['wkid'];
		$uid=$row2['uid'];
		$comid=$row2['comid'];
		$selectdate=$row2['selectdate'];

		$add=date('Y-m-d', strtotime($selectdate. ' + 10 days'));

		//$add1=date('Y-m-d',strtotime('2019-03-30'));

		$curdate=date('Y-m-d');

		if($curdate>$add)
		{
			$update=mysqli_query($connection,"UPDATE complain_master SET conf_code=1 WHERE comid='$comid' ");
			$delete=mysqli_query($connection,"DELETE FROM work_cmp WHERE comid='$comid' ");
			$update2=mysqli_query($connection,"UPDATE worker_time SET conf_code=3 WHERE wkid='$wkid' ");
		}
	}
?>