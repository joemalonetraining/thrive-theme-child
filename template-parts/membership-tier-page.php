<?php
/**
 * Shared renderer for individual JM Training membership tier pages.
 */

$tier = wp_parse_args(
	$args['tier'] ?? [],
	[
		'eyebrow' => 'JM Training Membership',
		'title' => get_the_title(),
		'label' => '',
		'price' => '',
		'price_suffix' => '/mo',
		'badge' => '',
		'intro' => '',
		'cta_label' => 'Ask About This Membership',
		'cta_href' => home_url('/membership-application/'),
		'overview_href' => home_url('/memberships/'),
		'proof_points' => [],
		'feature_media_heading' => '',
		'feature_media_intro' => '',
		'feature_media' => [],
		'benefits_heading' => 'Included in this membership',
		'benefits' => [],
		'sections' => [],
		'final_heading' => 'Ready to talk through the right membership?',
		'final_text' => 'Send a quick note and JM Training will help you choose the membership tier that matches your current training needs.',
	]
);

$logo_uri = get_stylesheet_directory_uri() . '/assets/images/jm-logo.png';
$image_base_uri = get_stylesheet_directory_uri() . '/assets/images';
$membership_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : home_url('/');
?>

<div class="jm-support-page jm-membership-tier-page">
	<header class="support-site-header" aria-label="Primary navigation">
		<a class="support-brand" href="<?php echo esc_url($membership_home_url); ?>" aria-label="JM Training home">
			<img class="support-brand-logo" src="<?php echo esc_url($logo_uri); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>Membership program</small>
			</span>
		</a>
		<?php get_template_part('template-parts/jm-site-nav'); ?>
		<a class="support-header-cta" href="<?php echo esc_url($tier['cta_href']); ?>">
			<?php echo esc_html($tier['cta_label']); ?>
		</a>
	</header>

	<main class="membership-tier-main">
		<section class="membership-tier-hero" aria-labelledby="membership-tier-title">
			<div class="membership-tier-hero-inner">
				<div class="membership-tier-copy">
					<p class="support-eyebrow"><?php echo esc_html($tier['eyebrow']); ?></p>
					<h1 id="membership-tier-title"><?php echo esc_html($tier['title']); ?></h1>
					<?php if (! empty($tier['intro'])) : ?>
						<p><?php echo esc_html($tier['intro']); ?></p>
					<?php endif; ?>
					<div class="membership-tier-actions">
						<a class="support-button" href="<?php echo esc_url($tier['cta_href']); ?>">
							<?php echo esc_html($tier['cta_label']); ?>
						</a>
						<a class="support-button support-button-secondary" href="<?php echo esc_url($tier['overview_href']); ?>">
							Compare Memberships
						</a>
					</div>
				</div>

				<aside class="membership-price-panel" aria-label="<?php echo esc_attr($tier['title']); ?> pricing summary">
					<?php if (! empty($tier['badge'])) : ?>
						<span class="membership-tier-badge"><?php echo esc_html($tier['badge']); ?></span>
					<?php endif; ?>
					<?php if (! empty($tier['label'])) : ?>
						<p class="support-eyebrow"><?php echo esc_html($tier['label']); ?></p>
					<?php endif; ?>
					<?php if (! empty($tier['price'])) : ?>
						<strong><?php echo esc_html($tier['price']); ?></strong>
						<span><?php echo esc_html($tier['price_suffix']); ?></span>
					<?php endif; ?>
					<?php if (! empty($tier['proof_points'])) : ?>
						<ul>
							<?php foreach ($tier['proof_points'] as $proof_point) : ?>
								<li><?php echo esc_html($proof_point); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</aside>
			</div>
		</section>

		<?php if (! empty($tier['feature_media'])) : ?>
			<?php
			$feature_media = wp_parse_args(
				$tier['feature_media'],
				[
					'image' => '',
					'alt' => '',
					'caption' => '',
					'width' => '',
					'height' => '',
				]
			);
			?>
			<?php if (! empty($feature_media['image'])) : ?>
				<section class="membership-tier-feature-media" aria-label="Membership training photo">
					<div class="membership-tier-feature-media-inner">
						<?php if (! empty($tier['feature_media_heading']) || ! empty($tier['feature_media_intro'])) : ?>
							<div class="membership-section-heading">
								<p class="support-eyebrow">Training environment</p>
								<?php if (! empty($tier['feature_media_heading'])) : ?>
									<h2><?php echo esc_html($tier['feature_media_heading']); ?></h2>
								<?php endif; ?>
								<?php if (! empty($tier['feature_media_intro'])) : ?>
									<p><?php echo esc_html($tier['feature_media_intro']); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<figure class="membership-training-photo membership-feature-photo">
							<img
								src="<?php echo esc_url($image_base_uri . '/' . ltrim($feature_media['image'], '/')); ?>"
								alt="<?php echo esc_attr($feature_media['alt']); ?>"
								<?php if (! empty($feature_media['width'])) : ?>
									width="<?php echo esc_attr($feature_media['width']); ?>"
								<?php endif; ?>
								<?php if (! empty($feature_media['height'])) : ?>
									height="<?php echo esc_attr($feature_media['height']); ?>"
								<?php endif; ?>
								loading="eager"
								decoding="async"
							>
							<?php if (! empty($feature_media['caption'])) : ?>
								<figcaption><?php echo esc_html($feature_media['caption']); ?></figcaption>
							<?php endif; ?>
						</figure>
					</div>
				</section>
			<?php endif; ?>
		<?php endif; ?>

		<section class="membership-tier-section" aria-labelledby="membership-benefits-title">
			<div class="membership-tier-section-inner">
				<div class="membership-section-heading">
					<p class="support-eyebrow">Membership details</p>
					<h2 id="membership-benefits-title"><?php echo esc_html($tier['benefits_heading']); ?></h2>
				</div>
				<?php if (! empty($tier['benefits'])) : ?>
					<div class="membership-benefit-grid">
						<?php foreach ($tier['benefits'] as $benefit) : ?>
							<article>
								<h3><?php echo esc_html($benefit['title'] ?? 'Benefit'); ?></h3>
								<p><?php echo esc_html($benefit['text'] ?? ''); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<?php if (! empty($tier['sections'])) : ?>
			<section class="membership-tier-section membership-tier-breakdown" aria-label="Membership breakdown">
				<div class="membership-tier-section-inner">
					<?php foreach ($tier['sections'] as $index => $section) : ?>
						<?php
						$section_media = [];

						if (! empty($section['media'])) {
							$section_media = wp_parse_args(
								$section['media'],
								[
									'image' => '',
									'alt' => '',
									'caption' => '',
									'width' => '',
									'height' => '',
									'position' => 'center center',
								]
							);
						}
						?>
						<article class="membership-detail-panel<?php echo ! empty($section_media['image']) ? ' has-media' : ''; ?><?php echo 1 === $index % 2 ? ' is-reversed' : ''; ?>">
							<div class="membership-detail-copy">
								<p class="support-eyebrow"><?php echo esc_html($section['eyebrow'] ?? 'Program detail'); ?></p>
								<h2><?php echo esc_html($section['title'] ?? 'Membership Detail'); ?></h2>
								<?php if (! empty($section['text'])) : ?>
									<p><?php echo esc_html($section['text']); ?></p>
								<?php endif; ?>
								<?php if (! empty($section['items'])) : ?>
									<ul>
										<?php foreach ($section['items'] as $item) : ?>
											<li><?php echo esc_html($item); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
							<?php if (! empty($section_media['image'])) : ?>
								<figure class="membership-training-photo membership-section-photo">
									<img
										src="<?php echo esc_url($image_base_uri . '/' . ltrim($section_media['image'], '/')); ?>"
										alt="<?php echo esc_attr($section_media['alt']); ?>"
										style="object-position: <?php echo esc_attr($section_media['position']); ?>;"
										<?php if (! empty($section_media['width'])) : ?>
											width="<?php echo esc_attr($section_media['width']); ?>"
										<?php endif; ?>
										<?php if (! empty($section_media['height'])) : ?>
											height="<?php echo esc_attr($section_media['height']); ?>"
										<?php endif; ?>
										loading="lazy"
										decoding="async"
									>
									<?php if (! empty($section_media['caption'])) : ?>
										<figcaption><?php echo esc_html($section_media['caption']); ?></figcaption>
									<?php endif; ?>
								</figure>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if (! empty($tier['media'])) : ?>
			<section class="membership-tier-media" aria-label="Membership training photos">
				<div class="membership-tier-media-inner">
					<?php if (! empty($tier['media_heading']) || ! empty($tier['media_intro'])) : ?>
						<div class="membership-section-heading">
							<p class="support-eyebrow">Training environment</p>
							<?php if (! empty($tier['media_heading'])) : ?>
								<h2><?php echo esc_html($tier['media_heading']); ?></h2>
							<?php endif; ?>
							<?php if (! empty($tier['media_intro'])) : ?>
								<p><?php echo esc_html($tier['media_intro']); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="membership-tier-media-grid">
						<?php foreach ($tier['media'] as $index => $media_item) : ?>
							<?php
							$media_item = wp_parse_args(
								$media_item,
								[
									'image' => '',
									'alt' => '',
									'caption' => '',
									'width' => '',
									'height' => '',
								]
							);

							if (empty($media_item['image'])) {
								continue;
							}
							?>
							<figure class="membership-training-photo<?php echo 0 === $index ? ' is-featured' : ''; ?>">
								<img
									src="<?php echo esc_url($image_base_uri . '/' . ltrim($media_item['image'], '/')); ?>"
									alt="<?php echo esc_attr($media_item['alt']); ?>"
									<?php if (! empty($media_item['width'])) : ?>
										width="<?php echo esc_attr($media_item['width']); ?>"
									<?php endif; ?>
									<?php if (! empty($media_item['height'])) : ?>
										height="<?php echo esc_attr($media_item['height']); ?>"
									<?php endif; ?>
									loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
									decoding="async"
								>
								<?php if (! empty($media_item['caption'])) : ?>
									<figcaption><?php echo esc_html($media_item['caption']); ?></figcaption>
								<?php endif; ?>
							</figure>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section class="membership-final-cta" aria-labelledby="membership-final-title">
			<div>
				<p class="support-eyebrow">Next step</p>
				<h2 id="membership-final-title"><?php echo esc_html($tier['final_heading']); ?></h2>
				<p><?php echo esc_html($tier['final_text']); ?></p>
			</div>
			<a class="support-button" href="<?php echo esc_url($tier['cta_href']); ?>">
				<?php echo esc_html($tier['cta_label']); ?>
			</a>
		</section>
	</main>
</div>
