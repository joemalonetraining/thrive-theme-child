<?php
/**
 * Template Name: JM Blog Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Blog',
	'title' => 'Blog Index',
	'intro' => 'Placeholder framework for the JM Training blog index page.',
	'cta_label' => 'View Training Updates',
	'cta_href' => '#blog-index-placeholder',
	'cards' => [
		[
			'title' => 'Article Index',
			'text' => 'Placeholder for category structure, featured posts, and recent articles.',
		],
		[
			'title' => 'SEO Framework',
			'text' => 'Placeholder for internal linking, educational topics, and local search support.',
		],
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
