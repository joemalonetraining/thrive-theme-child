# Codex Rules for This Child Theme

This repository is the WordPress Thrive Theme Builder child theme source of truth.

## Hard Boundaries

- Do not modify the Thrive parent theme.
- Do not overwrite `functions.php`.
- Do not modify `functions.php` unless explicitly approved for a specific task.
- Do not create standalone production HTML documents.
- WordPress production pages must use page templates with `get_header();` and `get_footer();`.
- Do not add `<!doctype>`, `<html>`, `<head>`, or `<body>` tags inside WordPress templates.
- Do not change the live landing page body, hero, CTA structure, layout, images, or styling unless explicitly requested.
- Do not modify `page-landing-test.php` or `assets/css/landing-test.css` unless the task explicitly allows it.

## Allowed Framework Work

- Support page templates may be added as `page-*.php` files.
- Support-only template parts may be added under `template-parts/`.
- Support-only CSS may be added under `assets/css/`.
- Go High Level signup/payment placeholders should use these anchors until final links are provided:
  - `#ghl-membership-signup`
  - `#ghl-ilccl-signup`
  - `#ghl-course-signup`

## Deployment Notes

- Keep generated files inside the child theme only.
- Preserve existing hooks and enqueue logic.
- If a new stylesheet must be loaded through WordPress, request explicit approval before editing `functions.php`.
