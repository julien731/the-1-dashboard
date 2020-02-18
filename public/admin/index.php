<?php
require('../../vendor/autoload.php');
require_once( 'partials/header.php' );
?>

<body>
    <?php require_once( 'partials/nav.php' ); ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php require_once( 'partials/top-nav.php' ); ?>
        <!-- Content -->
        <div class="content">
	        <?php
	        $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );

	        $pages = [
	            'demo' => 'demo.php',
	            'register-user' => 'register-user.php',
	            'view-user' => 'view-user.php',
	        ];

	        if ( array_key_exists( $page, $pages ) ) {
	        	$file = $pages[ $page ];
		        require_once( "partials/pages/$file" );
	        }

	        ?>
        </div>
        <?php require_once( 'partials/footer.php' ); ?>
    </div>
    <!-- /#right-panel -->

    <?php require_once( 'partials/scripts.php' ); ?>
</body>
</html>
