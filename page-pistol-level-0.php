<?php
/**
 * Template Name: Pistol Level 0 - Foundation
 * Template Post Type: page
 */

$pistol_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($pistol_course_stylesheet) ? filemtime($pistol_course_stylesheet) : null
);

$jm_pistol_course = [
	'course_family' => 'pistol',
	'level' => 'Pistol Level 0',
	'title' => 'Level 0 — Foundation',
	'label' => 'Foundation',
	'eyebrow' => 'Pistol Level 0',
	'image' => 'pistol-training-overview-level-0.png',
	'image_width' => '2944',
	'image_height' => '1680',
	'image_alt' => 'JM Training pistol student receiving Level 0 handgun instruction',
	'intro' => 'A disciplined introduction to responsible handgun ownership, safe handling, basic marksmanship, and the first steps toward accountable defensive skill.',
	'cta_href' => home_url('/pistol-level-0/'),
	'overview_href' => home_url('/pistol-training-overview/'),
	'detail' => [
		'Level 0 is the foundation of the pistol training path. This course introduces handgun safety, basic handgun nomenclature, how a handgun works, safe handling, storage and daily responsibility, proper grip, stance, basic marksmanship, and an introductory holster draw.',
		'The course is intentionally beginner-accessible. Students are not rushed into speed or complexity. The priority is understanding how to live with a handgun safely, handle it responsibly, and begin building the skill to draw and fire without endangering themselves or innocent people.',
		'By the end of the day, students should have a clear picture of what safe ownership requires, what accountable handling looks like, and what standards they must continue developing before advancing deeper into the pistol progression.',
	],
	'outcomes' => [
		[
			'title' => 'Safe Ownership',
			'text' => 'Understand the responsibilities attached to storage, transport, handling, range conduct, and daily decision-making around a handgun.',
		],
		[
			'title' => 'Handgun Familiarity',
			'text' => 'Build working familiarity with core handgun parts, safe loading and unloading concepts, and administrative handling expectations.',
		],
		[
			'title' => 'Foundational Marksmanship',
			'text' => 'Establish a beginner-level foundation for grip, stance, sight use, trigger control, and accountable shot placement.',
		],
	],
	'prerequisites' => [
		'No prior pistol course is required.',
		'Students must be legally eligible to possess and handle a handgun.',
		'Students must be able to follow instructor direction and maintain strict safety discipline for the full course day.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Safety, Responsibility, and Handgun Foundations',
			'text' => 'Alpha builds the classroom and administrative foundation: safety rules, major handgun components, how the handgun operates at a basic level, storage responsibility, daily ownership considerations, and safe handling expectations before live-fire work.',
			'qualification' => 'Students must demonstrate safe administrative handling, explain the core safety expectations, and show instructor-observed readiness before moving into the Bravo live-fire block.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Range Foundation and Introductory Holster Work',
			'text' => 'Bravo applies the foundation on the range through controlled handling, grip, stance, sight management, trigger control, basic marksmanship, and a supervised introduction to the holster draw.',
			'qualification' => 'Students must maintain muzzle and trigger discipline, follow range commands, and show safe beginner-level handling before receiving Level 0 completion credit.',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_pistol_course]);
get_footer();
