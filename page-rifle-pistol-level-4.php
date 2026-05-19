<?php
/**
 * Template Name: Rifle / Pistol Level 4 - Integration and Small-Team Foundations
 * Template Post Type: page
 */

$rifle_pistol_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_pistol_course_stylesheet) ? filemtime($rifle_pistol_course_stylesheet) : null
);

$jm_rifle_pistol_course = [
	'course_family' => 'rifle-pistol',
	'level' => 'Rifle / Pistol Level 4',
	'title' => 'Rifle / Pistol Level 4 — Integration and Small-Team Foundations',
	'label' => 'Integration and Team Foundations',
	'eyebrow' => 'Rifle / Pistol Level 4',
	'hero_image' => 'rifle-pistol-level-4-overview.jpg',
	'hero_image_width' => '6016',
	'hero_image_height' => '4016',
	'hero_placeholder' => '',
	'show_overview_media' => false,
	'intro' => 'A selective combined-systems course that introduces rifle and pistol transition logic, movement, communication, and small-team problem-solving under structured standards.',
	'cta_href' => 'https://api.cavucrm.com/widget/form/gJBjLouVXzI3MZWperI0',
	'overview_href' => home_url('/rifle-pistol-training-overview/'),
	'detail' => [
		'Rifle / Pistol Level 4 is where students begin working both platforms inside the same problem. The emphasis is not speed for its own sake. Students learn to think through when each tool is appropriate, how to manage transitions safely, and how to keep accountability as tempo increases.',
		'Training expands into movement, communication, use of cover, position changes, and specialty events that require students to solve problems while maintaining muzzle discipline, target identification, and awareness of other people in the environment.',
		'The small-team component is introduced as a disciplined decision-making layer. Students are expected to communicate clearly, move with control, and preserve safety standards while the training problem becomes more coordinated and less isolated.',
	],
	'outcomes' => [
		[
			'title' => 'Transition Logic',
			'text' => 'Develop a structured understanding of rifle and pistol roles, transition timing, and accountable platform management.',
		],
		[
			'title' => 'Movement and Communication',
			'text' => 'Apply movement, communication, and use of cover while preserving safety, awareness, and shot accountability.',
		],
		[
			'title' => 'Small-Team Problem-Solving',
			'text' => 'Begin working coordinated problems that require discipline, restraint, positioning, and clear decision-making.',
		],
	],
	'prerequisites' => [
		'Completion of the relevant pistol and rifle progression levels, or instructor-approved equivalent experience, is expected.',
		'Students must demonstrate safe rifle and pistol handling, reliable manipulation, and accountable marksmanship before attending.',
		'Instructor approval may be required when prior training history is unclear or when the student has not completed the JM Training progression.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Transition Logic, Movement, and Position',
			'text' => 'Alpha establishes the safety framework for combined rifle and pistol work, transition logic, movement, cover use, positional problem-solving, and communication expectations.',
			'qualification' => 'Students must demonstrate safe management of both platforms, controlled transitions, and instructor-observed readiness before moving into Bravo coordinated problems.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Communication and Small-Team Foundations',
			'text' => 'Bravo introduces higher-tempo communication, specialty events, coordinated movement, and small-team decision-making in a supervised training environment.',
			'qualification' => 'Students must preserve muzzle discipline, communicate clearly, use cover and position responsibly, and meet Level 4 standards for accountability under pressure.',
		],
	],
	'section_media' => [
		'after_hero' => [
			'image' => 'rifle-pistol-level-4-communication.png',
			'image_width' => '1094',
			'image_height' => '642',
			'image_alt' => 'Instructor coaching students through rifle and pistol integration during indoor movement training.',
			'class' => 'is-rifle-pistol-communication',
		],
		'before_blocks' => [
			'image' => 'rifle-pistol-level-4-low-light.png',
			'image_width' => '1094',
			'image_height' => '814',
			'image_alt' => 'Student working a low-light rifle and pistol problem around cover on the range.',
			'class' => 'is-rifle-pistol-low-light',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_pistol_course]);
get_footer();
