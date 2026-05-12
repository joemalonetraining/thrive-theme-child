<?php
/**
 * Reusable shell for placeholder support pages.
 */

$page = wp_parse_args(
	$args['page'] ?? [],
	[
		'eyebrow' => 'JM Training',
		'title' => get_the_title(),
		'intro' => 'Placeholder page framework. Final copy and page sections will be added later.',
		'cta_label' => 'Request Information',
		'cta_href' => '#ghl-course-signup',
		'cards' => [],
		'notes' => [],
	]
);

$logo_uri = get_stylesheet_directory_uri() . '/assets/images/jm-logo.png';
$support_home_url = home_url('/landing-test/');
?>

<div class="jm-support-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($support_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($logo_uri); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Training framework</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="<?php echo esc_url($page['cta_href']); ?>">
			<?php echo esc_html($page['cta_label']); ?>
		</a>
	</header>

	<main class="support-main">
		<section class="support-hero" aria-labelledby="support-page-title">
			<div class="support-hero-inner">
				<p class="support-eyebrow"><?php echo esc_html($page['eyebrow']); ?></p>
				<h1 id="support-page-title"><?php echo esc_html($page['title']); ?></h1>
				<p><?php echo esc_html($page['intro']); ?></p>
				<a class="support-button" href="<?php echo esc_url($page['cta_href']); ?>">
					<?php echo esc_html($page['cta_label']); ?>
				</a>
				<!-- Replace this placeholder href with the final Go High Level form/payment URL or embed anchor later. -->
			</div>
		</section>

		<?php if (! empty($page['cards'])) : ?>
			<section class="support-section" aria-label="Placeholder page sections">
				<div class="support-grid">
					<?php foreach ($page['cards'] as $card) : ?>
						<article class="support-card">
							<h2><?php echo esc_html($card['title']); ?></h2>
							<p><?php echo esc_html($card['text']); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if (! empty($page['notes'])) : ?>
			<section class="support-section support-notes" aria-label="Implementation notes">
				<h2>Implementation Notes</h2>
				<ul>
					<?php foreach ($page['notes'] as $note) : ?>
						<li><?php echo esc_html($note); ?></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>
	</main>
</div>
