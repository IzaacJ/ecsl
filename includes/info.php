<?php
/**
 * Created by PhpStorm.
 * User: Izaac
 * Date: 2015-02-09
 * Time: 16:49
 */
add_action( 'admin_menu', 'ecsl_menu' );

/** Step 1. */
function ecsl_menu() {
	add_submenu_page( 'edit.php?post_type=ecsl', 'Info', 'Info', 'edit_posts', 'ecsl-menu_info', 'ecsl_menu_info' );
}
function ecsl_menu_info() {
	if ( !current_user_can( 'edit_posts' ) )  {
		echo __( 'You do not have sufficient permissions to access this page.' );
		return;
	}
	?>
	<style type="text/css">
		/* <editor-fold desc="*** My CSS ***">*/
		.wrapper { width: 100%; height: 100%; }
		.content { margin: 15px; }
		h1.title,
		h2.title,
		h3.title { display: inline-block; margin: 5px; }
		sup.version {  }
		div.spacer { height: 15px; }
		/* </editor-fold> */
		/* <editor-fold desc="*** Mobile/PC CSS ***">*/
		@media only screen and (max-width: 720px) {
			.no-mobile { display: none !important; }
			.description:before { content: "Description:\A"; font-weight: bold; }
		}
		@media only screen and (min-width: 721px) {
			.no-pc { display: none !important; }
		}
		/* </editor-fold>*/
		/* <editor-fold desc="*** Grid CSS ***">*/
		.row-header {
			border-bottom: 2px solid #000000;
		}
		.row-colored {
			background: #cfcfcf;
		}
		.col-header {
			border-bottom: 1px solid #000000;
		}
		.row-header .col {
			margin: 0px;
		}
		.border { border-bottom: 1px solid #888888; }

		/*  SECTIONS  */
		.section {
			clear: both;
			padding: 0px;
			margin: 0px;
		}

		/*  COLUMN SETUP  */
		.col {
			display: block;
			float:left;
			margin: 1% 0 1% 1.6%;
		}
		.col:first-child { margin-left: 0; }

		/*  GROUPING  */
		.group:before,
		.group:after { content:""; display:table; }
		.group:after { clear:both;}
		.group { zoom:1; /* For IE 6/7 */ }

		/*  GRID OF EIGHT  */
		.span_8_of_8 {
			width: 100%;
		}
		.span_7_of_8 {
			width: 87.3%;
		}
		.span_6_of_8 {
			width: 74.6%;
		}
		.span_5_of_8 {
			width: 61.9%;
		}
		.span_4_of_8 {
			width: 49.2%;
		}
		.span_3_of_8 {
			width: 36.5%;
		}
		.span_2_of_8 {
			width: 23.8%;
		}
		.span_1_of_8 {
			width: 11.1%;
		}

		/*  GO FULL WIDTH BELOW 720 PIXELS */
		@media only screen and (max-width: 720px) {
			.col {  margin: 1% 0 1% 0%; }
			.span_1_of_8, .span_2_of_8, .span_3_of_8, .span_4_of_8, .span_5_of_8, .span_6_of_8, .span_7_of_8, .span_8_of_8 { width: 100%; }
		}
/*#</editor-fold>*/
	</style>
	<div class="wrapper">
		<div class="content">
			<div class="section group row-header">
				<div class="col span_8_of_8">
					<h2 class="title">Easy Code Snippet Library</h2> <sup class="version">(<?=ECSL_VERSION;?>)</sup>
				</div>
			</div>
			<div class="spacer no-pc"></div>
			<div class="section group">
				<div class="col span_3_of_8 col-header">
					<h3 class="title no-mobile">Shortcode</h3><h3 class="title no-pc">Shortcodes</h3>
				</div>
				<div class="col span_3_of_8 col-header no-mobile">
					<h3 class="title">Description</h3>
				</div>
				<div class="col span_2_of_8 col-header no-mobile">
					<h3 class="title">Attributes</h3>
				</div>
			</div>
			<div class="section group border">
				<div class="col span_3_of_8">
					<code>[ecsl-snippet id="{id/id,id,id,...}" code_only="{true/false}"]</code>
				</div>
				<div class="col span_3_of_8 description">
					Shows a specific code snippet, or a list of snippets after eachother.
				</div>
				<div class="col span_1_of_8">
					<strong>int</strong> <i>id</i> : Single or comma seperated list of snippet ID's to show.
				</div>
				<div class="col span_1_of_8">
					<strong>bool</strong> <i>code_only</i> : Decides if to show title, date, author and tags together with the code. <i>Default: true</i>.
				</div>
			</div>
			<div class="section group row-colored border">
				<div class="col span_3_of_8">
					<code>[ecsl-snippets]</code>
				</div>
				<div class="col span_3_of_8 description">
					Generates a list of all code snippets in the database.
				</div>
				<div class="col span_1_of_8">
					<strong>null</strong> <i>none</i> : No attributes at the moment
				</div>
				<div class="col span_1_of_8">

				</div>
			</div>
			<div class="spacer"></div>
			<div class="section group row-header">
				<div class="col span_8_of_8">
					<h3 class="title">Credits</h3>
				</div>
			</div>
			<div class="section group">
				<div class="col span_1_of_8">
					<strong>Developer</strong>
				</div>
				<div class="col span_1_of_8">
					<i>Izaac Johansson</i>
				</div>
				<div class="col span_1_of_8">
					<strong>Developer</strong>
				</div>
				<div class="col span_1_of_8">
					<i>Izaac Johansson</i>
				</div>
				<div class="col span_1_of_8">
					<strong>Developer</strong>
				</div>
				<div class="col span_1_of_8">
					<i>Izaac Johansson</i>
				</div>
				<div class="col span_1_of_8">
					<strong>Developer</strong>
				</div>
				<div class="col span_1_of_8">
					<i>Izaac Johansson</i>
				</div>
			</div>
		</div>
	</div>
	<?php
}