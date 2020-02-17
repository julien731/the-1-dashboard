<?php
use RestService\RestService;

$create_user = filter_input( INPUT_POST, 'create_user', FILTER_SANITIZE_STRING );

if ( 'true' === $create_user ) {

	// Mandatory fields.
	$payload = [
		'first_name' => filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ),
		'last_name' => filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ),
		'mobile_country' => filter_input( INPUT_POST, 'phone_prefix', FILTER_SANITIZE_STRING ),
		'mobile' => filter_input( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING ),
		'otp_request_id' => 'request_for_development',
		'marketing_consent' => true,
		'tc' => true,
		'nationality_id' => filter_input( INPUT_POST, 'nationality_id', FILTER_SANITIZE_STRING ),
		'date_of_birth' => filter_input( INPUT_POST, 'date_of_birth', FILTER_SANITIZE_STRING ),
	];

	// Optional and dynamic fields.
	$options = [
		'document_country_code' => filter_input( INPUT_POST, 'document_country_code', FILTER_SANITIZE_STRING ),
		'passport_no' => filter_input( INPUT_POST, 'passport_number', FILTER_SANITIZE_STRING ),
		'citizen_id' => filter_input( INPUT_POST, 'citizen_id', FILTER_SANITIZE_STRING ),
		'email' => filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING ),
		'pin' => filter_input( INPUT_POST, 'pin', FILTER_SANITIZE_STRING ),
	];

	foreach ( $options as $option => $value ) {
		if ( ! empty( $value ) ) {
			$payload[ $option ] = $value;
		}
	}

	$restService = new RestService();

	// 1. Request registration OTP.
	$request_otp = $restService
		->setEndpoint('https://uat-api.the1.co.th')
		->setRequestHeaders( [
			'Content-Type' => 'application/json',
			'Accept-Language' => 'en',
		] )
		->post('/v2/otps?type=registration', [
				'mobile_country_code' => $payload['mobile_country'],
				'mobile_number' => $payload['mobile'],
				'type' => 'registration',
		] );

	$opt_request_id = $request_otp->data->attributes->request_id;

	// 2. Verify OTP
	$verify_otp = $restService
		->setEndpoint('https://uat-api.the1.co.th')
		->setRequestHeaders( [
			'Content-Type' => 'application/json',
			'Accept-Language' => 'en',
		] )
		->post('/v2/otps/verify', [
			'otp_request_id' => $opt_request_id,
			'otp_code' => '123456',
		] );

	$response = $restService
		->setEndpoint('https://uat-api.the1.co.th')
		->setRequestHeaders( [
			'Content-Type' => 'application/json',
			'Accept-Language' => 'en',
		] )
		->post('/v2/accounts', $payload );

}
?>
<div class="animated fadeIn">

	<div class="row">

		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<strong>Member Details</strong>
				</div>
				<div class="card-body card-block">
					<pre>
						<code>
							<?php print_r( $response->data ); ?>
						</code>
					</pre>
				</div>
			</div>
		</div>

	</div>


</div>
