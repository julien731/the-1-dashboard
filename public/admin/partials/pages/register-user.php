<?php
// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();
?>
<div class="animated fadeIn">

	<div class="row">

		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<strong>New Member</strong>
				</div>
				<div class="card-body card-block">
					<form action="?page=view-user" method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone Prefix</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="phone_prefix" value="66" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone Number</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="phone_number" value="<?php echo str_replace( ' ', '', Faker\Provider\th_TH\PhoneNumber::mobileNumber() ); ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">First Name</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" value="<?php echo $faker->firstName; ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Last Name</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" value="<?php echo $faker->lastName; ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Date of Birth</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="date_of_birth" value="<?php echo $faker->date($format = 'Y-m-d', $max = '2013-01-01') ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
							<div class="col-12 col-md-9"><input type="email" id="email-input" name="email" value="<?php echo $faker->safeEmail; ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">PIN</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="pin" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Nationality ID</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="nationality_id" value="FRA" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Document Country Code</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="document_country_code" value="FRA" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Passport Number</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="passport_number" value="<?php echo $faker->randomNumber( 9 ); ?>" class="form-control"></div>
						</div>
						<div class="row form-group">
							<div class="col col-md-3"><label for="text-input" class=" form-control-label">Citizen ID</label></div>
							<div class="col-12 col-md-9"><input type="text" id="text-input" name="citizen_id" class="form-control"></div>
						</div>
						<div class="form-actions form-group">
							<input type="hidden" name="create_user" value="true">
							<button type="submit" class="btn btn-primary btn-sm">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>


</div>
