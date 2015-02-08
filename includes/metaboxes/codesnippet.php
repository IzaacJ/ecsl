<?php
/**
 * Easy Code Snippets CPT MetaBoxes
 *
 * @package   Easy_CodeSnippet_CPT_MetaBoxes
 * @since     1.0.0
 * @author    Izaac Johansson [izaac.se]
 * @license   LICENSE.txt
 * @link      http://izaac.se
 * @copyright Copyright © 2015 Izaac Johansson
 */
?>
<style type="text/css">
	.row1 { width: 100% !important; padding-bottom: 15px; }
	.col-1 { width: 20%; display: inline-block;}
	.col-2 { width: 80%; display: inline-block; float: right;}
	.tt-input input { width: 400px !important; }
	.clearfix { clear: both; margin-bottom: 15px; }
	#titlediv div.inside { display: none; }
    .widefat-70 {
        min-height: 70px;
    }
    .widefat-300 {
        min-height: 150px;
        height: 300px;
    }
</style>
<div class="my_meta_control">
	<?php $metabox->the_field('language'); ?>
	<div class="row1">
	    <div class="col-1">
	        <label>Language:</label>
	    </div>
	    <div class="col-2">
	        <select name="<?php $metabox->the_name(); ?>">
		        <option value="mixed"<?=selected($metabox->get_the_value(), 'mixed'); ?>>Mixed (Default)</option>
	            <option value="html"<?=selected($metabox->get_the_value(), 'html'); ?>>HTML</option>
	            <option value="css"<?=selected($metabox->get_the_value(), 'css'); ?>>Cascading Style Sheet</option>
	            <option value="php"<?=selected($metabox->get_the_value(), 'php'); ?>>PHP</option>
	            <option value="js"<?=selected($metabox->get_the_value(), 'js'); ?>>JavaScript</option>
	            <!--option value="c"<?=selected($metabox->get_the_value(), 'c'); ?>>C</option>
	            <option value="cpp"<?=selected($metabox->get_the_value(), 'cpp'); ?>>C++</option>
	            <option value="csharp"<?=selected($metabox->get_the_value(), 'csharp'); ?>>C#</option>
	            <option value="vbnet"<?=selected($metabox->get_the_value(), 'vbnet'); ?>>Visual Basic.NET</option-->
	        </select>
	    </div>
	</div>
	<?php $metabox->the_field('description'); ?>
	<div class="row1">
	    <div class="col-1">
	        <label>Description:</label>
	    </div>
		<div class="col-2">
			<textarea name="<?php $metabox->the_name(); ?>" class="widefat widefat-70 snippet-main-content"><?php $metabox->the_value();?></textarea>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php $metabox->the_field('code'); ?>
	<div class="row1">
		<div class="col-1">
			<label>Snippet:</label>
		</div>
		<div class="col-2">
			<!--div class="ace_editor_settings">
				<select id="ace_theme_settings" size="1">
					<?php echo ace_theme_selector_options(); ?>
				</select>
			</div>
			<div id="snippet-content"><?php $metabox->the_value(); ?></div>
			<textarea name="<?php $metabox->the_name(); ?>" class="widefat snippet-main-content" class="hidden"><?php $metabox->the_value() ?></textarea-->
			<textarea name="<?php $metabox->the_name(); ?>" class="prettyprint widefat widefat-300 snippet-main-content"><?php $metabox->the_value() ?></textarea>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row1">
		<div class="col-1"></div>
		<div class="col-2">
			The snippet text box does not support highlightning or auto intendent at the time. That will arrive in a future update.
		</div>
	</div>
	<div class="clearfix"></div>
	<div clas="row">
		Thanks for using <a href="<?=ECSL_HOME_URL;?>" target="_blank">Easy Code Snippets Library</a> (<?=ECSL_VERSION;?>), developed and maintained by <a href="mailto:<?=ECSL_AUTHOR_EMAIL;?>?subject=Easy%20Code%20Snippets%20Library%20v<?=ECSL_VERSION;?>"><?=ECSL_AUTHOR;?></a> (<a href="<?=ECSL_AUTHOR_URL;?>" target="_blank">Izaac.se</a>)
	</div>
</div>
