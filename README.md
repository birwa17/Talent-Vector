# Talent Vector

Talent Vector is a resume-building platform's marketing/landing website. This repository contains the homepage (`index.html`) and its supporting assets.

## Overview

The homepage introduces Talent Vector's three core services:

1. **Resume Generation** – Users upload an existing resume or have one generated with AI assistance based on provided information.
2. **Question Generation** – After a resume is analyzed, tailored quiz questions are generated to assess the user's skills and knowledge.
3. **Resume Screening System** – A screening mechanism for employers/recruiters to evaluate and filter candidate resumes.

## Page Sections

`index.html` is a single-page layout composed of the following sections:

| Section | ID / Class | Purpose |
|---|---|---|
| Header / Nav | `header`, `.navbar`, `.side-menu` | Logo, top navigation, dropdowns (Resume, Services), login/logout, and a mobile hamburger side menu |
| Hero | `.index` (`#Home`) | Headline, intro copy, and primary "Create my Resume" CTA |
| How It Works | `.func` (`#how-it-works`) | Explains the three core services |
| What We Provide | `.provide` (`#what-we-provide`) | Feature cards linking to each service |
| Resume Results | `.result` (`#resume-results`) | 3-step process (choose template → add content → finish) |
| Professional Templates | `.protemp` (`#pro-temp`) | Showcase of Creative / Simple / Modern resume templates |
| Why Choose Us | `.wchooseus` (`#why-choose-us`) | Value props: designs, ATS-friendliness, support, unlimited resumes |
| Find Inspiration | `.findinspiration` (`#find-inspiration`) | Example resumes by role (Teacher, College, Nurse) |
| FAQ | `.faq-section` | Common questions plus a question-submission form (`submit_faq.php`) |
| Resume CTA Banner | `.resume-section` | Secondary call-to-action |
| Mission | `.mission-section` | Mission statement and CTA |
| Footer / Info | `.infosec` (`#info-sec`) | Sitemap-style links, support links, and contact details |

## Navigation & Linked Pages

The page links out to several other pages that are **not included** in this file and are expected elsewhere in the project:

- `resume_templates.php`
- `website_func.html`
- `how_to_make_resume.html`
- `quiz_question.php`
- `resume_screening.php`
- `contact.php`
- `faq.php`
- `login.php` / `logout.php`
- `submit_faq.php` (FAQ submission form handler)

## Dependencies

Loaded via CDN — no local install required:

- [Swiper 10](https://swiperjs.com/) – `swiper-bundle.min.css` / `.min.js` (carousel/slider support)
- [Font Awesome 5.15.3](https://fontawesome.com/) – icons (e.g., the "scroll to top" rocket button)
- [Chart.js](https://www.chartjs.org/) – charting library

## Local Assets Expected

The page references a local stylesheet and images that should sit alongside `index.html`:

```
index.css
pics/
  logotrans.png
  hpresume.png
  resume.png
  questionmark.png
  screening.png
  STEP 1.png
  STEP 2.png
  STEP 3.png
  11.png, 12.png, 13.png
  18.png, 19.png, 20.png, 21.png
  2.png, 15.png, 8.png
  nextlevel.png
```

## Inline JavaScript Behavior

Defined at the bottom of `index.html`:

- **Scroll-to-top button** – appears after scrolling 300px down and smoothly scrolls back to top on click.
- **Hamburger menu toggle** – opens/closes the mobile `.side-menu`.
- **Auto-close side menu** – clicking any `.side-link` closes the open side menu.

## Suggested Project Structure

```
project-root/
├── index.html
├── index.css
├── pics/
│   └── ... (images listed above)
├── resume_templates.php
├── website_func.html
├── how_to_make_resume.html
├── quiz_question.php
├── resume_screening.php
├── contact.php
├── faq.php
├── login.php
├── logout.php
└── submit_faq.php
```

## Notes

- Contact emails and phone numbers are hardcoded in the footer (`.customer-service`); consider moving these to a config file or CMS if they change often.
- `submit_faq.php` and other `.php` pages imply a PHP backend — ensure a PHP-capable server (e.g., Apache/Nginx with PHP-FPM) is used to run the full site, not just a static file server.
- `index.css` is referenced but not included in this file — pair it with `index.html` for correct styling.
