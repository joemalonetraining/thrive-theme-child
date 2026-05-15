<?php
/**
 * Template Name: JM Memberships
 * Template Post Type: page
 */

get_header();

$logo_uri = get_stylesheet_directory_uri() . '/assets/images/jm-logo.png';
$membership_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');
$membership_tiers = [
	[
		'name' => 'The Starter Program',
		'price' => '$62.99',
		'suffix' => '/mo',
		'href' => home_url('/membership-application/?membership=starter'),
		'cta' => 'Ask About Starter',
		'note' => 'The entry point for online education, community, events, legal seminars, and the JM Training advancement roadmap.',
		'items' => [
			'Defensive Shooting University online access',
			'Telegram group chat access',
			'At-your-own-pace advancement roadmap',
			'Group training events in Frankfort',
			'Competition nights in Bourbonnais',
			'Monthly gun cleaning and networking event',
			'Free legal seminars and in-house scenario trainings',
			'Try a variety of guns and gear before buying',
			'Free USCCA membership',
		],
	],
	[
		'name' => 'Pro Performance Package',
		'price' => '$99.99',
		'suffix' => '/mo',
		'href' => home_url('/membership-application/?membership=pro'),
		'cta' => 'Ask About Pro',
		'note' => 'Includes everything in Starter, then adds range access, discounted qualifications, medical training discounts, and schedule priority.',
		'items' => [
			'Members-only open range access',
			'Tues-Thurs: 12-8pm | Fri: 12-5pm',
			'50% off all qualification courses, Levels 0-5',
			'Discounted medical and first aid training blocks',
			'$25 gun transfers',
			'5% off limited in-store items: firearms, ammo, accessories',
			'Priority access to the training schedule',
		],
	],
	[
		'name' => 'Defensive Shooting University',
		'price' => '$199.99',
		'suffix' => '/mo',
		'href' => home_url('/membership-application/?membership=dsu'),
		'cta' => 'Ask About DSU',
		'featured' => true,
		'note' => 'The full path membership with included qualification courses, included medical blocks, private outdoor range access, and accelerated progression.',
		'items' => [
			'All qualification courses included, Levels 0-5',
			'Medical and first aid training blocks included',
			'Private access to your own outdoor range in Frankfort, IL',
			'$25 gun transfers',
			'5-15% off firearms, ammo, and store items',
			'Accelerated progression through the training pipeline',
		],
	],
];
?>

<div class="jm-support-page jm-memberships-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($membership_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($logo_uri); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Membership program</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="<?php echo esc_url(home_url('/membership-application/?membership=starter')); ?>">
			Start With Starter
		</a>
	</header>

	<main class="memberships-main">
		<section class="memberships-hero" aria-labelledby="memberships-title">
			<div class="memberships-hero-inner">
				<p class="support-eyebrow">JM Training Memberships</p>
				<h1 id="memberships-title">Choose the amount of structure around your training.</h1>
				<p>
					Each membership tier builds around the same standard: disciplined progression, measurable skill, and a
					training environment that rewards preparation and performance.
				</p>
			</div>
		</section>

		<section class="memberships-tier-section" aria-label="Membership tiers">
			<div class="memberships-tier-grid">
				<?php foreach ($membership_tiers as $tier) : ?>
					<article class="memberships-tier-card<?php echo ! empty($tier['featured']) ? ' is-featured' : ''; ?>">
						<div class="memberships-tier-topline">
							<span><?php echo esc_html($tier['name']); ?></span>
							<?php if (! empty($tier['featured'])) : ?>
								<strong>Full Path</strong>
							<?php endif; ?>
						</div>
						<h2><span><?php echo esc_html($tier['price']); ?></span> <?php echo esc_html($tier['suffix']); ?></h2>
						<p><?php echo esc_html($tier['note']); ?></p>
						<ul>
							<?php foreach ($tier['items'] as $item) : ?>
								<li><?php echo esc_html($item); ?></li>
							<?php endforeach; ?>
						</ul>
						<a class="support-button" href="<?php echo esc_url($tier['href']); ?>">
							<?php echo esc_html($tier['cta']); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
	</main>
</div>

<?php
get_footer();
