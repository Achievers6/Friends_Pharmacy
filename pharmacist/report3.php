
<?php
$title = "CASHIER WISE REPORT";

$content = "<h2 style='text-align:center;'>CASHIER WISE REPORT</h2>" ?>
<?php include 'template.php';

?>
<?php
								// define variables and set to empty values
								$asErr =$nameErr =$cashier_nameErr = $codeErr =$dateErr=$timeErr=$methodeErr=$typeErr=$In_typeErr=$modeErr= "";
								$as=$name =$cashier_name = $code = $dates=$dates2 =$shelf=$times=$times2=$methode=$type=$In_type=$mode= "";

								if ($_SERVER["REQUEST_METHOD"] == "POST") {
								  if (empty($_POST["name"])) {
									$nameErr = "Name is required";
								  } else {
									$name = test_input($_POST["name"]);
									// check if name only contains letters and whitespace
									if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
									  $nameErr = "Only letters and white space allowed"; 
									}
								  }
								  
								  if (empty($_POST["cashier_name"])) {
									$cashier_nameErr = "Cashier_Name is required";
								  } else {
									$cashier_name = test_input($_POST["csh_name"]);
									// check if name only contains letters and whitespace
									if (!preg_match("/^[a-zA-Z ]*$/",$cashier_name)) {
									  $cashier_nameErr = "Only letters and white space allowed"; 
									}
								  }
								  
								  if (empty($_POST["cname"])) {
									$cnameErr = "Company_Name is required";
								  } else {
									$cname = test_input($_POST["cname"]);
									// check if name only contains letters and whitespace
									if (!preg_match("/^[a-zA-Z ]*$/",$cname)) {
									  $cnameErr = "Only letters and white space allowed"; 
									}
								  }
								  if (empty($_POST["code"])) {
									$codeErr = "m_code is required";
								  } else {
									$code = test_input($_POST["code"]);
								  }
								  
								  
								  if (empty($_POST["dates"])) {
									$dateErr = "Date is required";
								  } else {
									$dates = test_input($_POST["dates"]);
								  }
								  
								  if (empty($_POST["dates2"])) {
									$dateErr = "Date is required";
								  } else {
									$dates2 = test_input($_POST["dates2"]);
								  }
									
								  
								  if (empty($_POST["times"])) {
									$timeErr = "Time is required";
								  } else {
									$times = test_input($_POST["times"]);
								  }
								  
								  if (empty($_POST["times2"])) {
									$timeErr = "Time is required";
								  } else {
									$times2 = test_input($_POST["times2"]);
								  }

								  if (empty($_POST["methode"])) {
									$methodeErr = "Methode is required";
								  } else {
									$methode = test_input($_POST["methode"]);
								  }
								  if (empty($_POST["type"])) {
									$typeErr = "Type is required";
								  } else {
									$type = test_input($_POST["type"]);
								  }
								  if (empty($_POST["In_type"])) {
									$In_typeErr = "In_type is required";
								  } else {
									$In_type = test_input($_POST["In_type"]);
								  }
								  if (empty($_POST["mode"])) {
									$modeErr = "Mode is required";
								  } else {
									$mode = test_input($_POST["mode"]);
								  }
								  if (empty($_POST["as"])) {
									$modeErr = "as is required";
								  } else {
									$as = test_input($_POST["as"]);
								  }
								}

								function test_input($data) {
								  $data = trim($data);
								  $data = stripslashes($data);
								  $data = htmlspecialchars($data);
								  return $data;
								}
								
								?>
					<div class="daily">
					<form name='myForm' action='casier_wise.php' method ='post' autocomplete='off' onsubmit='return validateForm()'>
				
					<fieldset class="explicit-width" style="background-color: rgb(229, 249, 212); height: 400px;"> 
					
					<?php $sql = "SELECT  * FROM staff";
					//$con = mysqli_connect("localhost","root","","friends_pharmacy");
                                        include '../database/dbconnect.php';
					$result = mysqli_query($mysqli,$sql);
					$rows = mysqli_num_rows($result);					?>
					<table class="tableNormal" cellspacing="0" cellpadding="0">
					<tr><td><label>Cashier Name : </label><select name="cashier_name" required><option value="all">All</option><?php
												if($rows > 0){
													for($i = 0 ; $i<$rows; $i++){
														mysqli_data_seek($result,$i);
														$record = mysqli_fetch_assoc($result);
														echo '<option value="'.$record['member_id'].'">'.$record['first_name'].'</option>';
													}
												} ?> </select><br><br></td>
					</tr>
					
					<!--<?php $sql = "SELECT * FROM drug";
					$result = mysqli_query($mysqli,$sql);
					$rows = mysqli_num_rows($result);					?>
					<tr><td><label>Medicine Name : </label></td><td><select name="name" required><option value="all">All</option><?php
												if($rows > 0){
													for($i = 0 ; $i<$rows; $i++){
														mysqli_data_seek($result,$i);
														$record = mysqli_fetch_assoc($result);
														echo '<option value="'.$record['medicine_id'].'">'.$record['brand_name'].'</option>';
													}
												} ?> </select></td>
					</tr>-->
					<!--<?php $sql = "SELECT DISTINCT(location_id) FROM location ORDER BY location_id ASC  ";
					$result = mysqli_query($mysqli,$sql);
					$rows = mysqli_num_rows($result);					?>
					<tr><td><label>shelf No : </label></td><td><select name="shelf" required><option value="all">All</option><?php
												if($rows > 0){
													for($i = 0 ; $i<$rows; $i++){
														mysqli_data_seek($result,$i);
														$record = mysqli_fetch_assoc($result);
														echo '<option value="'.$record['location_id'].'">'.$record['location_id'].'</option>';
													}
												} ?> </select></td>
					</tr>-->
						
					<tr><td colspan="2"><label for="meeting1">Start Date : </label><input id="meeting1" type="date" name="dates" value="<?php echo date("Y-m-d")?>" required/><!--<label for="meeting"> To : </label><input id="meeting" type="date" name="dates2" value="<?php echo date("Y-m-d")?>" required/>--> 
						
						<br><br><br></td>
					</tr>
					
					<tr><td colspan="2"><label for="meeting1">End Date : </label><input id="meeting1" type="date" name="dates2" value="<?php echo date("Y-m-d")?>" required/><!--<label for="meeting"> To : </label><input id="meeting" type="date" name="dates2" value="<?php echo date("Y-m-d")?>" required/> -->
						
						<br></td>
					</tr>
					<!--<tr><td colspan="2"><label for="meeting1">Time From : </label><input id="meeting1" type="time" name="times" value="<?php echo time("D M d, Y G:i a"); ?>" required/><label for="meeting"> To : </label><input id="meeting" type="time" name="times2" value="<?php echo time("D M d, Y G:i a"); ?>" required/> -->
						
						</td>
					</tr>
					<tr><td colspan="2">
						<!--<fieldset class="explicit-width">
							<legend>Methode:</legend>
								<input type="radio" name="methode" <?php if (isset($methode) && $methode=="Qty") echo "checked";?> value="Qty" required>Qty
								<input type="radio" name="methode" <?php if (isset($methode) && $methode=="Price") echo "checked";?> value="Price" required>Price
								<br>
						</fieldset>
						<fieldset class="explicit-width">
							<legend>Type:</legend>
								<input type="radio" name="type" <?php if (isset($type) && $type=="Fast") echo "checked";?> value="Fast" required>Fast
								<input type="radio" name="type" <?php if (isset($type) && $type=="Slow") echo "checked";?> value="Slow" required>Slow
								<br>
						</fieldset></td>-->
					</tr>
					<!--<tr><td colspan="2">
						<fieldset class="explicit">
							<legend>Invoice Type:</legend>
								<input type="radio"  name="In_type" <?php if (isset($In_type) && $In_type=="Date-voiced") echo "checked";?> value="Date-voiced" required>Date-voiced<br><br>
								
								<input type="radio"  name="In_type" <?php if (isset($In_type) && $In_type=="Location-voiced") echo "checked";?> value="Location-voiced" required>Location-voiced<br><br>
								
								
						</fieldset></td>
					</tr>-->
					<tr><td colspan="2">
						<fieldset class="explicit">
							<legend>Report Mode:</legend>
								
								<input type="radio" name="mode" <?php if (isset($mode) && $mode=="Details") echo "checked";?> value="Details" required>Details<br><br>
								<input type="radio" name="mode" <?php if (isset($mode) && $mode=="Graph") echo "checked";?> value="Graph" required>Graph<br><br>
								<br>
								
						</fieldset></td>
					</tr>
				
					<tr><td>
						<button style="vertical-align:middle; position: relative; left: 0px;" onClick="document.hhh.click();";><span>Enter</span></button>
						</td><td></td>
					</tr>
					</table>
					</form>
						</fieldset>
						</div>






