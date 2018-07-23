<?php
	require('database.php');
//User defined variables from report.html
	$startDate = filter_input(INPUT_POST,'startDate');
	$endDate = filter_input(INPUT_POST, 'endDate');
	$scope = filter_input(INPUT_POST, 'scope');
	$theShopper = filter_input(INPUT_POST, 'theShopper');
?>

<!DOCTYPE html>
<html>
	<head>	
		<style>
			html {background-color: antiquewhite; }
			h2 {text-align: center;}
			label {
            	font-style: oblique;
        			}
			a:link, a:visited {text-decoration: none;}
			a:hover {color: crimson;}
			#bigButton {border: solid; font: bold; background-color: black; color: white; padding: 5px;display: inline-block; text-align: center;}
		</style>
		<title>Report Selection</title>
	</head>
		<body>
			<!--Restating the previous form to allow user to specify which store, supervisor or Ops Mgr to filter report by-->
			<form action=notes.php method="post">
				<label>Enter Start Date:</label>
					<input readonly type="date" name="startDate"  value="<?php echo $startDate; ?>">
				<br>
				<label>Enter End Date:</label>
					<input readonly type="date" name="endDate" value="<?php echo $endDate; ?>">
				<br>
				<label>Shopper:</label>
				 	<select name="theShopper">
				    <option value="<?php echo $theShopper; ?>"><?php echo $theShopper; ?></option>
					</select>  
				<br>
				<label>Report by Store, Supervisor, Operations Manager or Organization?</label>
					<select name="scope">
					   <option value="<?php echo $scope; ?>"><?php echo $scope; ?></option>
					</select>
				<br>
				<!--if user selected the Store Report, this will pull up list of current stores to choose from -->
				<?php if ($scope == "Store") {
						$queryStore = "SELECT StoreNumber FROM StoreData ORDER BY StoreNumber";
						$statement1 = $db->prepare($queryStore);
						$statement1->execute();
   						$stores = $statement1->fetchall();
   						$statement1->closecursor();
   					?>
   				<label>Stores</label>
					<select name="storeChoice" required="<#CDATA#>">
					  <?php foreach ( $stores as $store) : ?>
						<option value="<?php echo $store['StoreNumber']; ?>">
					  <?php echo $store['StoreNumber']; ?>
						</option>
					  <?php endforeach; ?>
					</select>
				<?php 
				//if user selected supervisor this will pull up list of current supervisors to choose from
				} else if ($scope == "Supervisor") {
				        $querySup = "SELECT SupName FROM Supervisor ORDER BY SupName";
						$statement2 = $db->prepare($querySup);
						$statement2->execute();
   						$sups = $statement2->fetchall();
   						$statement2->closecursor();
   					?>
   				<label>Supervisor</label>
					<select name="supChoice" required="<#CDATA#>">
					  <?php foreach ( $sups as $sup) : ?>
						<option value="<?php echo $sup['SupName']; ?>">
					  <?php echo $sup['SupName']; ?>
						</option>
					  <?php endforeach; ?>
					</select>
				<?php 
				//if user selected ops manager this will pull up a list of current supervisors to choose from
				} else if ($scope == "Operations Manager") {
				        $queryOM = "SELECT OMName FROM OpsManager ORDER BY OMName";
						$statement3 = $db->prepare($queryOM);
						$statement3->execute();
   						$oms = $statement3->fetchall();
   						$statement3->closecursor();
   					?>
   				<label>Operations Manager</label>
					<select name="omChoice" required="<#CDATA#>">
					  <?php foreach ( $oms as $om) : ?>
						<option value="<?php echo $om['OMName']; ?>">
					  <?php echo $om['OMName']; ?>
						</option>
					  <?php endforeach; ?>
					</select>
				<?php 
				
				// if the user selected Organization, then no option is selected. the user just needs to generate report
				} else { ?>
				   <input type="hidden" name="orgChoice" value="Stagg">
				
				<?php } ?>
				<br>
				<input id="bigButton" type="submit" value="Generate Report">
			</form>
</html>