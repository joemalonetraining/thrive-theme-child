<?php
/**
 * Template Name: Rifle / Pistol Level 5 - Advanced Tactical Integration
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
	'course_class' => 'jm-rifle-pistol-level-five-course',
	'level' => 'Rifle / Pistol Level 5',
	'title' => 'Rifle / Pistol Level 5 — Advanced Tactical Integration',
	'label' => 'Advanced Integration',
	'eyebrow' => 'Rifle / Pistol Level 5',
	'hero_image' => 'rifle-pistol-level-5-night-ops.png',
	'hero_image_width' => '2528',
	'hero_image_height' => '1688',
	'hero_placeholder' => '',
	'show_overview_media' => false,
	'intro' => 'The most selective JM Training progression level, built around supervised advanced integration, complex scenarios, professional conduct, and disciplined judgment under stress.',
	'cta_href' => home_url('/membership-application/?course=rifle-pistol-level-5'),
	'overview_href' => home_url('/rifle-pistol-training-overview/'),
	'detail' => [
		'Rifle / Pistol Level 5 is reserved for highly capable professionals and deeply committed students who have already demonstrated safe performance, maturity, restraint, and reliable judgment under pressure.',
		'Training may include supervised exposure to advanced scenario elements such as night vision concepts, IR aiming systems, strobes, fog, visual and audio stress effects, simulated explosive effects, breaching concepts, and complex scenario-driven exercises. These elements are framed as controlled training conditions, not technical instruction in hazardous methods.',
		'The purpose of Level 5 is to evaluate communication, decision-making, discipline, and professional conduct in demanding environments. Students are expected to move carefully, communicate clearly, process information, and preserve accountability even when the scenario becomes complex.',
	],
	'outcomes' => [
		[
			'title' => 'Advanced Judgment',
			'text' => 'Apply restraint, communication, and decision discipline in complex scenario-driven training environments.',
		],
		[
			'title' => 'Technical Integration Concepts',
			'text' => 'Work around supervised advanced equipment and environmental stressors without losing safety, accountability, or professional conduct.',
		],
		[
			'title' => 'Scenario Performance',
			'text' => 'Maintain composure, coordination, and standards while processing high-risk training problems under elevated stress.',
		],
	],
	'prerequisites' => [
		'Reserved access only. Instructor approval is required.',
		'Students must have completed the relevant JM Training progression or demonstrate instructor-approved equivalent experience.',
		'Students must show maturity, discipline, professional conduct, and the ability to perform safely under stress before attending.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Advanced Integration Standards and Scenario Preparation',
			'text' => 'Alpha establishes the safety, communication, conduct, and performance expectations for advanced scenario work and supervised integration concepts.',
			'qualification' => 'Students must demonstrate readiness, restraint, safe platform management, and instructor-approved conduct before moving into Bravo scenario work.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Complex Scenarios and Stress-Induced Decision-Making',
			'text' => 'Bravo places students into supervised scenario-driven exercises that may include environmental stress effects, advanced equipment concepts, communication demands, and complex decision pressure.',
			'qualification' => 'Students must preserve safety, judgment, communication, and professional conduct while working through Level 5 scenario standards.',
		],
	],
	'section_media' => [
		'before_blocks' => [
			'image' => 'rifle-pistol-level-5-scenario.jpg',
			'image_width' => '5163',
			'image_height' => '3447',
			'image_alt' => 'Advanced rifle and pistol student evaluating a target array during scenario training.',
			'class' => 'is-rifle-pistol-level-five-scenario',
		],
		'before_final_cta' => [
			'image' => 'rifle-pistol-level-5-coordination.jpg',
			'image_width' => '5925',
			'image_height' => '3955',
			'image_alt' => 'Armed student moving through a complex tactical range with barriers and target positions.',
			'class' => 'is-rifle-pistol-level-five-coordination',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_pistol_course]);
get_footer();
