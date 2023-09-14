<?php
	global $current_user, $wpdb, $pmpro_reports;
?>
<html>
	<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="theme-color" content="#2997c8">
	<link rel="stylesheet" id="googleFonts-css" href="//fonts.googleapis.com/css?family=Lato:400,700&ver=4.3.1" type="text/css" media="all">
	<link rel="manifest" href="<?php echo plugins_url( 'manifest.json' ); ?>">
	<link rel="apple-touch-icon" href="<?php echo plugins_url( '/images/icon-180.png', dirname(__FILE__ ) ); ?>" />
	<script type='text/javascript' src='<?php echo esc_url( includes_url( 'js/jquery/jquery.js') );?>'></script>
	<script type='text/javascript' src='<?php echo esc_url( plugins_url( 'js/pmpro-reports-dashboard.js', dirname( __FILE__ ) ) );?>'></script>
	<style>
		body {background: #FAFAFA; color: #404040; font-family: 'Lato', sans-serif; font-weight: 400; font-size: 16px; font-size: 1.6rem; line-height: 2.6rem; margin: 0; padding: 0; }
		div {background: #FAFAFA; border-bottom: 5px solid #EEE; padding: 2rem .5rem; }
		p {font-size: 10px; font-size: 1rem; margin: 0; padding: 0; }
		p a {color: #AAA; text-transform: uppercase; }
		table {border: 1px solid #EEE; border-collapse: separate; border-spacing: 0; width: 100%; }
		thead th {background: #EEE; font-size: 12px; font-size: 1.2rem; line-height: 2rem; padding: 1rem .5rem; text-align: left; }
		tbody th {border-top: 1px solid #EEE; font-size: 12px; font-size: 1.2rem; line-height: 2rem; padding: 1rem .5rem; text-align: left; }
		tbody td {border-top: 1px solid #EEE; font-size: 14px; font-size: 1.4rem; line-height: 2.4rem; padding: 1rem .5rem; text-align: left; }
		tbody tr:nth-child(odd) td, tbody tr:nth-child(odd) th {background: #FFF; }
		h2 {color: #AAA; font-size: 18px; font-size: 1.8rem; font-weight: 300; letter-spacing: 1px; margin: 0 0 1rem 0; padding: 0; text-transform: uppercase; }
		#pmpro_report_sales thead th:last-child {text-align: right; }
		.pmpro_report_tr_sub {display: table-row !important; }
		.pmpro_report_tr button {background: none; border: none; color: #404040; font-family: 'Lato', sans-serif; font-weight: 400; font-size: 14px; font-size: 1.4rem; line-height: 2.4rem; padding: 0;}
		.pmpro_report_tr_sub th, .pmpro_report_tr_sub td {font-size: 12px; line-height: 1.6rem; padding: .5rem; }

		#load{
			background:url( '<?php echo plugins_url( "/images/pmpro-icon-pwa.png", dirname( __FILE__ ) ); ?>' ) no-repeat center center;
			background-color:white;
			height: 100%;
			width: 100%;
			position:fixed;
		}
	</style>
	<!-- Show a loading image on initial loads -->
	<script>
		document.onreadystatechange = function () {
		var state = document.readyState
		if (state == 'complete') {
			setTimeout(function(){
				document.getElementById('interactive');
				document.getElementById('load').style.visibility="hidden";
			},1000);
		} else {
			document.getElementById('load').style.visibility="visible";
		}
	}
	</script>

	</head>	
	<body>	
	<div id="load"></div>
	<div class="pmpro_report_container">
		<?php
		//report widgets
		krsort($pmpro_reports);
		$pmpro_reports = apply_filters( 'pmpro_reports_dashboard_reports', $pmpro_reports );
		foreach($pmpro_reports as $report => $title)
		{
			//make sure title is translated (since these are set before translations happen)
			$title = __($title, "pmpro");
			?>
			<div id="pmpro_report_<?php echo esc_attr( $report ); ?>_container">			
				<h2><?php echo $title; ?></h2>
				<?php call_user_func("pmpro_report_" . $report . "_widget"); ?>
				<p style="text-align:center;">
					<a href="<?php echo admin_url("admin.php?page=pmpro-reports&report=" . $report);?>"><?php _e('Full Report', 'pmpro');?></a>
				</p>
			</div>
			<?php
		}
		?>
		</div>
	</body>
		
</html>