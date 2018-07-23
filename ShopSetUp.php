<?php
	#This opens the StaggStoreData database
	require('database.php');
	
	#This returns a list of Store Numbers only to the array $stores
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
		</style>
		<title>Stagg Shop Setup</title>
	</head>
		<h1 align="center">Enter Restaurant Information</h1>
	<main>
		<form action="ShopSetUpPg2.php" method="post"> 
			<fieldset>
				<legend><b>Restaurant Info</b></legend>
        			<label>Shop Date:
           	 			<input type="date" name="shopdate" required="<#CDATA#>" placeholder='YYYY-MM-DD' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))">
        			</label>
        			<br><label>Shop Time:
        				<input type="time" name="shoptime" required="<#CDATA#>">
        			</label>    
        			<p>
<!--This uses the mySQL database to create a list of Store Numbers -->
					<label>Store:</label>
						<select name="storeChoice" required="<#CDATA#>">
							<?php foreach ( $stores as $store) : ?>
								<option value="<?php echo $store['StoreNumber']; ?>">
							<?php echo $store['StoreNumber']; ?>
								</option>
							<?php endforeach; ?>
						</select>
							<input type="submit" value="Submit Store Choice">
		</form>	
	</main>    
</html>
