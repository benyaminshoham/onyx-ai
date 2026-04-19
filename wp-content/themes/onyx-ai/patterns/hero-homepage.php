<?php
/**
 * Title: Hero — Homepage
 * Slug: onyx-ai/hero-homepage
 * Categories: onyx-ai
 * Description: Full-width hero section for the homepage with section label, headline and dual CTAs.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"backgroundColor":"charcoal","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-background-color has-background">

	<!-- wp:onyx-ai/section-label {"number":"01","label":"AI לעסקים, למפתחים ולארגונים"} /-->

	<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"var:preset|font-size|display","fontFamily":"var:preset|font-family|exo-2","fontWeight":"800","lineHeight":"1.0","letterSpacing":"-0.03em"}},"textColor":"white"} -->
	<h1 class="wp-block-heading has-white-color has-text-color">בנה את העתיד שלך<br>עם <mark style="background-color:rgba(0,0,0,0);color:#C8922A" class="has-inline-color">בינה מלאכותית</mark></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"style":{"typography":{"fontFamily":"var:preset|font-family|heebo","fontSize":"var:preset|font-size|lg","fontWeight":"300"}},"textColor":"silver"} -->
	<p class="has-silver-color has-text-color">ליווי מעשי לעסקים, מפתחים וארגונים — מהבסיס ועד לאוטומציה מלאה.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|md","margin":{"top":"var:preset|spacing|lg"}}}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"backgroundColor":"mustard","textColor":"white","style":{"border":{"radius":"8px"},"typography":{"fontFamily":"var:preset|font-family|exo-2","fontWeight":"600","fontSize":"var:preset|font-size|sm"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"}}}} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-mustard-background-color has-white-color has-background has-text-color wp-element-button" href="/developers">אני מפתח →</a></div>
		<!-- /wp:button -->
		<!-- wp:button {"style":{"border":{"radius":"8px","color":"#3D2E10","width":"1px"},"typography":{"fontFamily":"var:preset|font-family|exo-2","fontWeight":"600","fontSize":"var:preset|font-size|sm"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"}},"color":{"text":"#D4A84B","background":"transparent"}}} -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/business">אני בעל עסק →</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
