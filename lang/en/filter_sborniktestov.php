<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * English language strings for filter_sborniktestov.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['filtername'] = 'Sbornik Testov quiz embed';
$string['pluginname'] = 'Sbornik Testov quiz embed';

// Iframe.
$string['iframetitle'] = 'Quiz #{$a} — Sbornik Testov';

// Credit.
$string['sitename'] = 'Sbornik Testov';
$string['credittext'] = 'Quiz powered by {$a}';

// Settings: display.
$string['settings_display'] = 'Default display options';
$string['settings_display_desc'] = 'These values are used when not overridden in the embed tag.';
$string['settings_header'] = 'Show quiz title';
$string['settings_header_desc'] = 'Display the quiz title inside the embed.';
$string['settings_desc'] = 'Show quiz description';
$string['settings_desc_desc'] = 'Display the quiz description inside the embed.';
$string['settings_stats'] = 'Show statistics';
$string['settings_stats_desc'] = 'Display view count and completion count.';
$string['settings_comments'] = 'Show comments';
$string['settings_comments_desc'] = 'Display the comments section below the quiz.';
$string['settings_related'] = 'Show related quizzes';
$string['settings_related_desc'] = 'Display a grid of related quizzes after the result.';
$string['settings_minheight'] = 'Minimum height (px)';
$string['settings_minheight_desc'] = 'Minimum iframe height in pixels. Must be at least 200.';
$string['settings_maxwidth'] = 'Maximum content width (px)';
$string['settings_maxwidth_desc'] = 'Maximum content width inside the embed in pixels.';

// Settings: behaviour.
$string['settings_behaviour'] = 'Behaviour';
$string['settings_autoembed'] = 'Auto-embed quiz links';
$string['settings_autoembed_desc'] = 'Automatically replace links to sborniktestov.ru/quiz/NNN with an embedded quiz.';

// Settings: branding.
$string['settings_branding'] = 'Branding';
$string['settings_showcredit'] = 'Show credit link';
$string['settings_showcredit_desc'] = 'Display a "Quiz powered by Sbornik Testov" link below the embed.';

// Privacy API.
$string['privacy:metadata:ipaddress'] = 'The IP address of the user is sent to sborniktestov.ru as part of the standard HTTP request when loading the quiz embed.';
$string['privacy:metadata:useragent'] = 'The browser user agent string is sent to sborniktestov.ru as part of the standard HTTP request.';
$string['privacy:metadata:visitorid'] = 'A randomly generated anonymous visitor identifier stored in a cookie. It does not contain any personal information and is used only to remember quiz results.';
$string['privacy:metadata:externalpurpose'] = 'The quiz content is loaded from sborniktestov.ru via an iframe. The external service receives standard HTTP request data (IP address, user agent) and may set an anonymous visitor cookie to track quiz completion. No Moodle user data is transmitted. See the Sbornik Testov privacy policy at https://sborniktestov.ru/privacy-en.html';
