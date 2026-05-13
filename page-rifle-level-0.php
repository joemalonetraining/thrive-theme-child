<?php
/**
 * Template Name: Rifle Level 0 - Rifle Foundation
 * Template Post Type: page
 */

$rifle_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_course_stylesheet) ? filemtime($rifle_course_stylesheet) : null
);

$jm_rifle_course = [
	'course_family' => 'rifle',
	'level' => 'Rifle Level 0',
	'title' => 'Level 0 — Rifle Foundation',
	'label' => 'Foundation',
	'eyebrow' => 'Rifle Level 0',
	'image' => 'rifle-training-overview-level-0.png',
	'image_width' => '2008',
	'image_height' => '1604',
	'image_alt' => 'JM Training rifle student receiving Level 0 rifle foundation instruction',
	'intro' => 'A disciplined introduction to safe rifle ownership, administrative handling, marksmanship fundamentals, and responsible platform management.',
	'cta_href' => home_url('/rifle-level-0/'),
	'overview_href' => home_url('/rifle-training-overview/'),
	'detail' => [
		'Rifle Level 0 establishes the foundation for responsible rifle ownership and controlled platform handling. Students are introduced to rifle safety, nomenclature, loading and unloading, storage responsibility, sighting concepts, supported and unsupported positions, and deliberate marksmanship.',
		'The course is structured for students who need a serious, beginner-accessible entry point. The focus is control, accountability, and understanding the platform before adding movement, speed, or complex decisions.',
		'By the end of the day, students should understand how to handle the rifle safely, operate it under instructor supervision, and identify the standards they must continue developing before advancing.',
	],
	'outcomes' => [
		[
			'title' => 'Safe Rifle Handling',
			'text' => 'Build disciplined muzzle awareness, trigger discipline, loading and unloading habits, and range conduct around the rifle platform.',
		],
		[
			'title' => 'Platform Familiarity',
			'text' => 'Develop working knowledge of rifle components, controls, sighting systems, storage responsibility, and administrative handling.',
		],
		[
			'title' => 'Foundational Marksmanship',
			'text' => 'Establish deliberate position, sight alignment, trigger control, follow-through, and accountable shot placement.',
		],
	],
	'prerequisites' => [
		'No prior rifle course is required.',
		'Students must be legally eligible to possess and handle a rifle.',
		'Students must be able to follow instructor direction and maintain safety discipline for the full course day.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Safety, Nomenclature, and Administrative Handling',
			'text' => 'Alpha builds the safety framework for rifle ownership, platform orientation, loading and unloading, sling awareness, storage responsibility, and controlled administrative handling.',
			'qualification' => 'Students must demonstrate safe administrative handling, understand the course safety expectations, and show instructor-observed readiness before moving into Bravo live-fire work.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Marksmanship Foundation and Controlled Operation',
			'text' => 'Bravo applies the foundation on the range through position work, sighting concepts, trigger control, follow-through, and deliberate accuracy standards.',
			'qualification' => 'Students must maintain safe muzzle and trigger discipline, follow range commands, and demonstrate controlled beginner-level rifle handling before receiving Level 0 completion credit.',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_course]);
get_footer();
