<?php

require('database.php');
global $db;

// Parameters chosen by user

	$startDate = filter_input(INPUT_POST,'startDate');
	$endDate = filter_input(INPUT_POST,'endDate');
	$scope = filter_input(INPUT_POST,'scope');
	$storeChoice = filter_input(INPUT_POST,'storeChoice');
	$supChoice = filter_input(INPUT_POST,'supChoice');
	$omChoice = filter_input(INPUT_POST,'omChoice');
	$orgChoice = filter_input(INPUT_POST,'orgChoice');
	$theShopper = filter_input(INPUT_POST,'theShopper');

/* Conditional to create database of shops based on Users parameters. This pulls all the shops withen
 * the user's chosen limits */
if ($theShopper == "Sups") {
	$queryGroup = 'SELECT * FROM ShopData WHERE shopDate >= :startDate and shopDate <= :endDate and shopper != "Ned Stagg" and shopper != "Fabiola Stagg" and shopper != "George McClure" and shopper != "GM" and shopper != "Other" and shopper != "Daniel Hernandez" Order By storeNumber';
	$supShops = $db->prepare($queryGroup);
	$supShops->bindvalue(':startDate', $startDate);
	$supShops->bindvalue(':endDate', $endDate);
	$supShops->execute();
	$totalShops = $supShops->fetchall();
	$supShops->closecursor();
}
else if ($scope == "Organization") {
	$queryDates = 'SELECT * FROM ShopData WHERE shopDate >= :startDate and shopDate <= :endDate and shopper = :theShopper ORDER By storeNumber';
	$allShops = $db->prepare($queryDates);
	$allShops->bindvalue(':startDate', $startDate);
	$allShops->bindvalue(':endDate', $endDate);
	$allShops->bindvalue(':theShopper', $theShopper);
	$allShops->execute();
	$totalShops = $allShops->fetchall();
	$allShops->closecursor();

} else if ($scope == "Operations Manager") {
	$queryDates = 'SELECT * FROM ShopData WHERE shopDate >= :startDate and shopDate <= :endDate and shopper = :theShopper  HAVING opsManager = :opsManager ORDER By storeNumber';
	$allShops = $db->prepare($queryDates);
	$allShops->bindvalue(':startDate', $startDate);
	$allShops->bindvalue(':endDate', $endDate);
	$allShops->bindvalue(':opsManager', $omChoice);
	$allShops->bindvalue(':theShopper', $theShopper);
	$allShops->execute();
	$totalShops = $allShops->fetchall();
	$allShops->closecursor();

} else if ($scope == "Supervisor") { 
	$queryDates = 'SELECT * FROM ShopData WHERE shopDate >= :startDate and shopDate <= :endDate and shopper = :theShopper HAVING supervisor = :supervisor ORDER By storeNumber';
	$allShops = $db->prepare($queryDates);
	$allShops->bindvalue(':startDate', $startDate);
	$allShops->bindvalue(':endDate', $endDate);
	$allShops->bindvalue(':supervisor', $supChoice);
	$allShops->bindvalue(':theShopper', $theShopper);
	$allShops->execute();
	$totalShops = $allShops->fetchall();
	$allShops->closecursor();

} else {
	$queryDates = 'SELECT * FROM ShopData WHERE shopDate >= :startDate and shopDate <= :endDate and shopper = :theShopper HAVING storeNumber = :storeChoice ORDER BY shopDate';
	$allShops = $db->prepare($queryDates);
	$allShops->bindvalue(':startDate', $startDate);
	$allShops->bindvalue(':endDate', $endDate);
	$allShops->bindvalue(':storeChoice', $storeChoice);
	$allShops->bindvalue(':theShopper', $theShopper);
	$allShops->execute();
	$totalShops = $allShops->fetchall();
	$allShops->closecursor();

}

?>


<!DOCTYPE html>
<html>
	<head>
	<style>
		a {text-decoration: none; color: white; border: thin black; background-color: black; padding: 4px;}
		a:hover {color: aqua;}
	 table {border-style: outset;
		 	border-color: black;
		 	border-collapse: collapse;
			border-width: 5px;
			background-color: ivory;}
		tr {border-style: solid #000000;
			border-color: black;
		td {text-align: center;}
		caption {font-size: 25px;}
		
	</style>
	</head>
		<title>
	</title>

<?php 
	
	

	
	function storeRow($theStore, $storeTotalShops) {
		$dtWaitTime = 0;
		$waitTimeCounter = 0;
		$dtResponseTime = 0;
		$responseTimeCounter = 0;
		$dtPresentTime = 0;
		$dtPresentTimeCounter = 0;
		$dtoepTime = 0;
		$oepTimeCounter = 0;
		$dtTotalTime = 0;
		$dtTotalTimeCounter = 0;
		$dtPullForwardTime = 0;
		$dtpfTimeCounter = 0;
		$fcWaitTime = 0;
		$fcWaitTimeCounter = 0;
		$fcDeliveryTimes = 0;
		$fcDeliveryTimeCounter = 0;
		$fcTotalTime = 0;
		$fcTotalTimeCounter = 0;
		$numberDTShops = 0;
		$numberFCShops = 0;
		$possible = 0;
		$actual = 0;
		foreach ($storeTotalShops as $shops) {
			if ($theStore == $shops['storeNumber']) {
				if ($shops['shopType'] == "DT") {
					$numberDTShops = $numberDTShops + 1;
					
					if ($shops['waitTime'] != null) {
						$dtWaitTime = $dtWaitTime + $shops['waitTime'];
						$waitTimeCounter = $waitTimeCounter + 1;
					}
					if ($shops['responseTime'] != null) {
						$dtResponseTime = $dtResponseTime + $shops['responseTime'];
						$responseTimeCounter = $responseTimeCounter + 1;
					}
					if ($shops['presentTime'] != null) {
						$dtPresentTime = $dtPresentTime + $shops['presentTime'];
						$dtPresentTimeCounter = $dtPresentTimeCounter +1;
					}
					if ($shops['oepTime'] != null) {
						$dtoepTime = $dtoepTime + $shops['oepTime'];
						$oepTimeCounter = $oepTimeCounter + 1;
					}
					if ($shops['totalTime'] != null) {
						$dtTotalTime = $dtTotalTime + $shops['totalTime'];
						$dtTotalTimeCounter = $dtTotalTimeCounter + 1;
					}
					if ($shops['pullForward'] == 'Yes') {
						$dtPullForwardTime = $dtPullForwardTime + $shops['pullForwardTime'];
						$dtpfTimeCounter = $dtpfTimeCounter + 1;
					}
					$possible = $possible + $shops['possiblePoints'];
					$actual = $actual + $shops['achievedPoints'];

			
				}else {
					$numberFCShops = $numberFCShops + 1;
					if ($shops['fcWaitTime'] != null) {
						$fcWaitTime = $fcWaitTime + $shops['fcWaitTime'];
						$fcWaitTimeCounter = $fcWaitTimeCounter + 1;
					}
					if ($shops['fcDeliveryTIme'] != null) {
						$fcDeliveryTimes = $fcDeliveryTimes + $shops['fcDeliveryTIme'];
						$fcDeliveryTimeCounter = $fcDeliveryTimeCounter + 1;
					}
					if ($shops{'fcTotalTime'} != null) {
						$fcTotalTime = $fcTotalTime + $shops['fcTotalTime'];
						$fcTotalTimeCounter = $fcTotalTimeCounter + 1;
					}
					$possible = $possible + $shops['possiblePoints'];
					$actual = $actual + $shops['achievedPoints'];
					
		
				}}}
		
?>
		<tr>
			<td><?php echo $theStore; ?></td>
			<?php if ($numberDTShops > 0) { ?>
				<td><?php echo $numberDTShops; ?></td>
				<td><?php echo number_format($dtWaitTime/$waitTimeCounter); ?></td>
				<td><?php echo number_format($dtResponseTime/$responseTimeCounter); ?></td>
				<td><?php echo number_format($dtPresentTime/$dtPresentTimeCounter); ?></td>
				<td><?php echo number_format($dtoepTime/$oepTimeCounter); ?></td>
				<td><?php echo number_format($dtTotalTime/$dtTotalTimeCounter); ?></td>
				<td><?php echo $dtpfTimeCounter; ?></td>
				<td><?php if ($dtpfTimeCounter > 0) {
								echo number_format($dtPullForwardTime/$dtpfTimeCounter);} ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>

			<?php } 
			if ($numberFCShops >0) { ?>
				<td><?php echo $numberFCShops; ?></td>
				<td><?php echo number_format($fcWaitTime/$fcWaitTimeCounter); ?></td>
				<td><?php echo number_format($fcDeliveryTimes/$fcDeliveryTimeCounter); ?></td>
				<td><?php echo number_format($fcTotalTime/$fcTotalTimeCounter); ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
				<?php } ?>
				<td><?php echo number_format((($actual/$possible)*100),2).'%'; ?></td>
		</tr>
	<?php } ?>
<?php 		

	function supRow($theSup, $totalShops) {
	$dtWaitTime = 0;
	$waitTimeCounter = 0;
	$dtResponseTime = 0;
	$responseTimeCounter = 0;
	$dtPresentTime = 0;
	$dtPresentTimeCounter = 0;
	$dtoepTime = 0;
	$oepTimeCounter = 0;
	$dtTotalTime = 0;
	$dtTotalTimeCounter = 0;
	$dtPullForwardTime = 0;
	$dtpfTimeCounter = 0;
	$fcWaitTime = 0;
	$fcWaitTimeCounter = 0;
	$fcDeliveryTimes = 0;
	$fcDeliveryTimeCounter = 0;
	$fcTotalTime = 0;
	$fcTotalTimeCounter = 0;
	$numberDTShops = 0;
	$numberFCShops = 0;
		$possible = 0;
		$actual = 0;
		foreach ($totalShops as $supShops) {
			if ($theSup == $supShops['supervisor']){
			$storelist[] = $supShops['storeNumber'];
			}}
			$finalStoreList = array_merge(array_flip(array_flip($storelist)));
		foreach ($finalStoreList as $aStore) {
			storeRow($aStore, $totalShops);
			}
		foreach ($totalShops as $supShops) {
			if ($supShops['shopType'] == "DT" && $supShops['supervisor'] == $theSup) {
				$numberDTShops = $numberDTShops + 1;
				if ($supShops['waitTime'] != null) {
						$dtWaitTime = $dtWaitTime + $supShops['waitTime'];
						$waitTimeCounter = $waitTimeCounter + 1;
					}
					if ($supShops['responseTime'] != null) {
						$dtResponseTime = $dtResponseTime + $supShops['responseTime'];
						$responseTimeCounter = $responseTimeCounter + 1;
					}
					if ($supShops['presentTime'] != null) {
						$dtPresentTime = $dtPresentTime + $supShops['presentTime'];
						$dtPresentTimeCounter = $dtPresentTimeCounter +1;
					}
					if ($supShops['oepTime'] != null) {
						$dtoepTime = $dtoepTime + $supShops['oepTime'];
						$oepTimeCounter = $oepTimeCounter + 1;
					}
					if ($supShops['totalTime'] != null) {
						$dtTotalTime = $dtTotalTime + $supShops['totalTime'];
						$dtTotalTimeCounter = $dtTotalTimeCounter + 1;
					}
					if ($supShops['pullForward'] == 'Yes') {
						$dtPullForwardTime = $dtPullForwardTime + $supShops['pullForwardTime'];
						$dtpfTimeCounter = $dtpfTimeCounter + 1;
					}
					$possible = $possible + $supShops['possiblePoints'];
					$actual = $actual + $supShops['achievedPoints'];

			
			}else if ($supShops['shopType'] == "FC" && $supShops['supervisor'] == $theSup){
				$numberFCShops = $numberFCShops + 1;
				if ($supShops['fcWaitTime'] != null) {
						$fcWaitTime = $fcWaitTime + $supShops['fcWaitTime'];
						$fcWaitTimeCounter = $fcWaitTimeCounter + 1;
					}
					if ($supShops['fcDeliveryTIme'] != null) {
						$fcDeliveryTimes = $fcDeliveryTimes + $supShops['fcDeliveryTIme'];
						$fcDeliveryTimeCounter = $fcDeliveryTimeCounter + 1;
					}
					if ($supShops{'fcTotalTime'} != null) {
						$fcTotalTime = $fcTotalTime + $supShops['fcTotalTime'];
						$fcTotalTimeCounter = $fcTotalTimeCounter + 1;
					}
					$possible = $possible + $supShops['possiblePoints'];
					$actual = $actual + $supShops['achievedPoints'];

		
			}}
		
?>
		<tr style="background-color:azure">
			<td><b><?php echo $theSup; ?></b></td>
				<?php if ($numberDTShops > 0) { ?>
				<td><?php echo $numberDTShops; ?></td>
				<td><?php echo number_format($dtWaitTime/$waitTimeCounter); ?></td>
				<td><?php echo number_format($dtResponseTime/$responseTimeCounter); ?></td>
				<td><?php echo number_format($dtPresentTime/$dtPresentTimeCounter); ?></td>
				<td><?php echo number_format($dtoepTime/$oepTimeCounter); ?></td>
				<td><?php echo number_format($dtTotalTime/$dtTotalTimeCounter); ?></td>
				<td><?php echo $dtpfTimeCounter; ?></td>
				<td><?php if ($dtpfTimeCounter > 0) {
								echo number_format($dtPullForwardTime/$dtpfTimeCounter);} ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>

			<?php } 
			if ($numberFCShops >0) { ?>
				<td><?php echo $numberFCShops; ?></td>
				<td><?php echo number_format($fcWaitTime/$fcWaitTimeCounter); ?></td>
				<td><?php echo number_format($fcDeliveryTimes/$fcDeliveryTimeCounter); ?></td>
				<td><?php echo number_format($fcTotalTime/$fcTotalTimeCounter); ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
			<?php } ?>
				<td><?php echo number_format((($actual/$possible)*100),2).'%'; ?></td>
		</tr>
		<tr>
			<td colspan="14" bgcolor="black"></td>
		</tr><br>
<?php } 

	
	function omRow($theOM, $totalShops) {
	$dtWaitTime = 0;
	$waitTimeCounter = 0;
	$dtResponseTime = 0;
	$responseTimeCounter = 0;
	$dtPresentTime = 0;
	$dtPresentTimeCounter = 0;
	$dtoepTime = 0;
	$oepTimeCounter = 0;
	$dtTotalTime = 0;
	$dtTotalTimeCounter = 0;
	$dtPullForwardTime = 0;
	$dtpfTimeCounter = 0;
	$fcWaitTime = 0;
	$fcWaitTimeCounter = 0;
	$fcDeliveryTimes = 0;
	$fcDeliveryTimeCounter = 0;
	$fcTotalTime = 0;
	$fcTotalTimeCounter = 0;
	$numberDTShops = 0;
	$numberFCShops = 0;
		$possible = 0;
		$actual = 0;
		foreach ($totalShops as $omShops) {
			if ($theOM == $omShops['opsManager']) {
			$supList[] = $omShops['supervisor'];
			}}
			$finalSupList = array_merge(array_flip(array_flip($supList)));
		foreach ($finalSupList as $aSup) {
			supRow($aSup, $totalShops);
			}
		foreach ($totalShops as $omShops) {
			if ($omShops['shopType'] == "DT" && $omShops['opsManager'] == $theOM) {
				$numberDTShops = $numberDTShops + 1;
				if ($omShops['waitTime'] != null) {
						$dtWaitTime = $dtWaitTime + $omShops['waitTime'];
						$waitTimeCounter = $waitTimeCounter + 1;
					}
					if ($omShops['responseTime'] != null) {
						$dtResponseTime = $dtResponseTime + $omShops['responseTime'];
						$responseTimeCounter = $responseTimeCounter + 1;
					}
					if ($omShops['presentTime'] != null) {
						$dtPresentTime = $dtPresentTime + $omShops['presentTime'];
						$dtPresentTimeCounter = $dtPresentTimeCounter +1;
					}
					if ($omShops['oepTime'] != null) {
						$dtoepTime = $dtoepTime + $omShops['oepTime'];
						$oepTimeCounter = $oepTimeCounter + 1;
					}
					if ($omShops['totalTime'] != null) {
						$dtTotalTime = $dtTotalTime + $omShops['totalTime'];
						$dtTotalTimeCounter = $dtTotalTimeCounter + 1;
					}
					if ($omShops['pullForward'] == 'Yes') {
						$dtPullForwardTime = $dtPullForwardTime + $omShops['pullForwardTime'];
						$dtpfTimeCounter = $dtpfTimeCounter + 1;
					}
					$possible = $possible + $omShops['possiblePoints'];
					$actual = $actual + $omShops['achievedPoints'];

			} else if ($omShops['shopType'] == "FC" && $omShops['opsManager'] == $theOM) {
				$numberFCShops = $numberFCShops + 1;
				if ($omShops['fcWaitTime'] != null) {
						$fcWaitTime = $fcWaitTime + $omShops['fcWaitTime'];
						$fcWaitTimeCounter = $fcWaitTimeCounter + 1;
					}
					if ($omShops['fcDeliveryTIme'] != null) {
						$fcDeliveryTimes = $fcDeliveryTimes + $omShops['fcDeliveryTIme'];
						$fcDeliveryTimeCounter = $fcDeliveryTimeCounter + 1;
					}
					if ($omShops{'fcTotalTime'} != null) {
						$fcTotalTime = $fcTotalTime + $omShops['fcTotalTime'];
						$fcTotalTimeCounter = $fcTotalTimeCounter + 1;
					}
					$possible = $possible + $omShops['possiblePoints'];
					$actual = $actual + $omShops['achievedPoints'];

		
			}}
		
?>
		<tr style="background-color: azure">
			<td><b><?php echo $theOM; ?></b></td>
			<?php if ($numberDTShops > 0) { ?>
				<td><?php echo $numberDTShops; ?></td>
				<td><?php echo number_format($dtWaitTime/$waitTimeCounter); ?></td>
				<td><?php echo number_format($dtResponseTime/$responseTimeCounter); ?></td>
				<td><?php echo number_format($dtPresentTime/$dtPresentTimeCounter); ?></td>
				<td><?php echo number_format($dtoepTime/$oepTimeCounter); ?></td>
				<td><?php echo number_format($dtTotalTime/$dtTotalTimeCounter); ?></td>
				<td><?php echo $dtpfTimeCounter; ?></td>
				<td><?php if ($dtpfTimeCounter > 0) {
								echo number_format($dtPullForwardTime/$dtpfTimeCounter);} ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>

			<?php } 
			if ($numberFCShops >0) { ?>
				<td><?php echo $numberFCShops; ?></td>
				<td><?php echo number_format($fcWaitTime/$fcWaitTimeCounter); ?></td>
				<td><?php echo number_format($fcDeliveryTimes/$fcDeliveryTimeCounter); ?></td>
				<td><?php echo number_format($fcTotalTime/$fcTotalTimeCounter); ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
				<?php } ?>
				<td><?php echo number_format((($actual/$possible)*100),2).'%'; ?></td>
		</tr>
		<td colspan="14" bgcolor="black"></td>
<?php } 

	function orgRow($theOrg, $totalShops) {
		$dtWaitTime = 0;
		$waitTimeCounter = 0;
		$dtResponseTime = 0;
		$responseTimeCounter = 0;
		$dtPresentTime = 0;
		$dtPresentTimeCounter = 0;
		$dtoepTime = 0;
		$oepTimeCounter = 0;
		$dtTotalTime = 0;
		$dtTotalTimeCounter = 0;
		$dtPullForwardTime = 0;
		$dtpfTimeCounter = 0;
		$fcWaitTime = 0;
		$fcWaitTimeCounter = 0;
		$fcDeliveryTimes = 0;
		$fcDeliveryTimeCounter = 0;
		$fcTotalTime = 0;
		$fcTotalTimeCounter = 0;
		$numberDTShops = 0;
		$numberFCShops = 0;
		$possible = 0;
		$actual = 0;
		foreach ($totalShops as $orgShops) {
			$omList[] = $orgShops['opsManager'];
			//The commented out code below was to capture stores that did not have an OM assigned. I think i fixed it by adding "Not Ali" as an OM
			//if (is_null($orgShops['opsManager'])) {
			//	$noOmList[] = $orgShops['supervisor'];
			//	}
			}
			$finalOMList = array_merge(array_flip(array_flip($omList)));
			//$finalNoOmList = array_merge(array_flip(array_flip($noOmList)));
		//foreach ($finalNoOmList as $noOm) {
			//supRow($noOm, $totalShops);
		//}
		foreach ($finalOMList as $aOM) {
			omRow($aOM, $totalShops);
			}
		foreach ($totalShops as $orgShops) {
			if ($orgShops['shopType'] == "DT") {
				$numberDTShops = $numberDTShops + 1;
				if ($orgShops['waitTime'] != null) {
						$dtWaitTime = $dtWaitTime + $orgShops['waitTime'];
						$waitTimeCounter = $waitTimeCounter + 1;
					}
					if ($orgShops['responseTime'] != null) {
						$dtResponseTime = $dtResponseTime + $orgShops['responseTime'];
						$responseTimeCounter = $responseTimeCounter + 1;
					}
					if ($orgShops['presentTime'] != null) {
						$dtPresentTime = $dtPresentTime + $orgShops['presentTime'];
						$dtPresentTimeCounter = $dtPresentTimeCounter +1;
					}
					if ($orgShops['oepTime'] != null) {
						$dtoepTime = $dtoepTime + $orgShops['oepTime'];
						$oepTimeCounter = $oepTimeCounter + 1;
					}
					if ($orgShops['totalTime'] != null) {
						$dtTotalTime = $dtTotalTime + $orgShops['totalTime'];
						$dtTotalTimeCounter = $dtTotalTimeCounter + 1;
					}
					if ($orgShops['pullForward'] == 'Yes') {
						$dtPullForwardTime = $dtPullForwardTime + $orgShops['pullForwardTime'];
						$dtpfTimeCounter = $dtpfTimeCounter + 1;
					}
					$possible = $possible + $orgShops['possiblePoints'];
					$actual = $actual + $orgShops['achievedPoints'];

			}else {
				$numberFCShops = $numberFCShops + 1;
				if ($orgShops['fcWaitTime'] != null) {
						$fcWaitTime = $fcWaitTime + $orgShops['fcWaitTime'];
						$fcWaitTimeCounter = $fcWaitTimeCounter + 1;
					}
					if ($orgShops['fcDeliveryTIme'] != null) {
						$fcDeliveryTimes = $fcDeliveryTimes + $orgShops['fcDeliveryTIme'];
						$fcDeliveryTimeCounter = $fcDeliveryTimeCounter + 1;
					}
					if ($orgShops{'fcTotalTime'} != null) {
						$fcTotalTime = $fcTotalTime + $orgShops['fcTotalTime'];
						$fcTotalTimeCounter = $fcTotalTimeCounter + 1;
					}
					$possible = $possible + $orgShops['possiblePoints'];
					$actual = $actual + $orgShops['achievedPoints'];

			}}
		
?>
		<tr style="background-color: azure">
			<td><b>SR LLC</b></td>
			<?php if ($numberDTShops > 0) { ?>
				<td><?php echo $numberDTShops; ?></td>
				<td><?php echo number_format($dtWaitTime/$waitTimeCounter); ?></td>
				<td><?php echo number_format($dtResponseTime/$responseTimeCounter); ?></td>
				<td><?php echo number_format($dtPresentTime/$dtPresentTimeCounter); ?></td>
				<td><?php echo number_format($dtoepTime/$oepTimeCounter); ?></td>
				<td><?php echo number_format($dtTotalTime/$dtTotalTimeCounter); ?></td>
				<td><?php echo $dtpfTimeCounter; ?></td>
				<td><?php if ($dtpfTimeCounter > 0) {
								echo number_format($dtPullForwardTime/$dtpfTimeCounter);} ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>

			<?php } 
			if ($numberFCShops >0) { ?>
				<td><?php echo $numberFCShops; ?></td>
				<td><?php echo number_format($fcWaitTime/$fcWaitTimeCounter); ?></td>
				<td><?php echo number_format($fcDeliveryTimes/$fcDeliveryTimeCounter); ?></td>
				<td><?php echo number_format($fcTotalTime/$fcTotalTimeCounter); ?></td>
			<?php } else { ?>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
					<td><?php echo 0; ?></td>
				<?php } ?>
				<td><?php echo number_format((($actual/$possible)*100),2).'%'; ?></td>
		</tr>
<?php }
?>


		
	<table border="solid">
		<caption><b>Stagg McService Shop Report</b></caption>
		<tr style="background-color:antiquewhite">
			<th>Store</th>
			<th># DT Shops</th>
			<th>Avg Wait</th>
			<th>Avg Response</th>
			<th>Avg Present</th>
			<th>Avg OEP</th>
			<th>Avg Total</th>
			<th># Pulled Fwd</th>
			<th>Avg PF TIme</th>
			<th># FC Shops</th>
			<th>Avg FC Wait</th>
			<th>Avg FC Delivery</th>
			<th>Avg FC Total</th>	
			<th>Score</th>
		</tr>
<?php
			if ($scope == "Store") {
				storeRow($storeChoice, $totalShops);
				} else if ($scope == "Supervisor") {
					supRow($supChoice, $totalShops);
				} else if ($scope == "Operations Manager") {
					omRow($omChoice, $totalShops);
				} else {
					orgRow($orgChoice,$totalShops); 
				} 
?>
		
	</table>	
<br><br>
<a href="index.html">Back To McService Shop Main Page</a>
<br><br>
<a href="store.html">Back To Restaurant Main Page</a>
</html>