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
 * Settings for filter_sborniktestov.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    // Header: display defaults.
    $settings->add(new admin_setting_heading(
        'filter_sborniktestov/displayheading',
        get_string('settings_display', 'filter_sborniktestov'),
        get_string('settings_display_desc', 'filter_sborniktestov')
    ));

    // Show quiz title.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/default_header',
        get_string('settings_header', 'filter_sborniktestov'),
        get_string('settings_header_desc', 'filter_sborniktestov'),
        '1'
    ));

    // Show quiz description.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/default_desc',
        get_string('settings_desc', 'filter_sborniktestov'),
        get_string('settings_desc_desc', 'filter_sborniktestov'),
        '1'
    ));

    // Show statistics.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/default_stats',
        get_string('settings_stats', 'filter_sborniktestov'),
        get_string('settings_stats_desc', 'filter_sborniktestov'),
        '1'
    ));

    // Show comments.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/default_comments',
        get_string('settings_comments', 'filter_sborniktestov'),
        get_string('settings_comments_desc', 'filter_sborniktestov'),
        '0'
    ));

    // Show related quizzes.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/default_related',
        get_string('settings_related', 'filter_sborniktestov'),
        get_string('settings_related_desc', 'filter_sborniktestov'),
        '0'
    ));

    // Minimum height.
    $settings->add(new admin_setting_configtext(
        'filter_sborniktestov/default_min_height',
        get_string('settings_minheight', 'filter_sborniktestov'),
        get_string('settings_minheight_desc', 'filter_sborniktestov'),
        '400',
        PARAM_INT
    ));

    // Maximum content width.
    $settings->add(new admin_setting_configtext(
        'filter_sborniktestov/default_max_width',
        get_string('settings_maxwidth', 'filter_sborniktestov'),
        get_string('settings_maxwidth_desc', 'filter_sborniktestov'),
        '800',
        PARAM_INT
    ));

    // Header: behaviour.
    $settings->add(new admin_setting_heading(
        'filter_sborniktestov/behaviourheading',
        get_string('settings_behaviour', 'filter_sborniktestov'),
        ''
    ));

    // Auto-embed quiz links.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/autoembed',
        get_string('settings_autoembed', 'filter_sborniktestov'),
        get_string('settings_autoembed_desc', 'filter_sborniktestov'),
        '0'
    ));

    // Header: branding.
    $settings->add(new admin_setting_heading(
        'filter_sborniktestov/brandingheading',
        get_string('settings_branding', 'filter_sborniktestov'),
        ''
    ));

    // Show credit link.
    $settings->add(new admin_setting_configcheckbox(
        'filter_sborniktestov/showcredit',
        get_string('settings_showcredit', 'filter_sborniktestov'),
        get_string('settings_showcredit_desc', 'filter_sborniktestov'),
        '0'
    ));
}
