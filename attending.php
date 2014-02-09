<?php
/*
Plugin Name: Liste des participants
Plugin URI: http://jihais.se
Description: yeah
Version: 1.0
Author: Jihaisse
Author URI: http://jihais.se
*/
function userlisting_func( $atts ){
	extract( shortcode_atts( array(
		'logins' => '',
		), $atts ) );
	$logins = array_map( 'trim', explode( ',', $atts['logins'] ) );
	ob_start();
	?>
	<ul class="participants">
	<?php
	foreach ($logins as $login) {
		$user = get_user_by( 'login', $login );
		?>
		<li>
			<span>
				<?php echo get_avatar(get_the_author_meta('user_email', $user->ID), 80); ?>
			</span>
			<strong><?php echo $user->display_name?></strong>
			<?php if(get_the_author_meta('profession', $user->ID)): ?>
				<br /><?php the_author_meta('profession', $user->ID); ?>
			<?php endif ?>
			<?php if(get_the_author_meta('entreprise', $user->ID)): ?>
				<br />Entreprise : <a href="<?php the_author_meta('sitewebentreprise', $user->ID); ?>"><?php the_author_meta('entreprise', $user->ID); ?></a>
			<?php endif ?>
			<?php if(get_the_author_meta('url', $user->ID)): 
				$url_name = str_replace("http://", '',get_the_author_meta('url', $user->ID));
				$url_name = str_replace('www.', '', $url_name);
				$url_name = str_replace('/', '', $url_name);
			?>
				<br />Site web : <a href="<?php the_author_meta('url', $user->ID); ?>" target="_blank"><?php echo $url_name; ?></a>
			<?php endif ?>
			<br />
			<?php if(get_the_author_meta('linkedin', $user->ID)): ?>
			<a href="<?php the_author_meta('linkedin', $user->ID); ?>">
				<img class="alignleft size-full wp-image-931" title="linkedin" src="http://www.chambe-carnet.com/wp-content/uploads/2011/01/linkedin.png" alt="linkedin" width="20" height="18" />
			</a>
			<?php endif ?>
			<?php if(get_the_author_meta('viadeo', $user->ID)): ?>
			<a href="<?php the_author_meta('viadeo', $user->ID); ?>">
				<img class="alignleft size-full wp-image-934" title="viadeo" src="http://www.chambe-carnet.com/wp-content/uploads/2011/01/viadeo.png" alt="viadeo" width="20" height="18" />
			</a>
			<?php endif ?>
			<?php if(get_the_author_meta('twitter', $user->ID)): ?>
			<a href="<?php the_author_meta('twitter', $user->ID); ?>">
				<img class="alignleft size-full wp-image-933" title="twitter" src="http://www.chambe-carnet.com/wp-content/uploads/2011/01/twitter.png" alt="twitter" width="18" height="18" />
			</a>
			<?php endif ?>
		</li>
		<?php
	}
	?>
	</ul>
	<?php
	return ob_get_clean();
}
add_shortcode( 'participants', 'userlisting_func' );
?>