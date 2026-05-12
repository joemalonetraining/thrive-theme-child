<?php
/**
 * Template Name: Landing Test
 * Template Post Type: page
 */

get_header();

$landing_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
$landing_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : '#top';
$landing_pistol_url = function_exists('jm_training_pistol_url') ? jm_training_pistol_url() : home_url('/handgun-training/');

/*
 * Required image assets:
 * - assets/images/jm-logo.png
 * - assets/images/jmt-performance-leaderboard.png
 * - assets/images/jmt-medical-scenario-training.png
 * - assets/images/program-overview-flier-hq.png
 */
?>

<div class="landing-test-page">
	<header class="site-header" aria-label="Primary navigation">
		<a class="brand" href="<?php echo esc_url($landing_home_url); ?>" aria-label="JM Training home">
			<img class="brand-logo" src="<?php echo esc_url($landing_assets_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Defensive Shooting University</small>
			</span>
		</a>
		<nav class="desktop-nav" aria-label="Program sections">
			<a href="<?php echo esc_url(home_url('/16-hour-illinois-ccl/')); ?>">IL CCL</a>
			<a href="<?php echo esc_url(home_url('/calendar/')); ?>">Calendar</a>
			<a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a>
			<details class="nav-dropdown">
				<summary>Courses</summary>
				<div class="nav-dropdown-menu">
					<a href="<?php echo esc_url($landing_pistol_url); ?>">Pistol</a>
					<a href="<?php echo esc_url(home_url('/rifle/')); ?>">Rifle</a>
					<a href="<?php echo esc_url(home_url('/rifle-pistol/')); ?>">Rifle &amp; Pistol</a>
				</div>
			</details>
			<a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
			<a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a>
		</nav>
		<a class="header-cta" href="mailto:support@joemalonetraining.com?subject=Defensive%20Shooting%20University%20Inquiry">
			<i data-lucide="send" aria-hidden="true"></i>
			Apply
		</a>
	</header>

	<main id="top">
		<section class="program-hero" style="--landing-hero-image: url('<?php echo esc_url($landing_assets_uri . '/program-overview-flier-hq.png'); ?>');" aria-labelledby="program-title">
			<div class="program-hero-inner">
				<p class="eyebrow">JM Training Defensive Shooting University</p>
				<h1 id="program-title">Structured. Disciplined. Earned.</h1>
				<p class="program-hero-copy">
					A progression system designed to take you from foundational ownership to advanced integrated defensive
					capability through online study, live reps, measurable standards, and serious accountability.
				</p>
				<div class="hero-actions" aria-label="Primary calls to action">
					<a class="button button-primary" href="#tiers">
						<i data-lucide="route" aria-hidden="true"></i>
						View Membership Tiers
					</a>
					<a class="button button-secondary" href="#private-training">
						<i data-lucide="target" aria-hidden="true"></i>
						Private Training Options
					</a>
				</div>
				<div class="program-proof-list" aria-label="Program proof points">
					<span>Real skill</span>
					<span>Real standards</span>
					<span>Real accountability</span>
					<span>Real results</span>
				</div>
			</div>
		</section>

		<section class="section program-path-section" id="path" aria-labelledby="path-title">
			<div class="section-inner program-path-grid">
				<div>
					<p class="eyebrow">This is not a range membership</p>
					<h2 id="path-title">This is a path.</h2>
					<p>
						The program is built for people who want more than casual range time. Members get a structured training
						environment, clear expectations, and a roadmap that rewards preparation and performance.
					</p>
				</div>
				<div class="program-standards" aria-label="Program standards">
					<article>
						<i data-lucide="clipboard-check" aria-hidden="true"></i>
						<span>Show up prepared</span>
					</article>
					<article>
						<i data-lucide="crosshair" aria-hidden="true"></i>
						<span>Train with purpose</span>
					</article>
					<article>
						<i data-lucide="award" aria-hidden="true"></i>
						<span>Qualify before advancing</span>
					</article>
					<article>
						<i data-lucide="users-round" aria-hidden="true"></i>
						<span>Stay accountable</span>
					</article>
				</div>
			</div>
		</section>

		<section class="section program-includes-section" id="includes" aria-labelledby="includes-title">
			<div class="section-inner">
				<div class="section-heading">
					<p class="eyebrow">Included program pillars</p>
					<h2 id="includes-title">Everything points back to measurable progress.</h2>
					<p>
						JM Training is integrating technology in a way most of the firearms training industry has never seen:
						your progress can be tracked from the very first shot you ever take with us and carried forward from your
						own phone.
					</p>
				</div>

				<div class="program-tech-showcase">
					<figure>
						<img src="<?php echo esc_url($landing_assets_uri . '/jmt-performance-leaderboard.png'); ?>" alt="JMT Performance leaderboard showing shooter rankings and timed results">
					</figure>
					<div>
						<p class="eyebrow">JMT Performance tracking</p>
						<h3>Your phone connects your training record to the in-house leaderboard.</h3>
						<p>
							Members can track standards, reps, and performance over time, then connect that progress to live
							leaderboard challenges for prizes and bragging rights. It turns training into a measurable record, not a
							memory of how a range day felt.
						</p>
						<div class="program-tech-stats" aria-label="Technology benefits">
							<span>First-shot progress history</span>
							<span>Phone-based tracking</span>
							<span>Live rankings</span>
							<span>Prizes and bragging rights</span>
						</div>
					</div>
				</div>

				<div class="program-feature-grid">
					<article>
						<i data-lucide="monitor-play" aria-hidden="true"></i>
						<h3>Online University</h3>
						<p>Defensive Shooting University with required modules for each level.</p>
					</article>
					<article>
						<i data-lucide="crosshair" aria-hidden="true"></i>
						<h3>Live Training Environment</h3>
						<p>Full-day immersive training blocks across rifle, handgun, low-light, movement, and medical.</p>
					</article>
					<article>
						<i data-lucide="calendar-check" aria-hidden="true"></i>
						<h3>Members-Only Access</h3>
						<p>Open range access, competition nights, group training events, and more.</p>
					</article>
					<article>
						<i data-lucide="users-round" aria-hidden="true"></i>
						<h3>Community &amp; Accountability</h3>
						<p>Private Telegram group, monthly gun cleaning and networking event, and a committed member network.</p>
					</article>
					<article>
						<i data-lucide="award" aria-hidden="true"></i>
						<h3>Legal Seminars &amp; Scenarios</h3>
						<p>Free legal seminars and multiple in-house scenario-based trainings every month, included at all levels.</p>
					</article>
					<article>
						<i data-lucide="map-pinned" aria-hidden="true"></i>
						<h3>Advancement Roadmap</h3>
						<p>At-your-own-pace roadmap with clear standards and measurable progression.</p>
					</article>
					<article>
						<i data-lucide="key-round" aria-hidden="true"></i>
						<h3>Try Gear Before Buying</h3>
						<p>Test a variety of guns and gear before you buy, so purchases match your training instead of guesswork.</p>
					</article>
					<article>
						<i data-lucide="shield" aria-hidden="true"></i>
						<h3>Free USCCA Membership</h3>
						<p>Every membership level includes a free USCCA membership.</p>
					</article>
				</div>
			</div>
		</section>

		<section class="section program-tiers-section" id="tiers" aria-labelledby="tiers-title">
			<div class="section-inner">
				<div class="section-heading compact-heading">
					<p class="eyebrow">Membership tiers</p>
					<h2 id="tiers-title">Choose the amount of structure you want around your training.</h2>
				</div>

				<div class="program-tier-grid">
					<article class="program-tier-card">
						<div class="program-tier-topline">
							<span>The Starter Program</span>
						</div>
						<h3><span>$62.99</span> /mo</h3>
						<ul>
							<li>Defensive Shooting University online access</li>
							<li>Telegram group chat access</li>
							<li>At-your-own-pace advancement roadmap</li>
							<li>Group training events in Frankfort</li>
							<li>Competition nights in Bourbonnais</li>
							<li>Monthly gun cleaning and networking event</li>
							<li>Free legal seminars and in-house scenario trainings</li>
							<li>Try a variety of guns and gear before buying</li>
							<li>Free USCCA membership</li>
						</ul>
						<a class="segment-link" href="mailto:support@joemalonetraining.com?subject=Starter%20Program%20Inquiry">
							Ask About Starter
							<i data-lucide="send" aria-hidden="true"></i>
						</a>
					</article>

					<article class="program-tier-card">
						<div class="program-tier-topline">
							<span>Pro Performance Package</span>
						</div>
						<h3><span>$99.99</span> /mo</h3>
						<p class="program-tier-note">Includes everything in the Starter Program, plus:</p>
						<ul>
							<li>Members-only open range access</li>
							<li>Tues-Thurs: 12-8pm | Fri: 12-5pm</li>
							<li>50% off all qualification courses, Levels 0-5</li>
							<li>Discounted medical and first aid training blocks</li>
							<li>$25 gun transfers</li>
							<li>5% off limited in-store items: firearms, ammo, accessories</li>
							<li>Priority access to the training schedule</li>
						</ul>
						<a class="segment-link" href="mailto:support@joemalonetraining.com?subject=Pro%20Performance%20Package%20Inquiry">
							Ask About Pro
							<i data-lucide="send" aria-hidden="true"></i>
						</a>
					</article>

					<article class="program-tier-card program-tier-featured">
						<div class="program-tier-topline">
							<span>Defensive Shooting University</span>
						</div>
						<h3><span>$199.99</span> /mo</h3>
						<p class="program-tier-note">Includes everything in the Pro Performance Package, plus:</p>
						<ul>
							<li>All qualification courses included, Levels 0-5</li>
							<li>Medical and first aid training blocks included</li>
							<li>Private access to your own outdoor range in Frankfort, IL</li>
							<li>$25 gun transfers</li>
							<li>5–15% off firearms, ammo, and store items</li>
							<li>Accelerated progression through the training pipeline</li>
						</ul>
						<a class="segment-link" href="mailto:support@joemalonetraining.com?subject=Defensive%20Shooting%20University%20Membership%20Inquiry">
							Ask About DSU
							<i data-lucide="send" aria-hidden="true"></i>
						</a>
					</article>
				</div>
			</div>
		</section>

		<section class="section program-medical-section" id="medical-training" aria-labelledby="medical-title">
			<div class="section-inner program-medical-grid">
				<figure class="program-medical-image">
					<img src="<?php echo esc_url($landing_assets_uri . '/jmt-medical-scenario-training.png'); ?>" alt="JM Training students practicing medical and scenario-based training">
				</figure>
				<div>
					<p class="eyebrow">Medical and scenario training</p>
					<h2 id="medical-title">Defensive capability has to include decision-making and first aid.</h2>
					<p>
						Members get regular in-house scenario-based training that tests judgment, communication, movement, and
						problem solving. Medical and first aid training blocks are included in Defensive Shooting University and
						discounted for Pro Performance members.
					</p>
					<div class="program-medical-list" aria-label="Medical and scenario benefits">
						<span>Multiple scenario trainings every month</span>
						<span>Legal seminars included at every level</span>
						<span>Medical blocks included for DSU</span>
						<span>Medical blocks discounted for Pro</span>
					</div>
				</div>
			</div>
		</section>

		<section class="section program-training-section" id="private-training" aria-labelledby="private-training-title">
			<div class="section-inner program-training-grid">
				<article class="program-private-panel">
					<p class="eyebrow">Private training</p>
					<h2 id="private-training-title">1:1 or small group, max 3 people.</h2>
					<div class="program-price-row">
						<span><strong>$99</strong> /hour</span>
						<span><strong>$250</strong> /3 hours</span>
					</div>
					<ul>
						<li>Remediation</li>
						<li>Fast-track progression</li>
						<li>Skill-specific focus</li>
						<li>High-value correction</li>
					</ul>
					<a class="segment-link" href="mailto:ceo@joemalonetraining.com?subject=Request%201-1%20Training">
						Request 1-1 training here
						<i data-lucide="send" aria-hidden="true"></i>
					</a>
				</article>

				<article class="program-event-panel">
					<p class="eyebrow">Monthly event</p>
					<h2>Gun cleaning &amp; networking event.</h2>
					<p>First Tuesday of every month.</p>
					<i data-lucide="key-round" aria-hidden="true"></i>
				</article>
			</div>
		</section>

		<section class="section program-original-section" aria-labelledby="original-title">
			<div class="section-inner program-original-grid">
				<div>
					<p class="eyebrow">From the printed overview</p>
					<h2 id="original-title">Download the program flier here</h2>
					<p>
						Click the image to download the program overview flier.
					</p>
					<p class="location-line">
						<i data-lucide="map-pin" aria-hidden="true"></i>
						Serving the Chicagoland area with indoor and outdoor training environments.
					</p>
				</div>
				<figure class="program-flier-frame">
					<a href="<?php echo esc_url($landing_assets_uri . '/program-overview-flier-hq.png'); ?>" download="program-overview-flier-hq.png" aria-label="Download the JM Training program overview flier">
						<img src="<?php echo esc_url($landing_assets_uri . '/program-overview-flier-hq.png'); ?>" alt="JM Training Defensive Shooting University program overview flyer">
					</a>
				</figure>
			</div>
		</section>

		<section class="cta-section program-cta-section" aria-labelledby="program-cta-title">
			<div class="cta-inner">
				<p class="eyebrow">This is earned, not given</p>
				<h2 id="program-cta-title">Train with purpose. Build real capability. Operate at a higher standard.</h2>
				<p>Show up. Perform. Qualify. Advance.</p>
				<div class="cta-actions">
					<a class="button button-primary" href="mailto:support@joemalonetraining.com?subject=Defensive%20Shooting%20University%20Inquiry">
						<i data-lucide="send" aria-hidden="true"></i>
						Contact JM Training
					</a>
					<a class="button button-secondary" href="tel:17087260946">
						<i data-lucide="phone" aria-hidden="true"></i>
						708-726-0946
					</a>
				</div>
				<address class="contact-list">
					<a href="tel:17087260946">Phone: 708-726-0946</a>
					<a href="mailto:support@joemalonetraining.com">Email: support@joemalonetraining.com</a>
					<span>Instagram: Joe_Malone_training</span>
				</address>
			</div>
		</section>
	</main>

	<a class="mobile-sticky-cta" href="mailto:support@joemalonetraining.com?subject=Defensive%20Shooting%20University%20Inquiry">
		<i data-lucide="send" aria-hidden="true"></i>
		Contact JM Training
	</a>
</div>

<?php
get_footer();
