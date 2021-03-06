<?php require_once("../templates/header.php"); ?>
<?php require_once("../templates/aside.php"); ?>
<?php require_once("../php/database.php"); ?>

<?php 
	if(!isset($_GET['index-number'])){
		header("Location:".set_url('pages/login.php'));
	}

	if(isset($_POST['accept'])){
		$con->update('admissions',array("state"=>"accepted"),array("index_number"=>$_GET['index-number']));
	}else if(isset($_POST['reject'])){
		$con->update('admissions',array("state"=>"rejected"),array("index_number"=>$_GET['index-number']));
	}else if(isset($_POST['delete'])){
		$con->update('admissions',array("state"=>"deleted"),array("index_number"=>$_GET['index-number']));
	}

	$con->where(array("index_number"=>$_GET['index-number']));
	$result_set = $con->select('admissions');
	$result = $result_set->fetch(PDO::FETCH_ASSOC);
	// if ($result['already_have_account'] == true){
	// 	echo "OK";
	// }
 ?>

<div id="content" class="col-11 col-md-8 col-lg-9 flex-col align-items-center justify-content-start">
	<div class="admissions-header mt-5">
		<h2 class="fs-30">View Admissions</h2>
	</div> <!-- .admission-header -->
	<hr class="w-100">
	<div class="admission-details col-12">
		<form action="<?php echo set_url('pages/registration.php'); ?>" class="col-12 align-items-start" method="post">
			<div class="col-12 col-md-6 p-3">
				<fieldset >
					<legend>Student Info</legend>

					<div class="form-group">
						<label for="index-number">Index Number (<code title="required"> * </code>)</label>
						<input type="number" value="<?php if(isset($result['index_number'])){echo $result['index_number'];} ?>" name="index-number" placeholder="Index Number" id="index-number">
					</div>

					<div class="form-group">
						<label for="name-with-initials">Name with initials (<code title="required"> * </code>)</label>
						<input type="text" value="<?php if(isset($result['name_with_initials'])){echo $result['name_with_initials'];} ?>" name="name-with-initials" placeholder="Name with initials" id="name-with-initials">
					</div>

					<div class="form-group">
						<label for="full-name">Full Name (<code title="required"> * </code>)</label>
						<input type="text" value="<?php if(isset($result['full_name'])){echo $result['full_name'];} ?>" name="full-name" placeholder="Full Name" id="full-name">
					</div>

					<div class="form-group">
						<label for="grade">Grade (<code title="required"> * </code>)</label>
						<select name="grade" id="grade" class="w-30">
							<option value="1" <?php if(isset($result['grade']) && $result['grade']==1){echo "selected='selected'";}?> >1</option>
							<option value="2" <?php if(isset($result['grade']) && $result['grade']==2){echo "selected='selected'";}?> >2</option>
							<option value="3" <?php if(isset($result['grade']) && $result['grade']==3){echo "selected='selected'";}?> >3</option>
							<option value="4" <?php if(isset($result['grade']) && $result['grade']==4){echo "selected='selected'";}?> >4</option>
							<option value="5" <?php if(isset($result['grade']) && $result['grade']==5){echo "selected='selected'";}?> >5</option>
							<option value="6" <?php if(isset($result['grade']) && $result['grade']==6){echo "selected='selected'";}?> >6</option>
							<option value="7" <?php if(isset($result['grade']) && $result['grade']==7){echo "selected='selected'";}?> >7</option>
							<option value="8" <?php if(isset($result['grade']) && $result['grade']==8){echo "selected='selected'";}?> >8</option>
							<option value="9" <?php if(isset($result['grade']) && $result['grade']==9){echo "selected='selected'";}?> >9</option>
							<option value="10" <?php if(isset($result['grade']) && $result['grade']==10){echo "selected='selected'";}?> >10</option>
							<option value="11" <?php if(isset($result['grade']) && $result['grade']==11){echo "selected='selected'";}?> >11</option>
							<option value="12" <?php if(isset($result['grade']) && $result['grade']==12){echo "selected='selected'";}?> > <?php if(isset($result['grade']) && $result['grade']==1){echo "selected='selected";}?> 12</option>
							<option value="12" <?php if(isset($result['grade']) && $result['grade']==13){echo "selected='selected'";}?> >13</option>
						</select>
					</div>

					<div class="form-group">
						<label for="gender">Gender (<code title="required"> * </code>)</label>
						<div id="gender" value="<?php if(isset($result['gender'])){echo $result['gender'];} ?>" class="w-100 d-flex">
							<label for="male" class="w-auto"><input type="radio" name="gender" id="male" value="male" <?php if(isset($result['gender']) && $result['gender'] == "male"){echo "checked='checked'";} ?> >Male</label>
							<label for="female" class="w-auto"><input type="radio" name="gender" id="female" value="female" <?php if(isset($result['gender']) && $result['gender'] == "female"){echo "checked='checked'";} ?>>Female</label>
						</div>
					</div>

					<div class="form-group">
						<label for="dob">Date of Birth (<code title="required"> * </code>)</label>
						<input type="date" value="<?php if(isset($result['dob'])){echo $result['dob'];} ?>" name="dob" id="dob" value="<?php echo date("Y-m-d"); ?>">
					</div>

					<div class="form-group">
						<label for="address">Address (<code title="required"> * </code>)</label>
						<input type="text" value="<?php if(isset($result['address'])){echo $result['address'];} ?>" name="address" placeholder="Address" id="address">
					</div>

					<div class="form-group">
						<label for="email">Email Address (<code title="required"> * </code>)</label>
						<input type="email" value="<?php if(isset($result['email'])){echo $result['email'];} ?>" name="email" placeholder="Email Address" id="email">
					</div>

					<div class="form-group">
						<label for="contact-number">Contact Number (<code title="required"> * </code>)</label>
						<input type="number" value="<?php if(isset($result['contact_number'])){echo $result['contact_number'];} ?>" name="contact-number" placeholder="Contact Number" id="contact-number">
					</div>
				</fieldset>
			</div>
			<div  class="col-12 col-md-6 p-3 flex-col">
				<fieldset>
					<legend>Parent and Gurdian Info</legend>
					<div class="form-group">
						<label for="already-have-account" class="ml-5 d-flex" style="color:red">
							<p class="d-inline">Alredy have Parent account </p>
							<input type="checkbox" onchange="already_have_parent_account(this,'parent-details-wrapper','parent-account-field')" name="already-have-account" id="already-have-account" class="ml-3" <?php if(isset($result['already_have_account']) && $result['already_have_account']== true){echo "checked='checked'";} ?> >
						</label>
					</div>

					<div id="parent-account-field" class="col-12 no-collapsed">
						<div class="form-group">
							<label for="parent-account-id">Parent Account ID</label>
							<input type="text" name="parent-account-id" id="parent-account-id" value="<?php if(isset($result['parent_account_id'])){echo $result['parent_account_id'];} ?>" placeholder="Parent Account ID">
						</div>
					</div>

					<div id="parent-details-wrapper">
						<div class="form-group">
							<label for="parent-type">Select parent or guardian : </label>
							<div class="d-flex ">
								<select name="parent-type"  onchange="registration_parent_change(this)" id="parent-type"  style="width: 200px;">
									<option value="father" <?php if(isset($result['parent_type'])){if($result['parent_type'] == "father"){echo 'selected="selected"';}}else{echo "selected='selected'";} ?> >Father</option>
									<option value="mother" <?php if(isset($result['parent_type']) && ($result['parent_type'] == "mother")){echo "selected='selected'";}  ?> >Mother</option>
									<option value="guardian" <?php if(isset($result['parent_type']) && ($result['parent_type'] == "guardian")){echo "selected='selected'";}  ?> >Guardian</option>
								</select>
							</div>
						</div>
						<div id="father" class="collapsed">
							<div class="form-group">
								<label for="father-name">Father Name (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['father_name'])){echo $result['father_name'];} ?>" name="father-name" placeholder="Father Name" id="father-name" >
							</div>

							<div class="form-group">
								<label for="father-occupation">Father Occupation (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['father_occupation'])){echo $result['father_occupation'];} ?>" name="father-occupation" placeholder="Father Occupation" id="father-occupation" >
							</div>

							<div class="form-group">
								<label for="father-contact-number">Father Contact Number (<code title="required"> * </code>)</label>
								<input type="number" value="<?php if(isset($result['father_contact_number'])){echo $result['father_contact_number'];} ?>" name="father-contact-number" placeholder="Father Contact Number" id="father-contact-number" >
							</div>

							<div class="form-group">
								<label for="father-email">Father Email (<code title="required"> * </code>)</label>
								<input type="email" value="<?php if(isset($result['father_email'])){echo $result['father_email'];} ?>" name="father-email" placeholder="Father Email" id="father-email" >
							</div>
						</div>

						<div id="mother" class="no-collapsed">
							<div class="form-group">
								<label for="mother-name">Mother Name (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['mother_name'])){echo $result['mother_name'];} ?>" name="mother-name" placeholder="Mother Name" id="mother-name">
							</div>

							<div class="form-group">
								<label for="mother-occupation">Mother Occupation (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['mother_occupation'])){echo $result['mother_occupation'];} ?>" name="mother-occupation" placeholder="Mother Occupation" id="mother-occupation">
							</div>

							<div class="form-group">
								<label for="mother-contact-number">Mother Contact Number (<code title="required"> * </code>)</label>
								<input type="number" value="<?php if(isset($result['mother_contact_number'])){echo $result['mother_contact_number'];} ?>" name="mother-contact-number" placeholder="Mother Contact Number" id="mother-contact-number">
							</div>

							<div class="form-group">
								<label for="mother-email">Mother Email (<code title="required"> * </code>)</label>
								<input type="email" value="<?php if(isset($result['mother_email'])){echo $result['mother_email'];} ?>" name="mother-email" placeholder="Mother Email" id="mother-email">
							</div>						
						</div>

						<div id="guardian" class="no-collapsed">
							<div class="form-group">
								<label for="guardian-name">Guardian Name (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['guardian_name'])){echo $result['guardian_name'];} ?>" name="guardian-name" placeholder="Guardian Name" id="guardian-name">
							</div>

							<div class="form-group">
								<label for="guardian-occupation">Guardian Occupation (<code title="required"> * </code>)</label>
								<input type="text" value="<?php if(isset($result['guardian_occupation'])){echo $result['guardian_occupation'];} ?>" name="guardian-occupation" placeholder="Guardian Occupation" id="guardian-occupation">
							</div>

							<div class="form-group">
								<label for="guardian-contact-number">Guardian Contact Number (<code title="required"> * </code>)</label>
								<input type="number" value="<?php if(isset($result['guardian_contact_number'])){echo $result['guardian_contact_number'];} ?>" name="guardian-contact-number" placeholder="Guardian Contact Number" id="guardian-contact-number">
							</div>

							<div class="form-group">
								<label for="guardian-email">Guardian Email (<code title="required"> * </code>)</label>
								<input type="email" value="<?php if(isset($result['guardian_email">'])){echo $result['					guardian_email'];} ?>" name="guardian-email" placeholder="Guardian Email" id="guardian-email">
							</div>	
						</div>
						<div class="w-100 p-1"></div>
						<div class="form-group d-flex flex-row w-auto float-right">
							<a href="<?php echo $_GET['back']; ?>" class="btn btn-blue m-1">Back</a>
							<button type="submit" name="delete" class="btn btn-blue w-auto m-1">Delete</button>
							<button type="submit" name="reject" class="btn btn-blue w-auto m-1">Reject</button>
							<button type="submit" name="accept" class="btn btn-blue w-auto m-1">Accept</button>
						</div>						
					</div>
				</fieldset>
			</div>
		</form>
	</div>
</div>

<?php require_once("../templates/footer.php"); ?>