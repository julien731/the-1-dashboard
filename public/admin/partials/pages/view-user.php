<?php
use GuzzleHttp\Client;

$create_user = filter_input( INPUT_POST, 'create_user', FILTER_SANITIZE_STRING );

if ( 'true' === $create_user ) {

	$pdpa = filter_input( INPUT_POST, 'marketing', FILTER_SANITIZE_STRING );
	$tc = filter_input( INPUT_POST, 'tc', FILTER_SANITIZE_STRING );

	// Mandatory fields.
	$payload = [
		'first_name' => filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING ),
		'last_name' => filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING ),
		'mobile_country' => filter_input( INPUT_POST, 'phone_prefix', FILTER_SANITIZE_STRING ),
		'mobile' => filter_input( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING ),
		'otp_request_id' => 'request_for_development',
		'marketing_consent' => 'Y' === $pdpa ? true : false,
		'tc' => 'Y' === $tc ? true : false,
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
		'password' => filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING ),
	];

	foreach ( $options as $option => $value ) {
		if ( ! empty( $value ) ) {
			$payload[ $option ] = $value;
		}
	}

	$client = new Client([
		// Base URI is used with relative requests
		'base_uri' => 'https://uat-api.the1.co.th/v2/',
	]);

	// Prepare headers.
	$headers = [
		'Content-Type' => 'application/json',
		'Accept-Language' => 'en',
	];

	// 1. Request registration OTP.
	$request_otp = $client->request(
		'POST',
		'otps?type=registration',
		[ 'form_params' => [
			'mobile_country_code' => $payload['mobile_country'],
			'mobile_number' => $payload['mobile'],
			'type' => 'registration',
		] ]
	);

	$otp_response = json_decode( $request_otp->getBody(), true );
	$opt_request_id = $otp_response['data']['attributes']['request_id'];

	// 2. Verify OTP
	$request_otp = $client->request(
		'POST',
		'otps/verify',
		[ 'form_params' => [
			'otp_request_id' => $opt_request_id,
			'otp_code' => '123456',
		] ]
	);

	try {
		$response = $client->request(
			'POST',
			'accounts',
			[ 'form_params' => $payload ]
		);

		$data = json_decode( $response->getBody(), true );

	} catch ( \GuzzleHttp\Exception\ClientException $e ) {

		$error = json_decode( $e->getResponse()->getBody(), true );

		if ( isset( $error['errors'][0]['meta']['response'] ) ) {
			echo '<h2>Response</h2>';
			echo '<pre><code>';
			print_r( $error['errors'][0]['meta']['response'] );
			echo '</pre></code>';
		}

		if ( isset( $error['errors'][0]['meta']['request'] ) ) {
			echo '<h2>Request</h2>';
			echo '<pre><code>';
			print_r( $error['errors'][0]['meta']['request'] );
			echo '</pre></code>';
		}

		return;

	}
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
							<?php
							echo '<pre><code>';
							print_r( $data['data'] );
							echo '</pre></code>';
							?>
						</code>
					</pre>
				</div>
			</div>
		</div>

	</div>


</div>
