<?php
/**
 * Footer section template.
 * @package WordPress
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<?php if(!(strlen(get_theme_mod( 'textarea_copy' )) == 0 && strlen(get_theme_mod( 'custom_text_right' )) == 0)) : ?> 
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<div class="footercopy"><?php echo get_theme_mod( 'textarea_copy', 'custom footer text left' ); ?></div>
			<div class="footercredit"><?php echo get_theme_mod( 'custom_text_right', 'custom footer text right' ); ?></div>
			<div class="clear"></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php endif; ?>
		<div class="site-wordpress">	
			All content &copy; 2009 &mdash; <?php echo date('Y'); ?> <a href="/">Geoffrey Liu</a>.
		</div><!-- .site-info -->
		<div class="clear"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- user-defined scripts -->
<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents=_qevents||[];(function(){var e=document.createElement("script");e.src=(document.location.protocol=="https:"?"https://secure":"http://edge")+".quantserve.com/quant.js";e.async=true;e.type="text/javascript";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();_qevents.push({qacct:"p-gxZBSGMCGZ6DU"})
</script>
<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-gxZBSGMCGZ6DU.gif" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

</body>
</html>