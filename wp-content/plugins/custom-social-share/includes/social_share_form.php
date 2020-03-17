<?php

$shareoptions = explode(",", get_option( 'custom_social_share' ));
$social_share = array();
foreach ($shareoptions as $key => $value) {
	$social_share[$value] = 'checked';
}


?>


<style type="text/css">
	.post-product-share {
		background-color: #fff;
	}
	.post-product-share table {
	    width: 100%;
	    padding: 30px;
	}
</style>
<div>
	<h2>Social Sharer</h2>
	<div class="post-product-share">
		<form class="post-product-share-form" method="POST">
			<table>
				<tr>
					<td><label>Facebook <span><input type="checkbox" name="facebook" value="facebook" <?php echo $social_share["facebook"]; ?>></span> </label></td>
					
					<td><label>Google + <span><input type="checkbox" name="google_plus" value="google_plus"<?php echo $social_share["google_plus"]; ?>></span> </label></td>
					<td><label>Twitter <span><input type="checkbox" name="twitter" value="twitter"<?php echo $social_share["twitter"]; ?>></span> </label></td>
					<td><label>LinkedIn <span><input type="checkbox" name="linkedin" value="linkedin"<?php echo $social_share["linkedin"]; ?>></span> </label></td>
					<td><label>Pinterest <span><input type="checkbox" name="pinterest" value="pinterest"<?php echo $social_share["pinterest"]; ?>></span> </label></td>
					
					<td><input type="submit" name="save" value="Save" class="button button-primary"></td>
				</tr>
			</table>			
		</form>
	</div>
</div>