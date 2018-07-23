<?php
	require('database.php');
	if (!isset($chosenStore)) {$chosenStore = filter_input(INPUT_POST,'storeChoice');} 
	if(!isset($shopDate)) {$shopDate = filter_input(INPUT_POST,'shopdate');}
	if(!isset($shopTime)) {$shopTime = filter_input(INPUT_POST,'shoptime');}
	
	// This query returns a list of stores by Store Type (WM or Traditional). This is used to determine if the store has a DT
	$queryStoreType = "SELECT StoreType FROM StoreData WHERE StoreNumber = :StoreNumber";
    $statement2 = $db->prepare($queryStoreType);
    $statement2->bindValue(':StoreNumber', $chosenStore);
    $statement2->execute();
    $storeType = $statement2->fetch();
		

	$queryStore = "SELECT StoreNumber FROM StoreData ORDER BY StoreNumber";
	$statement1 = $db->prepare($queryStore);
	$statement1->execute();
    $stores = $statement1->fetchall();
?>

<!DOCTYPE html>
<html>  
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			html {background-color: antiquewhite; }	
			#bigButton {width: 150px; font-size: 20px; background-color: black; color: white;text-align: center;vertical-align: middle;}
		</style>
		<title>Stagg Shop Setup</title>
	</head>
		<h1 align="center">Enter Restaurant Information</h1>
	<main>
		<form action="ShopForm.php" method="post"> 
		<fieldset>
			<legend><b>Restaurant Info</b></legend>
			<!--Shop Date, Time and Store are auto filled based on user responses on prior page-->
        		<label>Shop Date:
           			<input type="date" name="shopdate" value="<?php echo $shopDate; ?>" readonly="readonly" >
        		</label>
        		<label>Shop Time:
        			<input type="time" name="shoptime" value="<?php echo $shopTime; ?>" readonly="readonly">
        		</label>    
        		<p>
				<label>Store:</label>
					<select name="storeChoice" >
						<option value="<?php echo $chosenStore; ?>"><?php echo $chosenStore; ?>
						</option>
					</select>
	
			<!--This section checks to see if store is Traditional. Then it populates the choice of FC or DT. Otherwise FC is automatically chosen as a hidden input-->
				<?php if ($storeType['StoreType'] == "Traditional") { ?>
					<label>FC/DT:</label>
					<select name="shoptype" required="<#CDATA#>">
						<option value="FC">FC</option>
						<option value="DT">DT</option>
					</select>
					<?php } else { ?>
	        			<input type="hidden" name="shoptype" value="FC">
	    			<?php } ?>
			
			<!--This is used to pass the store type (WM or Traditional) to the next page-->
				<input type="hidden" name="storetype" value="<?php echo $storeType['StoreType']; ?>">
					<br><br>
			<div align="center">
				<input id="bigButton" type="submit" value="Start Shop">
			</div>
			</fieldset>
		</form>
	</main>
</html>
