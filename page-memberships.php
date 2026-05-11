<?php
/**
 * Template Name: JM Memberships Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Memberships',
	'title' => 'Membership Overview / Signup',
	'intro' => 'Placeholder framework for membership overview, qualification path, benefits, and signup flow.',
	'cta_label' => 'Start Membership Signup',
	'cta_href' => '#ghl-membership-signup',
	'cards' => [
		[
			'title' => 'Membership Overview',
			'text' => 'Placeholder for membership tiers, benefits, schedule access, and standards.',
		],
		[
			'title' => 'Signup CTAs',
			'text' => 'Go High Level forms and payment links will be connected to the signup buttons later.',
		],
	],
	'notes' => [
		'Replace #ghl-membership-signup with the final Go High Level membership form or payment flow.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
