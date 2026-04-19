<?php
/**
 * Title: Service Card Grid
 * Slug: onyx-ai/service-card-grid
 * Categories: onyx-ai
 * Description: Section label followed by a 3-column grid of service cards.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"backgroundColor":"charcoal","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-background-color has-background">

	<!-- wp:onyx-ai/section-label {"number":"03","label":"תהליכים קבוצתיים"} /-->

	<!-- wp:columns {"style":{"spacing":{"blockGap":"var:preset|spacing|lg","margin":{"top":"var:preset|spacing|xl"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/service-card {"icon":"zap","title":"התנעה למפתחים","description":"סדנת חצי יום מעשית — מ-0 לכלי AI בזרימת העבודה שלך.","audienceTag":"dev","serviceType":"group","format":"חצי יום · מפגש אחד","ctaLabel":"לפרטים","ctaUrl":"/developers","featured":true} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/service-card {"icon":"trending-up","title":"האצה למפתחים","description":"תהליך קבוצתי חודשי — העמקה, פרקטיקות מתקדמות ועבודה עם Claude API.","audienceTag":"dev","serviceType":"group","format":"חודש · 4 מפגשים","ctaLabel":"לפרטים","ctaUrl":"/developers"} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/service-card {"icon":"user","title":"ליווי אישי","description":"עבודה אחד-על-אחד — נגיע לכל מה שדרוש לפי הקצב שלך.","audienceTag":"all","serviceType":"personal","format":"לפי שעה","ctaLabel":"לקביעת שיחה","ctaUrl":"/developers"} /-->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
