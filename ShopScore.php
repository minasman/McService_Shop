<?php
	require('database.php');

	//This buffers the webpage in order to save to a file and send to email later
	ob_start();
	
	//These variables store the shoppers answers from previous page
    $shopDate = filter_input(INPUT_POST,'shopdate');
	$shopTime = filter_input(INPUT_POST,'shoptime');
	$storeOption = filter_input(INPUT_POST,'storeOption');
	$shiftManagerName = filter_input(INPUT_POST,'shiftManagerName');
	$storeType = filter_input(INPUT_POST,'storeType');
	$shopType = filter_input(INPUT_POST,'shopType');
	$upFront = filter_input(INPUT_POST,'upFront');
    $mgrAppearance = filter_input(INPUT_POST,'mgrAppearance');
    $headset = filter_input(INPUT_POST,'headset');
    $crewAppearance = filter_input(INPUT_POST,'crewAppearance');
    $r2d2charts = filter_input(INPUT_POST,'r2d2charts');
    $rdm = filter_input(INPUT_POST,'rdm');
    $kiosks = filter_input(INPUT_POST,'kiosks');
    $tableService = filter_input(INPUT_POST,'tableService');
    $tableTent = filter_input(INPUT_POST,'tableTent');
	$waitTime = filter_input(INPUT_POST,'waitTime');
	$responseTime = filter_input(INPUT_POST,'responseTime');
	$presentTime = filter_input(INPUT_POST,'presentTime');
    $oepTime = filter_input(INPUT_POST,'oepTime');
    $totalTime = filter_input(INPUT_POST,'totalTime');
    $pullForward = filter_input(INPUT_POST,'pullForward');
    $pullForwardTime = filter_input(INPUT_POST,'pullForwardTime');
    $numberCars = filter_input(INPUT_POST,'numberCars');
    $tandem = filter_input(INPUT_POST,'tandem');
    $completeOrder = filter_input(INPUT_POST,'completeOrder');
    $condiment = filter_input(INPUT_POST,'condiment');
    $condimentBag = filter_input(INPUT_POST,'condimentBag');
    $readerBoard = filter_input(INPUT_POST,'readerBoard');
    $marketing = filter_input(INPUT_POST,'marketing');
    $dtCommentNumber = filter_input(INPUT_POST,'dtCommentNumber');  
    $presell = filter_input(INPUT_POST,'presell');
    $upsell = filter_input(INPUT_POST,'upsell');
    $repeatOrderAsk = filter_input(INPUT_POST,'repeatOrderAsk');
    $cashierGreeting = filter_input(INPUT_POST,'cashierGreeting');
    $cashierAsk = filter_input(INPUT_POST,'cashierAsk');
    $presenterGreeting = filter_input(INPUT_POST,'presenterGreeting');
    $presenterTell = filter_input(INPUT_POST,'presenterTell');
    $pfTell = filter_input(INPUT_POST,'pfTell');
    $fresh = filter_input(INPUT_POST,'fresh');
    $friesGood = filter_input(INPUT_POST,'friesGood');
    $drinkGood = filter_input(INPUT_POST,'drinkGood');
    $codClean = filter_input(INPUT_POST,'codClean');
    $dtClean = filter_input(INPUT_POST,'dtClean');
    $lotClean = filter_input(INPUT_POST,'lotClean');
    $corralClean = filter_input(INPUT_POST,'corralClean');
    $lidsClosed = filter_input(INPUT_POST,'lidsClosed');
    $dtGlassClean = filter_input(INPUT_POST,'dtGlassClean');
    $windowsClean = filter_input(INPUT_POST,'windowsClean');
    $trashFull = filter_input(INPUT_POST,'trashFull');
    $commentSignVisible = filter_input(INPUT_POST,'commentSignVisible');
    $floorClean = filter_input(INPUT_POST,'floorClean');
    $tableClean = filter_input(INPUT_POST,'tableClean');
    $drinkClean = filter_input(INPUT_POST,'drinkClean');
    $popcornClean = filter_input(INPUT_POST,'popcornClean');
    $ventsClean = filter_input(INPUT_POST,'ventsClean');
    $sanitizer = filter_input(INPUT_POST,'sanitizer');
    $tvOn = filter_input(INPUT_POST,'tvOn');
    $restroomClean = filter_input(INPUT_POST,'restroomClean');
    $insideTrash = filter_input(INPUT_POST,'insideTrash');
    $crewRoom = filter_input(INPUT_POST,'crewRoom');
    $uhctimer = filter_input(INPUT_POST,'uhctimer');
    $prepTimer = filter_input(INPUT_POST,'prepTimer');
    $bunTimer = filter_input(INPUT_POST,'bunTimer');
    $pieTimer = filter_input(INPUT_POST,'pieTimer');
    $saladTimer = filter_input(INPUT_POST,'saladTimer');
    $theShopper = filter_input(INPUT_POST,'theShopper');
    $fcWaitTime = filter_input(INPUT_POST,'fcWaitTime');
    $fcDeliveryTime = filter_input(INPUT_POST,'fcDeliveryTime');
    $fcTotalTime = filter_input(INPUT_POST,'fcTotalTime');
    $numberGuests = filter_input(INPUT_POST,'numberGuests');
    $popcornFull = filter_input(INPUT_POST,'popcornFull');
	$shiftMgrComment = filter_input(INPUT_POST,'shiftMgrComment');
	$fastComment = filter_input(INPUT_POST,'fastComment');
	$itemsOrdered = filter_input(INPUT_POST,'itemsOrdered');
	$otName = filter_input(INPUT_POST,'otName');
	$cashierName = filter_input(INPUT_POST,'cashierName');
	$presenterName = filter_input(INPUT_POST,'presenterName');
	$pullForwardPresenterName = filter_input(INPUT_POST,'pullForwardPresenterName');
	$hospitalityComment = filter_input(INPUT_POST,'hospitalityComment');
	$qualityComment = filter_input(INPUT_POST,'qualityComment');
	$cleanComment = filter_input(INPUT_POST,'cleanComment');
	$foodSafetyComment = filter_input(INPUT_POST,'foodSafetyComment');
	$accuracyComment = filter_input(INPUT_POST,'accuracyComment');
	$tenderCorrect = filter_input(INPUT_POST, 'tenderCorrect');
	$tenderDate = filter_input(INPUT_POST, 'tenderDate');
	$qtrCorrect = filter_input(INPUT_POST, 'qtrCorrect');
	$qtrDate = filter_input(INPUT_POST, 'qtrDate');
	$glove = filter_input(INPUT_POST, 'glove');
	$tenderTime = filter_input(INPUT_POST, 'tenderTime');
	$qtrTime = filter_input(INPUT_POST, 'qtrTime');

	$Achieved = 0;
	$Possible = 0;
    $unscored = 0;
	$Score = 0;
	

	$callTheFunction = filter_input(INPUT_GET,'addToDB');
	
	
	//This finds the Supervisor Index, Ops Manager Index, Store Name and Store Email from Database
	$findSupQuery = 'SELECT * FROM StoreData WHERE StoreNumber = :StoreNumber';
	$findSup = $db->prepare($findSupQuery);
	$findSup->bindvalue(':StoreNumber', $storeOption);
	$findSup->execute();
	$sup = $findSup->fetch();
	$supIndex = $sup['SupIndex'];
	$omIndex = $sup['OMIndex'];
	$storeEmail = $sup['StoreEmail'];
	$theStoreName = $sup['StoreName'];
	$findSup->closecursor();
	
	//This finds the Supervisor's Name and email
	$findSupNameQuery = 'SELECT * FROM Supervisor WHERE SupIndex = :SupIndex';
	$findSupName = $db->prepare($findSupNameQuery);
	$findSupName->bindvalue(':SupIndex', $supIndex);
	$findSupName->execute();
	$supName = $findSupName->fetch();
	$theSupName = $supName['SupName'];
	$supEmail = $supName['SupEmail'];
	$findSupName->closecursor();
	
	//This finds the Ops Manager's Name and email
	$findOMNameQuery = 'SELECT * FROM OpsManager WHERE OMIndex = :omIndex';
	$findOMName = $db->prepare($findOMNameQuery);
	$findOMName->bindvalue(':omIndex', $omIndex);
	$findOMName->execute();
	$omName = $findOMName->fetch();
	$theOMName = $omName['OMName'];
	$omEmail = $omName['OMEmail'];
	$findOMName->closecursor();
	
		
	//Following code scores the shop
	if ($upFront == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($upFront == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($mgrAppearance == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($mgrAppearance == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($storeType == "Traditional") {
		if ($headset == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
			}
		else if ($headset == "No") {
			$Possible = $Possible + 1;
			} else {
			$unscored = $unscored + 1;
		}}

	if ($crewAppearance == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($crewAppearance == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($r2d2charts == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($r2d2charts == "No") {
		$Possible = $Possible + 1;
	} else {	
        $unscored = $unscored + 1;
	}

	if ($rdm == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($rdm == "No") {
		$Possible = $Possible + 1;
	} else {	
        $unscored = $unscored + 1;
	}

	if ($kiosks == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($kiosks == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}


	if ($tableService == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($tableService == "No") {
		$Possible = $Possible + 1;
	} else {	
        $unscored = $unscored + 1;
	}


	if ($tableTent == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($tableTent == "No") {
		$Possible = $Possible + 1;
	} else {	
        $unscored = $unscored + 1;
	}
/*echo "SM SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/


	if ($storeType == "Traditional") {
		if ($shopType == "DT") {
			if ($waitTime == null) {
				$unscored = $unscored + 1;
			} else if ($waitTime <= 70) {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else {
				$Possible = $Possible + 1;
			}}}

	if ($storeType == "Traditional") {
		if ($shopType == "DT") {
			if ($responseTime == null) {
				$unscored = $unscored + 1;
			} else if ($responseTime <= 10) {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else {
				$Possible = $Possible + 1;
			}}}

	if ($storeType == "Traditional") {
		if ($shopType == "DT") {
			if($presentTime == null) {
				$unscored = $unscored + 1;
			} else if ($presentTime <= 15) {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else {
				$Possible = $Possible + 1;
			}}} 
	
	if ($storeType == "Traditional") {
		if ($shopType == "DT" ) {
			if ($oepTime == null) {
				$unscored = $unscored + 1;
			} else if ($oepTime <= 240) {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else {
				$Possible = $Possible + 1;
			} }}

	if ($storeType == "Traditional") {
		if ($shopType == "DT") {
			if ($totalTime == null) {
				$unscored = $unscored + 1;
			} else if ($totalTime <= 450) {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else if ($totalTime <= 600) {
				$Possible = $Possible + 2;
			} else {
				$Possible = $Possible + 3;}}}

	if ($storeType == "Traditional") {
		if ($shopType == "DT") {
			if ($tandem == null) {
				$unscored = $unscored + 1;
			} else if ($tandem == "Yes") {
				$Achieved = $Achieved + 1;
				$Possible = $Possible + 1;
			} else if ($tandem == "No") {
				$Possible = $Possible + 1;
			} else {
				$unscored = $unscored + 1;
			}}}
	
	if ($shopType == "FC") {
		if ($fcWaitTime == null) {
			$unscored = $unscored + 1;
		} else if ($fcWaitTime <= 90) {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else {
			$Possible = $Possible + 1;
		} }

	if ($shopType == "FC") {
		if ($fcDeliveryTime == null) {
			$unscored = $unscored + 1;
		} else if ($fcDeliveryTime <= 240)
		{	$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else {
			$Possible = $Possible + 1;
		}} 

	if ($shopType == "FC") {
		if ($fcTotalTime == null) {
			$unscored = $unscored + 1;
			} else if ($fcTotalTime <= 450) {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
			} else if ($fcTotalTime <= 600) {
			$Possible = $Possible + 2;
			} else {
			$Possible = $Possible + 3;
		}}

/*echo "FAST SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/

	if ($storeType == "WM") {
		if ($popcornFull == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($popcornFull == "No") {
			$Possible = $Possible + 1;
		} else {
    	    $unscored = $unscored + 1;
		}}
	
	if ($completeOrder == "Yes") {
		$Achieved = $Achieved + 3;
		$Possible = $Possible + 3;
	} else if ($completeOrder == "No") {
		$Possible = $Possible + 3;
	} else {
        $unscored = $unscored + 1;
	}

	if ($condiment == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($condiment == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($condimentBag == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($condimentBag == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($storeType == "Traditional") {
		if ($readerBoard == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($readerBoard == "No") {
			$Possible = $Possible + 1;
		} else {
   		     $unscored = $unscored + 1;
		}}
		
	if ($marketing == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($marketing == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($storeType == "Traditional") {
		if ($dtCommentNumber == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($dtCommentNumber == "No") {
			$Possible = $Possible + 1;
		} else {
   	     $unscored = $unscored + 1;
		}}

/* echo "ACCURATE SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/

	if ($presell == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($presell == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($upsell == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($upsell == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($repeatOrderAsk == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($repeatOrderAsk == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($shopType == "DT") {
		if ($cashierGreeting == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($cashierGreeting == "No") {
			$Possible = $Possible + 1;
		} else {
      	  $unscored = $unscored + 1;
		}}
		
	if ($shopType == "DT") {
		if ($cashierAsk == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($cashierAsk == "No") {
			$Possible = $Possible + 1;
		} else {
     	   $unscored = $unscored + 1;
		}}
		
	if ($presenterGreeting == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($presenterGreeting == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($presenterTell == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($presenterTell == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($shopType == "DT") {
		if ($pfTell == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($pfTell == "No") {
			$Possible = $Possible + 1;
		} else {
   		    $unscored = $unscored + 1;
		}}

/* echo "HOSPITALITY SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/

	if ($fresh == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($fresh == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($friesGood == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($friesGood == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($drinkGood == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($drinkGood == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
/*echo "QUALITY SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/

	if ($storeType == "Traditional" ) {
		if ($codClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($codClean == "No") {
			$Possible = $Possible + 1;
		} else {
    	    $unscored = $unscored + 1;
		}}
		
	if ($storeType == "Traditional") {
		if ($dtClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($dtClean == "No") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}
		
	if ($storeType == "Traditional") {
		if ($lotClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($lotClean == "No") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}
		
	if ($storeType == "Traditional") {
		if ($corralClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($corralClean == "No") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}
		
	if ($storeType == "Traditional") {
		if ($lidsClosed == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($lidsClosed == "No") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}
		
	if ($storeType == "Traditional") {
		if ($dtGlassClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($dtGlassClean == "No") {
			$Possible = $Possible + 1;
		} else {
      	  $unscored = $unscored + 1;
		}}
		
	if ($windowsClean == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($windowsClean == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($storeType == "Traditional") {
		if ($trashFull == "No") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($trashFull == "Yes") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}
		
	if ($commentSignVisible == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($commentSignVisible == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($floorClean == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($floorClean == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($tableClean == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($tableClean == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($drinkClean == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($drinkClean == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($storeType == "WM") {
		if ($popcornClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($popcornClean == "No") {
			$Possible = $Possible + 1;
		} else {
      	  $unscored = $unscored + 1;
		}}
		
	if ($ventsClean == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($ventsClean == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($sanitizer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($sanitizer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($tvOn == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($tvOn == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($storeType == "Traditional") {
		if ($restroomClean == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($restroomClean == "No") {
			$Possible = $Possible + 1;
		} else {
      	  $unscored = $unscored + 1;
		}}
		
	if ($insideTrash == "No") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($insideTrash == "Yes") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($storeType == "Traditional") {
		if ($crewRoom == "Yes") {
			$Achieved = $Achieved + 1;
			$Possible = $Possible + 1;
		} else if ($crewRoom == "No") {
			$Possible = $Possible + 1;
		} else {
       	 $unscored = $unscored + 1;
		}}

/* echo "CLEAN SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/
		
	if ($uhctimer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($uhctimer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($prepTimer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($prepTimer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($bunTimer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($bunTimer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

	if ($tenderCorrect == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($tenderCorrect == "No") {
		$Possible = $Possible + 1;
	} else {
		$unscored = $unscored + 1; 
	}
	if ($qtrCorrect == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($qtrCorrect == "No") {
		$Possible = $Possible + 1;
	} else {
		$unscored = $unscored + 1; 
	}
	if ($glove == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($glove == "No") {
		$Possible = $Possible + 1;
	} else {
		$unscored = $unscored + 1; 
	}	
	if ($pieTimer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($pieTimer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}
	
	if ($saladTimer == "Yes") {
		$Achieved = $Achieved + 1;
		$Possible = $Possible + 1;
	} else if ($saladTimer == "No") {
		$Possible = $Possible + 1;
	} else {
        $unscored = $unscored + 1;
	}

/* echo "FOOD SAFETY SECTION:  ";
echo "POSSIBLE: " .$Possible;
echo "ACHIEVED: " .$Achieved;
echo "UNSCORED: " .$unscored;
*/
	
	if ($Possible > 0) {
		$Score = $Achieved / $Possible;
		$Score = number_format($Score * 100, 2) . "%";
	}

 $checkForDuplicate = 'SELECT storeNumber, shopDate, shopTime, shopper FROM ShopData WHERE storeNumber = :store';
 $dupList = $db->prepare($checkForDuplicate);
 $dupList->bindValue(':store', $storeOption);
 $dupList->execute();
 $finalDupList = $dupList->fetchall();
 $dupList->closecursor();
 
 $match = false;
 
 foreach ($finalDupList as $dup) {
	// echo($dup["shopDate"]);
	// echo($shopDate); ?><br> <?php
	// echo($dup["shopTime"]);
	// echo($shopTime); ?><br> <?php
	// echo($dup["shopper"]);
	// echo($theShopper); ?><br> <?php
 	if ($dup["shopDate"] == $shopDate && $dup["shopper"] == $theShopper) {
		?><h1>This is a Duplicate Entry</h1> <?php
		$match=true;
		if ($match=='true') {
			break;
		}
 	}
 }

if ($match == false) {
	$addShopToDB = 'INSERT INTO ShopData 
			( `storeName`, `storeNumber`, `shopDate`, `shopTime`, `shopType`, `shiftManager`, `upFront`, `mgrAppearance`, `headset`, `crewAppearance`, 
			`r2d2Charts`, `rdm`, `kiosks`, `tableService`, `tableTent`, `waitTime`, `responseTime`, `presentTime`, `oepTime`, `totalTime`, 
			`pullForward`, `pullForwardTime`, `numberCars`, `tandem`, `completeOrder`, `condiment`, `condimentBag`, `readerboard`, `marketing`, `dtCommentNumber`,
			 `presell`, `upsell`, `repeatOrderAsk`, `cashierGreeting`, `cashierAsk`, `presenterGreet`, `presenterTell`, `pfTell`, `fresh`, `friesGood`,
			`drinkGood`, `codClean`, `dtClean`, `lotClean`, `corralClean`, `lidsClosed`, `dtGlassClean`, `windowsClean`, `trashFull`, `commentSignVisible`,
			 `floorClean`, `tableClean`, `drinkClean`, `popCornClean`, `ventsClean`, `sanitizer`, `tvOn`, `restroomClean`, `insideTrash`, `crewRoom`, 
			 `uhcTimer`, `prepTimer`, `bunTimer`, `pieTimer`, `saladTimer`, `shopper`, `supervisor`, `opsManager`, `possiblePoints`, `unscoredPoints`, 
			 `achievedPoints`, `score`, `fcWaitTime`, `fcDeliveryTime`, `fcTotalTime`, `numberGuests`, `popcornFull`) 
			VALUES 
			(:theStoreName, :storeOption, :shopDate, :shopTime, :shopType, :shiftManagerName,:upFront, :mgrAppearance, :headset, :crewAppearance, 
			:r2d2Charts, :rdm, :kiosks,:tableService, :tableTent, :waitTime, :responseTime, :presentTime, :oepTime, :totalTime, 
			:pullForward, :pullForwardTIme, :numberCars, :tandem, :completeOrder, :condiment, :condimentBag, :readerboard, :marketing, :dtCommentNumber, 
			:presell, :upsell, :repeatOrderAsk, :cashierGreeting, :cashierAsk, :presenterGreet, :presenterTell, :pfTell, :fresh, :friesGood,
			  :drinkGood, :codClean, :dtClean, :lotClean, :corralClean, :lidsClosed, :dtGlassClean, :windowsClean, :trashFull, :commentSignVisible, 
			  :floorClean, :tableClean, :drinkClean, :popcornClean, :ventsClean, :sanitizer, :tvOn, :restroomClean, :insideTrash, :crewRoom, 
			  :uhcTimer, :prepTimer, :bunTimer, :pieTimer, :saladTimer, :theShopper, :theSupName, :theOMName, :Possible, :unscored, 
			  :Achieved, :Score, :fcWaitTime, :fcDeliveryTime, :fcTotalTime, :numberGuests, :popcornFull)';
			  
			  
	$updateShopData = $db->prepare($addShopToDB);
	$updateShopData->bindvalue(':theStoreName', $theStoreName);
	$updateShopData->bindvalue(':storeOption', $storeOption);
	$updateShopData->bindvalue(':shopDate', $shopDate);
	$updateShopData->bindvalue(':shopTime', $shopTime);
	$updateShopData->bindvalue(':shopType', $shopType);
	$updateShopData->bindvalue(':shiftManagerName', $shiftManagerName);
	$updateShopData->bindvalue(':upFront', $upFront);
	$updateShopData->bindvalue(':mgrAppearance', $mgrAppearance);
	$updateShopData->bindvalue(':headset', $headset);
	$updateShopData->bindvalue(':crewAppearance', $crewAppearance);	  
	$updateShopData->bindvalue(':r2d2Charts', $r2d2charts);
	$updateShopData->bindvalue(':rdm', $rdm);
	$updateShopData->bindvalue(':kiosks', $kiosks);
	$updateShopData->bindvalue(':tableService', $tableService);
	$updateShopData->bindvalue(':tableTent', $tableTent);			  
	$updateShopData->bindvalue(':waitTime', $waitTime);
	$updateShopData->bindvalue(':responseTime', $responseTime);
	$updateShopData->bindvalue(':presentTime', $presentTime);
	$updateShopData->bindvalue(':oepTime', $oepTime);
	$updateShopData->bindvalue(':totalTime', $totalTime);		  
	$updateShopData->bindvalue(':pullForward', $pullForward);
	$updateShopData->bindvalue(':pullForwardTIme', $pullForwardTime);
	$updateShopData->bindvalue(':numberCars', $numberCars);
	$updateShopData->bindvalue(':tandem', $tandem);
	$updateShopData->bindvalue(':completeOrder', $completeOrder);
	$updateShopData->bindvalue(':condiment', $condiment);
	$updateShopData->bindvalue(':condimentBag', $condimentBag);
	$updateShopData->bindvalue(':readerboard', $readerBoard);
	$updateShopData->bindvalue(':marketing', $marketing);
	$updateShopData->bindvalue(':dtCommentNumber', $dtCommentNumber);	  
	$updateShopData->bindvalue(':presell', $presell);
	$updateShopData->bindvalue(':upsell', $upsell);
	$updateShopData->bindvalue(':repeatOrderAsk', $repeatOrderAsk);
	$updateShopData->bindvalue(':cashierGreeting', $cashierGreeting);
	$updateShopData->bindvalue(':cashierAsk', $cashierAsk);			  
	$updateShopData->bindvalue(':presenterGreet', $presenterGreeting);
	$updateShopData->bindvalue(':presenterTell', $presenterTell);
	$updateShopData->bindvalue(':pfTell', $pfTell);
	$updateShopData->bindvalue(':fresh', $fresh);
	$updateShopData->bindvalue(':friesGood', $friesGood);				  
	$updateShopData->bindvalue(':drinkGood', $drinkGood);
	$updateShopData->bindvalue(':codClean', $codClean);
	$updateShopData->bindvalue(':dtClean', $dtClean);
	$updateShopData->bindvalue(':lotClean', $lotClean);
	$updateShopData->bindvalue(':corralClean', $corralClean);
	$updateShopData->bindvalue(':lidsClosed', $lidsClosed);
	$updateShopData->bindvalue(':dtGlassClean', $dtGlassClean);
	$updateShopData->bindvalue(':windowsClean', $windowsClean);
	$updateShopData->bindvalue(':trashFull', $trashFull);
	$updateShopData->bindvalue(':commentSignVisible', $commentSignVisible);	  
	$updateShopData->bindvalue(':floorClean', $floorClean);
	$updateShopData->bindvalue(':tableClean', $tableClean);
	$updateShopData->bindvalue(':drinkClean', $drinkClean);
	$updateShopData->bindvalue(':popcornClean', $popcornClean);
	$updateShopData->bindvalue(':ventsClean', $ventsClean);			  
	$updateShopData->bindvalue(':sanitizer', $sanitizer);
	$updateShopData->bindvalue(':tvOn', $tvOn);
	$updateShopData->bindvalue(':restroomClean', $restroomClean);
	$updateShopData->bindvalue(':insideTrash', $insideTrash);
	$updateShopData->bindvalue(':crewRoom', $crewRoom);				  
	$updateShopData->bindvalue(':uhcTimer', $uhctimer);
	$updateShopData->bindvalue(':prepTimer', $prepTimer);
	$updateShopData->bindvalue(':bunTimer', $bunTimer);			  
	$updateShopData->bindvalue(':pieTimer', $pieTimer);
	$updateShopData->bindvalue(':saladTimer', $saladTimer);
	$updateShopData->bindvalue(':theShopper', $theShopper);
	$updateShopData->bindvalue(':theSupName', $theSupName);
	$updateShopData->bindvalue(':theOMName', $theOMName);
	$updateShopData->bindvalue(':Possible', $Possible);
	$updateShopData->bindvalue(':unscored', $unscored);
	$updateShopData->bindvalue(':Achieved', $Achieved);
	$updateShopData->bindvalue(':Score', $Score);
	$updateShopData->bindvalue(':fcWaitTime', $fcWaitTime);
	$updateShopData->bindvalue(':fcDeliveryTime', $fcDeliveryTime);
	$updateShopData->bindvalue(':fcTotalTime', $fcTotalTime);
	$updateShopData->bindvalue(':numberGuests', $numberGuests);
	$updateShopData->bindvalue(':popcornFull', $popcornFull);	
	$updateShopData->execute();
	$updateShopData->closecursor();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
        html {background-color: antiquewhite;}
        h1 {color:darkblue; margin-bottom: 10px; }
		h3 {margin: 5px}
		#shiftManagment {padding-left: 10px;}
        #fast {padding-left: 10px;}
        #hospitality {padding-left: 10px;}
        #foodSafety {padding-left: 10px; }
        #quality { padding-left: 10px; }
        #accurate {padding-left: 10px;}
        #cleanliness {padding-left: 10px; }
        textarea {width: 90%;}
        label {display: flex; width: 600px; font-style: oblique;}
		#bigButton {width: 300px; font-size: 20px; background-color: black; color: white;text-align: center;vertical-align: middle;}

    </style>
<title> Stagg McService Shop</title>
</head>
<BODY>
	<form action="mailTest.php" method="post">
    	<fieldset>
			<legend><b>Restaurant Info</b></legend>
            	<label>Shop Date:
                	<input type="date" name="shopdate" value="<?php echo $shopDate; ?>" readonly>
                </label>
        
                <label>Shop Time:
                    <input type="time" name="shoptime" value="<?php echo $shopTime; ?>" readonly>
                </label>    
                <br>
                <label>Restaurant</label>
                    <select name="storeOption">
                    	<OPTION value="<?php echo $storeOption; ?>"><?php echo $storeOption; ?></OPTION>
                    </select>

                    <label>Trad/WM</label>
                    	<select name="storeType">
                        	<OPTION value="<?php echo $storeType; ?>"><?php echo $storeType; ?></OPTION>
                        </select>
            
                    <label>FC / DT</label>
                        <select name="shopType">
                            <OPTION value="<?php echo $shopType; ?>"><?php echo $shopType; ?></OPTION>
                        </select>  
                                
                    <label>Shift Manager Name:</label>
                       	<input type="text" name="shiftManagerName" value="<?php echo $shiftManagerName ?>" readonly>
      </fieldset>
                <p></p>
                <h1>SHIFT MANAGEMENT</h1>
                
                    <div id="shiftManagment" >
                    
                    <label>Is the shift manager up front and visibly in charge?</label> 
                        <?php echo $upFront; ?>
                        <br>
                    <label>Is the Shift Manager Appearance Acceptable? (Shirt clean, Tie, Shoes, Name Tag)</label>
                    	<?php echo $mgrAppearance; ?>
                        <br>
                   
                   <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Shift Manager Wearing a Headset?</label>
                    	<?php echo $headset; ?>
                        <br>
                    <?php } ?>
                    
                    <label>Is the Crew Appearance Acceptable? (Shirts Clean, Correct Shoes, Name Tags, Hats)</label>
                    	<?php echo $crewAppearance; ?>
                        <br>
                    <label>Are R2D2 Charts Posted and Current?</label>
                    	<?php echo $r2d2charts; ?>
                        <br>
                    <label>Are the RDM Boards Current?</label>
                    	<?php echo $rdm; ?>
                        <br>
                    <label>Were Kiosks Staffed and in use?</label>
                    	<?php echo $kiosks; ?>
                        <br>
                    <label>Was Table Service Being Used During Your Visit?</label>
                    	<?php echo $tableService; ?>
                        <br>
                    <label>Are Benefits/Employment Table Tents Visible?</label>
                    	<?php echo $tableTent; ?>
                        <br><br>
                    <label>COMMENTS:</label><br>
                        <textarea rows="5" cols="60"><?php echo $shiftMgrComment; ?></textarea>
                    </div>
        
                <h1>FAST</h1>
                    <div id="fast">
                    
                    <?php if ($shopType == "DT") { ?>
                    <h3>DRIVE-THRU</h3>
                        <label>Enter Wait Time: </label> 
                        	<?php echo $waitTime; ?><span>seconds</span>
                        <label>Enter Response Time: </label> 
                        	<?php echo $responseTime; ?><span>seconds</span>
                        <label>Enter Present Time: </label> 
                        	<?php echo $presentTime; ?><span>seconds</span>
                        <label>Enter Order End To Present Time: </label> 
                        	<?php echo $oepTime; ?><span>seconds</span>
                        <label>Enter Total Time: </label> 
                        	<?php echo $totalTime; ?><span>seconds</span>
                        <label>Were you pulled forward?</label>
                        	<?php echo $pullForward; ?>
                            <br>
                        <label>Enter how long you were pulled forward: </label> 
                        	<?php echo $pullForwardTime; ?><span>seconds</span>
                        <label>Number of cars between COD & You, include car at COD: </label> 
                        	<?php echo $numberCars; ?>
                        <label>If Tandem/HHOT, was second order point in use?</label>
                        	<?php echo $tandem; ?>
                            <br>
                    <?php } ?>
                    
                    <?php if ($shopType == "FC") { ?>
                    <h3>FRONT COUNTER</h3>
                        <label>Enter Wait Time: </label> 
                        	<?php echo $fcWaitTime; ?><span>seconds</span>
                        <label>Enter Delivery Time: </label> 
                        	<?php echo $fcDeliveryTime; ?><span>seconds</span>
                        <label>Enter Total Time: </label> 
                        	<?php echo $fcTotalTime; ?><span>seconds</span>
                        <label>Number of guests ahead of you in line: </label> 
                        	<?php echo $numberGuests; ?>
                    <?php } ?>
                            <br>
                        <label>COMMENTS:</label><br>
                            <textarea rows="5" cols="60"><?php echo $fastComment; ?></textarea>
                    
                    </div>
                    
                <h1>ACCURATE</h1>  
                    <div id="accurate">
                    <label>ITEMS ORDERED:</label><br>
                        <textarea rows="5" cols="60"><?php echo $itemsOrdered; ?></textarea><br>
                      
                    <?php if ($storeType == "WM") { ?>  
                    <label>Is Popcorn Tree Visible with at least half the tree full?</label>
                    	<?php echo $popcornFull; ?>
                        <br>   
                    <?php } ?>   
                        
                    <label>Did you receive all food and drink items that were ordered?</label>
                    	<?php echo $completeOrder; ?>
                        <br>
                    <label>Did you receive all requested condiments? (Sauces, Jelly, Napkins, Straws, Stirrers)</label>
                    	<?php echo $condiment; ?>
                        <br>
                    <label>Did the condiments come in a condiment bag separate from your order?</label>
                    	<?php echo $condimentBag; ?>
                        <br>
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Reader Board Message Correct?</label>
                    		<?php echo $readerBoard; ?>
                    <br>
                    <?php }  ?>
                    
                    <label>Is the POP/Marketing Correct?</label>
                    	<?php echo $marketing; ?>
                        <br>
                        
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the 800# signs on the DT Windows?</label>
                    	<?php echo $dtCommentNumber; ?>
                    <?php } ?>
                    
                        <br><br>
                    <label>COMMENTS:</label><br>
                            <textarea rows="5" cols="60"><?php echo $accuracyComment; ?></textarea>
                    </div>
                    
                <H1>HOSPITALITY</H1>
                    <div id="hospitality">
                    <label>Did the Order Taker:</label>
                        <input type="text" value="<?php echo $otName; ?>"/><br>
                    <label>PRE-SELL you the appropriate item?</label>
                    	<?php echo $presell; ?>
                        <br>
                    <label>Upsell you to a meal or Lg EVM?</label>
                    	<?php echo $upsell; ?>
                        <br>
                    <label>Repeat you entire order and ask, "Is that correct?"</label>
                    	<?php echo $repeatOrderAsk; ?>
                    <br><br>
                    
                    <?php if($shopType == "DT") { ?>
                    <label>Did the Cashier:</label>
                        <input type="text" value="<?php  echo $cashierName; ?>"/><br>
                    <label>Provide a friendly greeting and closing?</label>
                    		<?php echo $cashierGreeting; ?>
                    <br>
                    <label>ASK, "Did your order include ______?" (should be one of the unique items in your order)</label>
                    		<?php echo $cashierAsk; ?>
                    <br><br>
                    <?php } ?>
                    
                    <label>Did the Presenter:</label>
                        <input type="text" value="<?php  echo $presenterName; ?>"/><br>
                    <label>Provide a friendly greeting and closing?</label>
                    	<?php echo $presenterGreeting; ?>
                        <br>
                     <label>TELL you, "Here is your order with _____." (should be one of the unique items in your order)</label>
                     	<?php echo $presenterTell; ?>
                    <br><br>
                    
                    <?php if ($shopType == "DT") { ?>
                    <label>If you were pulled forward, did the pull forward presenter:</label>
							<input type="text" value="<?php  echo $pullForwardPresenterName; ?>"/><br>                    
					<label>TELL you, "Here is your order with _____." (should be one of the unique items in your order)</label>
                    	<?php echo $pfTell; ?>
                        <br><br>
                    <?php } ?>
                    
                    <label>COMMENTS:</label><br>
                            <textarea rows="5" cols="60"><?php echo $hospitalityComment; ?></textarea><br>
				</div>	
                <h1>QUALITY</h1>
                    <div id="quality">
                    <label>Were all products properly prepared and fresh and hot?  Neatly assembled?</label>
                    	<?php echo $fresh; ?>
                        <br>
                    <label>Were fries fresh and properly salted? Hashbrown hot and properly cooked?</label>
                    	<?php echo $friesGood; ?>
                        <br>
                    <label>Did the beverage have good taste?  (Cold/hot, carbonated, prepared correctly,stickered)</label>
                    	<?php echo $drinkGood; ?>
                        <br><br>
                     <label>COMMENTS:</label><br>
                        <textarea rows="5" cols="60"><?php echo $qualityComment; ?></textarea>
                    </div>
                    

                <h1>CLEANLINESS</h1> 
                    <div id="cleanliness">
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is The COD Area Clean?</label>
                    	<?php echo $codClean; ?>
                        <br>
                    <label>Is the DT Lane Clean?</label>
                    	<?php echo $dtClean; ?>
                        <br>
                    <label>Is the Parking Lot Clean?</label>
                    	<?php echo $lotClean; ?>
                        <br>
                    <label>Is the Corral Clean?</label>
                    	<?php echo $corralClean; ?>
                        <br>
                    <label>Are the Dumpster Lids Closed?</label>
                    	<?php echo $lidsClosed; ?>
                        <br>
                    <label>Are the DT Glass and Frame Clean?</label>
                    	<?php echo $dtGlassClean; ?>
                        <br>
                    <?php } ?>
                    
                    <label>Are Lobby Doors and Windows Clean?</label>
                    	<?php echo $windowsClean; ?>
                        <br>
                        
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the outside trash bins full and overflowing?</label>
                    	<?php echo $trashFull; ?>
                        <br>
                    <?php } ?>
                    
                    <label>Are the 800# signs on the Entry Doors?</label>
                    	<?php echo $commentSignVisible; ?>
                        <br>
                    
                    <label>Are the Floors Clean?</label>
                    	<?php echo $floorClean; ?>
                        <br>
                    <label>Are the Tables Clean?</label>
                    	<?php echo $tableClean; ?>
                        <br>
                    <label>Is the Beverage Bar Clean?</label>
                    	<?php echo $drinkClean; ?>
                        <br>
                        
                    <?php if ($storeType == "WM") { ?>
                    <label>Was The Top of The Popcorn Machine Clean?</label>
                    	<?php echo $popcornClean; ?>
                        <br>   
                    <?php } ?>
                        
                    <label>Are Ceiling Vents Clean?</label>
                    	<?php echo $ventsClean; ?>
                        <br>
                    <label>Are Sanitizers Available?</label>
                    	<?php echo $sanitizer; ?>
                        <br>
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the Televisions in the Lobby and Playplace on the correct channels?</label>
                    	<?php echo $tvOn; ?>
                        <br>
                    <?php } ?>
                     
                    <?php if ($storeType == "WM") { ?>
                    <label>Are the Televisions in the Lobby on and playing a movie?</label>
                    	<?php echo $tvOn; ?>
                        <br>
                    <?php } ?>
                    
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the Restrooms Clean?</label>
                    	<?php echo $restroomClean; ?>
                        <br>
                    <?php } ?>
                    
                    <label>Are the trash bins full and overflowing?</label>
                    	<?php echo $insideTrash; ?>
                        <br>
                    
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Crew Room Clean & Organized?</label>
                    	<?php echo $crewRoom; ?>
                        <br>
                    <?php } ?>
                      
                        <br>
                    <label>COMMENTS:</label><br>
                        <textarea rows="5" cols="60"><?php echo $cleanComment; ?></textarea>
                    </div>
                    

                <H1>FOOD SAFETY</H1>
                    <div id="foodSafety">
                    <label>Are UHC timers being used correctly?</label>
                    	<?php echo $uhctimer; ?>
                        <br>
                    <label>Are times on the prep table being used and are current?</label>
                    	<?php echo $prepTimer; ?>
                        <br>
                    <label>Are the buns held correctly with times marked?</label>
                    	<?php echo $bunTimer; ?>
                        <br>
					<label>Are Chicken Tenders Held in The 2 Drawer Correctly?</label>
						<?php echo $tenderCorrect; ?>
                    <label>Secondary Shelf Life on Oldest Package:</label>
						<?php echo $tenderDate."  ".$tenderTime; ?>
						<br>
					<label>Is the HOTG 4:1 Held in the 2 Drawer Cooler Correctly?</label>
						<?php echo $qtrCorrect; ?>
					<label>Secondary Shelf Life on Oldest 4:1 Package:</label>
						<?php echo $qtrDate."  ".$qtrTime; ?>
						<br>
					<label>Are Glove Procedures Followed in The Grill Area?</label>
						<?php echo $glove; ?>
                        <br>		
			
						
                    <label>Are the pies held correctly with times marked?</label>
                    	<?php echo $pieTimer; ?>
                        <br>
                    <label>Are the salads held correctly with times marked?</label>
                    	<?php echo $saladTimer; ?>
                        <br><br>
                    <label>COMMENTS:</label><br>
                        <textarea rows="5" cols="60"><?php echo $foodSafetyComment; ?></textarea><br><br>
                        
                    </div>
                    
                    
                    <label>Shop Completed By:</label>
                    	<?php echo $theShopper; ?>        
                    <br><br>
                    <label>&nbsp;</label>
                    <h1>Shop Results</h1>
						<p> Total Possible Points = <?php echo $Possible; ?><br>
							Total achieved Questions = <?php echo $Achieved; ?><br>
							Total Unscored Questions = <?php echo $unscored; ?><br>
							Shop Score Achieved = <?php echo $Score; ?></p>
						<br>
                    <br>
                    <h2 align="center">Email Shop to Store, Supervisor, Ops Manager and DO</h2><br>
					<input type="hidden" name="supEmail" value="<?php echo $supEmail; ?>">
					<input type="hidden" name="thestore" value="<?php echo $storeOption; ?>">
					<input type="hidden" name="storeEmail" value="<?php echo $storeEmail; ?>">	
					<?php if ($omEmail) { ?>
						<input type="hidden" name="omEmail" value="<?php echo $omEmail; ?>">
					<?php } ?>
					<div align="center">
                    <input id="bigButton" type="submit" value="Email Shop">
					</div>
            </form>

<?php
// Get the content that is in the buffer and put it in your file //
file_put_contents('Shop.html', ob_get_contents());
?>

	

	
</BODY> 
    
</html>
