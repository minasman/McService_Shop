<?php
	if (!isset($chosenStore)) {$chosenStore = filter_input(INPUT_POST,'storeChoice');}
	if(!isset($shopDate)) {$shopDate = filter_input(INPUT_POST,'shopdate');}
	if(!isset($shopTime)) {$shopTime = filter_input(INPUT_POST,'shoptime');}
	if(!isset($shopType)) {$shopType = filter_input(INPUT_POST,'shoptype');}
	if(!isset($storeType)) {$storeType = filter_input(INPUT_POST,'storetype');}
?>

<!DOCTYPE html>
<html>  
	<head>
	<script>
	var totalTimer = 0;
	var timer = -1;
	var thecodtime = 0
	var thegreettime = 0;
	var theoetime = 0;
	var thecashtime = 0;
	var thechangetime = 0;
	var thepresenttime = 0;
	var thepftime = 0;
		
	var fcstrt = 0;
	var fcgrt = 0;
	var fcoc = 0;
	var fcchg = 0;
	var fccomp = 0;
	
	function fcstarttimer() {
		fctimestart = document.getElementById("fcstart");
		fctimestart.innerHTML = fcstrt;
		fccomp = fcstrt;
		fcstrt = fcstrt + 1;
		fctotaltimestart = document.getElementById("fcdone");
		fctotaltimestart.innerHTML = fccomp;
		fcos = setTimeout(fcstarttimer, 1000);
		document.getElementById("fcstartbutton").setAttribute("disabled", "true");

	}
	
	function fcgreettimer() {
		fcgreetstart = document.getElementById("fcgreeted");
		fccomp = fcgrt + fcstrt;
		fcgrt = fcgrt + 1;
		fcgreetstart.innerHTML = fcgrt;
		fcgt = setTimeout(fcgreettimer, 1000);
		clearTimeout(fcos);
		fctotaltimestart = document.getElementById("fcdone");
		fctotaltimestart.innerHTML = fccomp;
		document.getElementById("fcgreetbutton").setAttribute("disabled", "true");

	}
	
	function fcoctimer() {
		fcocstart = document.getElementById("fcordercomplete");
		fccomp = fcoc + fcgrt + fcstrt;
		fcoc = fcoc + 1;
		fcocstart.innerHTML = fcoc;
		fcocs = setTimeout(fcoctimer, 1000);
		clearTimeout(fcgt);
		fctotaltimestart = document.getElementById("fcdone");
		fctotaltimestart.innerHTML = fccomp;
		document.getElementById("fcorderbutton").setAttribute("disabled", "true");

	}
	
	function fcchangetimer() {
		fcchgs = document.getElementById("fcchange");
		fccomp = fcchg + fcoc + fcgrt + fcstrt;
		fcchg = fcchg + 1;
		fcchgs.innerHTML = fcchg;
		chg = setTimeout(fcchangetimer, 1000);
		clearTimeout(fcocs);
		fctotaltimestart = document.getElementById("fcdone");
		fctotaltimestart.innerHTML = fccomp;
		document.getElementById("fcchangebutton").setAttribute("disabled", "true");

	}
	
	function fctotaltimer() {
		clearTimeout(chg);
		wt = document.getElementById("fcWaitTime");
		del = document.getElementById("fcDeliveryTime");
		tot = document.getElementById("fcTotalTime");
		
		wt.value = fcstrt;
		del.value = fcchg;
		tot.value = fccomp;
		
	}
	
	
	function startTimer() {
		timeStart = document.getElementById("orderStart");
		totalTimer = timer;
		timer = timer + 1;
		timeStart.innerHTML = timer;
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		os = setTimeout(startTimer,1000);
		document.getElementById("startButton").setAttribute("disabled", "true");

	}
	
	function codtimer() {
		codstart = document.getElementById("atcod");
		totalTimer = thecodtime + timer;
		thecodtime = thecodtime + 1;
		codstart.innerHTML = thecodtime;
		cods = setTimeout(codtimer,1000);
		clearTimeout(os);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("codButton").setAttribute("disabled", "true");

	}
	
	function greettimer() {
		greetstart = document.getElementById("greeted");
		totalTimer = thecodtime + thegreettime + timer;
		thegreettime = thegreettime + 1;
		greetstart.innerHTML = thegreettime;
		greets = setTimeout(greettimer,1000);
		clearTimeout(cods);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("greetedButton").setAttribute("disabled", "true");

	}
	
	function oetimer() {
		oestart = document.getElementById("orderend");
		totalTimer = thecodtime + thegreettime + theoetime + timer;
		theoetime = theoetime + 1;
		oestart.innerHTML = theoetime;
		oe = setTimeout(oetimer,1000);
		clearTimeout(greets);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("oeButton").setAttribute("disabled", "true");

	}
	
	function cashtimer() {
		cashstart = document.getElementById("atcash");
		totalTimer = thecodtime + thegreettime + theoetime + thecashtime + timer;
		thecashtime = thecashtime + 1;
		cashstart.innerHTML = thecashtime;
		cs = setTimeout(cashtimer,1000);
		clearTimeout(oe);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("cashierButton").setAttribute("disabled", "true");

	}
	
	function changetimer() {
		changestart = document.getElementById("change");
		totalTimer = thecodtime + thegreettime + theoetime + thecashtime + thechangetime + timer;
		thechangetime = thechangetime + 1;
		changestart.innerHTML = thechangetime;
		change = setTimeout(changetimer,1000);
		clearTimeout(cs);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("changeButton").setAttribute("disabled", "true");

	}
	
	function presenttimer() {
		presentstart = document.getElementById("atpresent");
		totalTimer = thecodtime + thegreettime + theoetime + thecashtime + thechangetime + thepresenttime + timer;
		thepresenttime = thepresenttime + 1;
		presentstart.innerHTML = thepresenttime;
		psent = setTimeout(presenttimer,1000);
		clearTimeout(change);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("presentButton").setAttribute("disabled", "true");

	}
	
	function pftimer() {
		pfstart = document.getElementById("pulledfwd");
		totalTimer = thecodtime + thegreettime + theoetime + thecashtime + thechangetime + thepresenttime + thepftime + timer;
		thepftime = thepftime + 1;
		pfstart.innerHTML = thepftime;
		pfs = setTimeout(pftimer,1000);
		clearTimeout(psent);
		thetotaltime = document.getElementById("total");
		thetotaltime.innerHTML = totalTimer;
		document.getElementById("pulledButton").setAttribute("disabled", "true");

	}
	
	function donetimer() {
		if (thepftime > 0) {
			clearTimeout(pfs);

		} else {
			clearTimeout(psent);
			document.getElementById("pulledButton").setAttribute("disabled", "true");

		}
		
		wait = document.getElementById("waitTime");
		resp = document.getElementById("responseTime");
		psnt = document.getElementById("presentTime");
		oept = document.getElementById("oepTime");
		ttime = document.getElementById("totalTime");
		pftime = document.getElementById("pullForwardTime");
		
		wait.value = timer;
		resp.value= thecodtime;
		psnt.value = thepresenttime + thepftime;
		oept.value = theoetime + thecashtime + thechangetime + thepresenttime + thepftime;
		ttime.value = totalTimer;
		pftime.value = thepftime;
		
	}
</script>	
		
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
        label {display: flex; font-style: oblique;}
		#bigButton {width: 300px; font-size: 20px; background-color: black; color: white;text-align: center;vertical-align: middle;}
		td {text-align: center}

    </style>
		
	<!--This javascript disables the return key. This will prevent user from submiting form accidentally-->	
	<script type="text/javascript"> 
		function stopRKey(evt) { 
  			var evt = (evt) ? evt : ((event) ? event : null); 
  			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  			if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
				} 
		document.onkeypress = stopRKey; 
	</script>
    
	<Title> Stagg McService Shop</Title>
    </head>
		<BODY>
			<form action="ShopScore.php" method="post" id="shopForm">
				<fieldset>
					<legend><b>Restaurant Info</b></legend>
					<!--Restaurant Information is filled in automatically from data in prior pages-->
                    	<label>Shop Date:
                        	<input type="date" name="shopdate" value="<?php echo $shopDate; ?>" readonly>
                        </label>
        
                        <label>Shop Time:
                        	<input type="time" name="shoptime" value="<?php echo $shopTime; ?>" readonly>
                        </label>    
                        <br>
                        <label>Restaurant:</label>
                        	<select name="storeOption">
                            	<OPTION value="<?php echo $chosenStore; ?>"><?php echo $chosenStore; ?></OPTION>
                            </select>

                        <label>Trad/WM</label>
                            <select name="storeType">
                                <OPTION value="<?php echo $storeType; ?>"><?php echo $storeType; ?></OPTION>
                            </select>
            
                            <label>FC / DT</label>
                            <select name="shopType">
                                <OPTION value="<?php echo $shopType; ?>"><?php echo $shopType; ?></OPTION>
                            </select> 
						<br>
						<label>Shift Manager Name:</label>
                            <input type="text" name="shiftManagerName" placeholder="None Visible">
				</fieldset>
				
                <h1>SHIFT MANAGEMENT</h1>
                    <div id="shiftManagment" >
                    <label>Is the shift manager up front and visibly in charge?</label>
                        <input type="radio" name="upFront" value="Yes" />Yes 
                        <input type="radio" name="upFront" value="No" />No
                        <br>
						
                    <label>Is the Shift Manager Appearance Acceptable? (Shirt clean, Tie, Shoes, Name Tag)</label>
                        <input type="radio" name="mgrAppearance" value="Yes" />Yes 
                        <input type="radio" name="mgrAppearance" value="No" />No
                        <br>
                   
                   <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Shift Manager Wearing a Headset?</label>
                        <input type="radio" name="headset" value="Yes" />Yes 
                        <input type="radio" name="headset" value="No" />No
                        <br>
                    <?php } ?>
                    
                    <label>Is the Crew Appearance Acceptable? (Shirts Clean, Correct Shoes, Name Tags, Hats)</label>
                        <input type="radio" name="crewAppearance" value="Yes" />Yes 
                        <input type="radio" name="crewAppearance" value="No" />No
                        <br>
						
                    <label>Are R2D2 Charts Posted and Current?</label>
                        <input type="radio" name="r2d2charts" value="Yes" />Yes 
                        <input type="radio" name="r2d2charts" value="No" />No
                        <br>
						
                    <label>Are the RDM Boards Current?</label>
                        <input type="radio" name="rdm" value="Yes" />Yes 
                        <input type="radio" name="rdm" value="No" />No
                        <br>
						
                    <label>Were Kiosks Staffed and in use?</label>
                        <input type="radio" name="kiosks" value="Yes" />Yes 
                        <input type="radio" name="kiosks" value="No" />No
                        <input type="radio" name="kiosks" value="N/A"n />N/A
                        <br>
						
                    <label>Was Table Service Being Used During Your Visit?</label>
                        <input type="radio" name="tableService" value="Yes" />Yes 
                        <input type="radio" name="tableService" value="No" />No
                        <br>
						
                    <label>Are Benefits/Employment Table Tents Visible?</label>
                        <input type="radio" name="tableTent" value="Yes" />Yes 
                        <input type="radio" name="tableTent" value="No" />No
                        <br><br>
                    <label>COMMENTS:</label><br>
                        <textarea name="shiftMgrComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>
        
                <h1>FAST</h1>
                    <div id="fast">
                    
						<!--Only displays DT questions for fast-->
                    <?php if ($shopType == "DT") { ?>
                    <h3>DRIVE-THRU</h3>
						<table border="collapse">
							<tr bgcolor="#C0B8B8">
								<th>Start</th>
								<th>At COD</th>
								<th>Greeted</th>
								<th>Order End</th>
								<th>At Cashier</th>
								<th>Change Given</th>
								<th>At Present</th>
								<th>Pulled</th>
								<th>Total</th>
							</tr>
							<tr height="25px" bgcolor="yellow">
								<td><span id="orderStart"></span></td>
								<td><span id="atcod"></span></td>
								<td><span id="greeted"></span></td>
								<td><span id="orderend"></span></td>
								<td><span id="atcash"></span></td>
								<td><span id="change"></span></td>
								<td><span id="atpresent"></span></td>
								<td><span id="pulledfwd"></span></td>
								<td><span id="total"></span></td>
							</tr>
							<tr>
								<td><input type="button" name="startButton" id="startButton" onClick="startTimer()" value="Start"></td>
								<td><input type="button" name="codButton" id="codButton" value="At COD" onclick="codtimer()"></td>
								<td><input type="button" name="greetedButton" id="greetedButton" value="Greeted" onClick="greettimer()"></td>
								<td><input type="button" name="oeButton" id="oeButton" value="Order End" onClick="oetimer()"></td>
								<td><input type="button" name="cashierButton" id="cashierButton" value="At Cash" onClick="cashtimer()"></td>
								<td><input type="button" name="changeButton" id="changeButton" value="Change Given" onClick="changetimer()"></td>
								<td><input type="button" name="presentButton" id="presentButton" value="At Present" onClick="presenttimer()"></td>
								<td><input type="button" name="pulledButton" id="pulledButton" value="Pulled" onClick="pftimer()"></td>
								<td><input type="button" name="endButton" id="endButton" value="Done" onClick="donetimer()"></td>
							</tr>
						</table>
						
                        <label>Enter Wait Time: </label> 
                            <input align="middle" type="text" name="waitTime" id="waitTime" placeholder="Enter in seconds" />Target 70" or less <br>
						
                        <label>Enter Response Time: </label> 
                            <input type="text" name="responseTime" id="responseTime" placeholder="Enter in seconds"/>Target 10" or less<br>
						
                        <label>Enter Present Time: </label> 
                            <input type="text" name="presentTime" id="presentTime" placeholder="Enter in seconds"/>Target 15" or less<br>
						
                        <label>Enter Order End To Present Time: </label> 
                            <input type="text" name="oepTime" id="oepTime" placeholder="Enter in seconds"/>Target 240" or less<br>
						
                        <label>Enter Total Time: </label> 
                            <input type="text" name="totalTime" id="totalTime" placeholder="Enter in seconds"/>Target 450" or less<br>
						
                        <label>Were you pulled forward?</label>
                            <input type="radio" name="pullForward" value="Yes" />Yes 
                            <input type="radio" name="pullForward" value="No" />No
							<input type="radio" name="pullForward" value="N/A" />N/A
                            <br>
						
                        <label>Enter how long you were pulled forward: </label> 
                            <input type="text" name="pullForwardTime" id="pullForwardTime" placeholder="Enter in seconds"/><br>
						
                        <label>Number of cars between COD & You, include car at COD: </label> 
                            <input type="text" name="numberCars" /><br>
						
                        <label>If Tandem/HHOT, was second order point in use?</label>
                            <input type="radio" name="tandem" value="Yes" />Yes 
                            <input type="radio" name="tandem" value="No" />No
							<input type="radio" name="tandem" value="N/A" />N/A
                            <br>
                    <?php } ?>
                    
						<!-- Only displays FC questions for fast-->
                    <?php if ($shopType == "FC") { ?>
                    <h3>FRONT COUNTER</h3>
						<table border="solid">
							<tr bgcolor="#C0B8B8">
								<th>Start</th>
								<th>Greeted</th>
								<th>Order Complete</th>
								<th>Change Given</th>
								<th>Rcvd Food</th>
							</tr>
							<tr height="25px" bgcolor="yellow">
								<td><span id="fcstart"></span></td>
								<td><span id="fcgreeted"></span></td>
								<td><span id="fcordercomplete"></span></td>
								<td><span id="fcchange"></span></td>
								<td><span id="fcdone"></span></td>
							</tr>
							<tr>
								<td><input type="button" id="fcstartbutton" value="Start" onClick="fcstarttimer()"></td>
								<td><input type="button" id="fcgreetbutton" value="Greeted" onClick="fcgreettimer()"></td>
								<td><input type="button" id="fcorderbutton" value="Order Done" onClick="fcoctimer()"></td>
								<td><input type="button" id="fcchangebutton" value="Change Given" onClick="fcchangetimer()"></td>
								<td><input type="button" id="fcdonebutton" value="Done" onClick="fctotaltimer()"></td>
							</tr>
						</table>
                        <label>Enter Wait Time: </label> 
                            <input type="text" name="fcWaitTime" id="fcWaitTime" placeholder="Enter in seconds"/>Target 90" or less<br>
						
                        <label>Enter Delivery Time: </label> 
                            <input type="text" name="fcDeliveryTime" id="fcDeliveryTime" placeholder="Enter in seconds"/>Target 240" or less<br>
						
                        <label>Enter Total Time: </label> 
                            <input type="text" name="fcTotalTime" id="fcTotalTime" placeholder="Enter in seconds"/>Target 450" or less<br>
						
                        <label>Number of guests ahead of you in line: </label> 
                            <input type="text" name="numberGuests" /><br>
                    <?php } ?>
                            <br>
                        <label>COMMENTS:</label><br>
                            <textarea name="fastComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>
                    
                <h1>ACCURATE</h1>  
                    <div id="accurate">
                    <label>ITEMS ORDERED:</label><br>
                        <textarea name="itemsOrdered" rows="5" cols="60" placeholder="Enter Items Here"></textarea><br>
                      
                    <?php if ($storeType == "WM") { ?>  
                    <label>Is Popcorn Tree Visible with at least half the tree full?</label>
                        <input type="radio" name="popcornFull" value="Yes" />Yes 
                        <input type="radio" name="popcornFull" value="No" />No
                        <br>   
                    <?php } ?>   
                        
                    <label>Did you receive all food and drink items that were ordered?</label>
                        <input type="radio" name="completeOrder" value="Yes" />Yes 
                        <input type="radio" name="completeOrder" value="No" />No
                        <br>
						
                    <label>Did you receive all requested condiments? (Sauces, Jelly, Napkins, Straws, Stirrers)</label>
                        <input type="radio" name="condiment" value="Yes" />Yes 
                        <input type="radio" name="condiment" value="No" />No
                        <br>
						
                    <label>Did the condiments come in a condiment bag separate from your order?</label>
                        <input type="radio" name="condimentBag" value="Yes" />Yes 
                        <input type="radio" name="condimentBag" value="No" />No
                        <br>
						
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Reader Board Message Correct?</label>
                            <input type="radio" name="readerBoard" value="Yes" />Yes 
                            <input type="radio" name="readerBoard" value="No" />No
							<input type="radio" name="readerBoard" value="N/A" />N/A
                    <br>
                    <?php }  ?>
                    
                    <label>Is the POP/Marketing Correct?</label>
                        <input type="radio" name="marketing" value="Yes" />Yes 
                        <input type="radio" name="marketing" value="No" />No
                        <br>
                        
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the 800# signs on the DT Windows?</label>
                        <input type="radio" name="dtCommentNumber" value="Yes" />Yes 
                        <input type="radio" name="dtCommentNumber" value="No" />No
                    <?php } ?>
                    
                        <br><br>
                    <label>COMMENTS:</label><br>
                            <textarea name="accuracyComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>
                    
                <H1>HOSPITALITY</H1>
                    <div id="hospitality">
                    <label>Did the Order Taker:</label>
                        <input type="text" name="otName" placeholder="Enter Employee's Name"/><br>
						
                    <label>PRE-SELL you the appropriate item?</label>
                        <input type="radio" name="presell" value="Yes" />Yes 
                        <input type="radio" name="presell" value="No" />No
                        <br>
						
                    <label>Upsell you to a meal or Lg EVM?</label>
                        <input type="radio" name="upsell" value="Yes" />Yes 
                        <input type="radio" name="upsell" value="No" />No
                        <br>
						
                    <label>Repeat you entire order and ask, "Is that correct?"</label>
                        <input type="radio" name="repeatOrderAsk" value="Yes" />Yes 
                        <input type="radio" name="repeatOrderAsk" value="No" />No
                    <br><br>
                    
                    <?php if($shopType == "DT") { ?>
                    <label>Did the Cashier:</label>
                        <input type="text" name="cashierName" placeholder="Enter Employee's Name"/><br>
						
                    <label>Provide a friendly greeting and closing?</label>
                            <input type="radio" name="cashierGreeting" value="Yes" />Yes 
                            <input type="radio" name="cashierGreeting" value="No" />No
                    <br>
                    <label>ASK, "Did your order include ______?" (should be one of the unique items in your order)</label>
                            <input type="radio" name="cashierAsk" value="Yes" />Yes 
                            <input type="radio" name="cashierAsk" value="No" />No
                    <br><br>
                    <?php } ?>
                    
                    <label>Did the Presenter:</label>
                        <input type="text" name="presenterName" placeholder="Enter Employee's Name"/><br>
						
                    <label>Provide a friendly greeting and closing?</label>
                        <input type="radio" name="presenterGreeting" value="Yes" />Yes 
                        <input type="radio" name="presenterGreeting" value="No" />No
                        <br>
						
                     <label>TELL you, "Here is your order with _____." (should be one of the unique items in your order)</label>
                        <input type="radio" name="presenterTell" value="Yes" />Yes 
                        <input type="radio" name="presenterTell" value="No" />No
                    <br><br>
                    
                    <?php if ($shopType == "DT") { ?>
                    <label>If you were pulled forward, did the pull forward presenter:</label>
                        <input type="text" name="pullForwardPresenterName" placeholder="Enter Employee's Name"/><br>
						
                    <label>TELL you, "Here is your order with _____." (should be one of the unique items in your order)</label>
                        <input type="radio" name="pfTell" value="Yes" />Yes 
                        <input type="radio" name="pfTell" value="No" />No
						<input type="radio" name="pfTell" value="N/A" />N/A
                        <br><br>
                    <?php } ?>
                    
                    <label>COMMENTS:</label><br>
                            <textarea name="hospitalityComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>

                <h1>QUALITY</h1>
                    <div id="quality">
                    <label>Were all products properly prepared and fresh and hot?  Neatly assembled?</label>
                        <input type="radio" name="fresh" value="Yes" />Yes 
                        <input type="radio" name="fresh" value="No" />No
                        <br>
						
                    <label>Were fries fresh and properly salted? Hashbrown hot and properly cooked?</label>
                        <input type="radio" name="friesGood" value="Yes" />Yes 
                        <input type="radio" name="friesGood" value="No" />No
                        <br>
						
                    <label>Did the beverage have good taste?  (Cold/hot, carbonated, prepared correctly,stickered)</label>
                        <input type="radio" name="drinkGood" value="Yes" />Yes 
                        <input type="radio" name="drinkGood" value="No" />No
                        <br><br>
                     <label>COMMENTS:</label><br>
						
                        <textarea name="qualityComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>
                    

                <h1>CLEANLINESS</h1> 
                    <div id="cleanliness">
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is The COD Area Clean?</label>
                        <input type="radio" name="codClean" value="Yes" />Yes 
                        <input type="radio" name="codClean" value="No" />No
                        <br>
						
                    <label>Is the DT Lane Clean?</label>
                        <input type="radio" name="dtClean" value="Yes" />Yes 
                        <input type="radio" name="dtClean" value="No" />No
                        <br>
						
                    <label>Is the Parking Lot Clean?</label>
                        <input type="radio" name="lotClean" value="Yes" />Yes 
                        <input type="radio" name="lotClean" value="No" />No
                        <br>
						
                    <label>Is the Corral Clean?</label>
                        <input type="radio" name="corralClean" value="Yes" />Yes 
                        <input type="radio" name="corralClean" value="No" />No
                        <br>
						
                    <label>Are the Dumpster Lids Closed?</label>
                        <input type="radio" name="lidsClosed" value="Yes" />Yes 
                        <input type="radio" name="lidsClosed" value="No" />No
                        <br>
						
                    <label>Are the DT Glass and Frame Clean?</label>
                        <input type="radio" name="dtGlassClean" value="Yes" />Yes 
                        <input type="radio" name="dtGlassClean" value="No" />No
                        <br>
                    <?php } ?>
                    
                    <label>Are Lobby Doors and Windows Clean?</label>
                        <input type="radio" name="windowsClean" value="Yes" />Yes 
                        <input type="radio" name="windowsClean" value="No" />No
                        <br>
                        
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the outside trash bins full and overflowing?</label>
                        <input type="radio" name="trashFull" value="Yes" />Yes 
                        <input type="radio" name="trashFull" value="No" />No
                        <br>
                    <?php } ?>
                    
                    <label>Are the 800# signs on the Entry Doors?</label>
                        <input type="radio" name="commentSignVisible" value="Yes" />Yes 
                        <input type="radio" name="commentSignVisible" value="No" />No
                        <br>
                    
                    <label>Are the Floors Clean?</label>
                        <input type="radio" name="floorClean" value="Yes" />Yes 
                        <input type="radio" name="floorClean" value="No" />No
                        <br>
						
                    <label>Are the Tables Clean?</label>
                        <input type="radio" name="tableClean" value="Yes" />Yes 
                        <input type="radio" name="tableClean" value="No" />No
                        <br>
						
                    <label>Is the Beverage Bar Clean?</label>
                        <input type="radio" name="drinkClean" value="Yes" />Yes 
                        <input type="radio" name="drinkClean" value="No" />No
                        <br>
                        
                    <?php if ($storeType == "WM") { ?>
                    <label>Was The Top of The Popcorn Machine Clean?</label>
                        <input type="radio" name="popcornClean" value="Yes" />Yes 
                        <input type="radio" name="popcornClean" value="No" />No
                        <br>   
                    <?php } ?>
                        
                    <label>Are Ceiling Vents Clean?</label>
                        <input type="radio" name="ventsClean" value="Yes" />Yes 
                        <input type="radio" name="ventsClean" value="No" />No
                        <br>
						
                    <label>Are Sanitizers Available?</label>
                        <input type="radio" name="sanitizer" value="Yes" />Yes 
                        <input type="radio" name="sanitizer" value="No" />No
                        <br>
						
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the Televisions in the Lobby and Playplace on the correct channels?</label>
                        <input type="radio" name="tvOn" value="Yes" />Yes 
                        <input type="radio" name="tvOn" value="No" />No
                        <br>
                    <?php } ?>
                     
                    <?php if ($storeType == "WM") { ?>
                    <label>Are the Televisions in the Lobby on and playing a movie?</label>
                        <input type="radio" name="tvOn" value="Yes" />Yes 
                        <input type="radio" name="tvOn" value="No" />No
                        <br>
                    <?php } ?>
                    
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Are the Restrooms Clean?</label>
                        <input type="radio" name="restroomClean" value="Yes" />Yes 
                        <input type="radio" name="restroomClean" value="No" />No
                        <br>
                    <?php } ?>
                    
                    <label>Are the trash bins full and overflowing?</label>
                        <input type="radio" name="insideTrash" value="Yes" />Yes 
                        <input type="radio" name="insideTrash" value="No" />No
                        <br>
                    
                    <?php if ($storeType == "Traditional") { ?>
                    <label>Is the Crew Room Clean & Organized?</label>
                        <input type="radio" name="crewRoom" value="Yes" />Yes 
                        <input type="radio" name="crewRoom" value="No" />No
                        <br>
                    <?php } ?>
                      
                        <br>
                    <label>COMMENTS:</label><br>
                        <textarea name="cleanComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea>
                    </div>
                    

                <H1>FOOD SAFETY</H1>
                    <div id="foodSafety">
                    <label>Are UHC timers being used correctly?</label>
                        <input type="radio" name="uhctimer" value="Yes" />Yes 
                        <input type="radio" name="uhctimer" value="No" />No
                        <br>
						
                    <label>Are times on the prep table being used and are current?</label>
                        <input type="radio" name="prepTimer" value="Yes" />Yes 
                        <input type="radio" name="prepTimer" value="No" />No
                        <br>
						
                    <label>Are the buns held correctly with times marked?</label>
                        <input type="radio" name="bunTimer" value="Yes" />Yes 
                        <input type="radio" name="bunTimer" value="No" />No
                        <br>
					<label>Are Chicken Tenders Held in The 2 Drawer Correctly?</label>
                        <input type="radio" name="tenderCorrect" value="Yes" />Yes 
                        <input type="radio" name="tenderCorrect" value="No" />No
                    <label>Secondary Shelf Life on Oldest Package:</label>
						<input type="date" name="tenderDate" id="tenderDate">
						<input type="time" name="tenderTime" id="tenderTime">
					<br>
						
					<label>Is the HOTG 4:1 Held in the 2 Drawer Cooler Correctly?</label>
                        <input type="radio" name="qtrCorrect" value="Yes" />Yes 
                        <input type="radio" name="qtrCorrect" value="No" />No
					<label>Secondary Shelf Life on Oldest 4:1 Package:</label>
						<input type="date" name="qtrDate" id="qtrDate">
						<input type="time" name="qtrTime" id="qtrTime">
                        <br>
						
					<label>Are Glove Procedures Followed in The Grill Area?</label>
                        <input type="radio" name="glove" value="Yes" />Yes 
                        <input type="radio" name="glove" value="No" />No
                        <br>		
                    <label>Are the pies held correctly with times marked?</label>
                        <input type="radio" name="pieTimer" value="Yes" />Yes 
                        <input type="radio" name="pieTimer" value="No" />No
                        <br>
						
                    <label>Are the salads held correctly with times marked?</label>
                        <input type="radio" name="saladTimer" value="Yes" />Yes 
                        <input type="radio" name="saladTimer" value="No" />No
                        <br><br>
						
                    <label>COMMENTS:</label><br>
                        <textarea name="foodSafetyComment" rows="5" cols="60" placeholder="Enter Comments Here"></textarea><br><br>
                    </div>
                    <label>Shop Completed By:</label>
                                <select name="theShopper" required>
                                <option value-"">Please Select Shopper</option>
                                    <OPTION value="Ned Stagg">Ned</OPTION>
                                    <OPTION value="Fabiola Stagg">Fabi</OPTION>
                                    <OPTION value="Daniel Hernandez">Daniel</OPTION>
                                    <OPTION value="Ali Eskandari">Ali</OPTION>
                                    <option value="Darren Lassiter">Darren</option>
                                    <option value="Jason McCoy">Jason</option>
                                    <OPTION value="Letty Martinez">Letty</OPTION>
                                    <OPTION value="Patty Ruiz">Patty</OPTION>
                                    <OPTION value="Richard Ainsworth">Richard</OPTION>
                                    <option value="Toni Brown">Toni</option>
									<option value="George McClure">George</option>
									<option value="GM">Restaurant Manager</option>
                                    <option value="Other">Other</option>
                                </select>
                    <br><br>
                    <label>&nbsp;</label>
                   
                    <h2 align="center">Verify All Your Answers. Once you submit your shop, it will be FINAL and changes CANNOT be made!</h2>
					<div align="center">
                    <input id="bigButton" type="submit" value="Submit Shop To Database">
					</div>
            </form>
               
        </BODY> 
    
</html>