<?php
/**
 * Title: Testimonial Strip
 * Slug: onyx-ai/testimonial-strip
 * Categories: onyx-ai
 * Description: Social proof strip with stats and inline testimonial quotes.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"backgroundColor":"charcoal","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-background-color has-background">

	<!-- wp:onyx-ai/proof-strip {"stats":[{"number":"500+","label":"אנשים הוכשרו"},{"number":"50+","label":"עסקים שינו"},{"number":"15+","label":"שנות ניסיון"}],"quotes":[{"quote":"בניתי אוטומציה שחסכה לי 10 שעות בשבוע תוך יום אחד.","author":"דנה לוי","role":"בעלת עסק"}]} /-->

	<!-- wp:columns {"style":{"spacing":{"blockGap":"var:preset|spacing|lg","margin":{"top":"var:preset|spacing|xl"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/testimonial {"quote":"הסדנה של בן שינתה לגמרי את הדרך שאני עובד עם קוד. Cursor + Claude הפכו לכלים הכי חשובים שלי.","author":"יואב כהן","role":"Full Stack Developer","layout":"card"} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/testimonial {"quote":"חסכתי שעות של עבודה ידנית כל שבוע בזכות האוטומציות שלמדתי. ההשקעה החזירה את עצמה תוך שבועיים.","author":"מיכל אברהם","role":"בעלת עסק קטן","layout":"card"} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:onyx-ai/testimonial {"quote":"בן יודע לחבר בין הצד הטכני לצד העסקי. הוא לא רק מלמד כלים — הוא מלמד חשיבה.","author":"רון שפירא","role":"CTO, סטארטאפ","layout":"card"} /-->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
