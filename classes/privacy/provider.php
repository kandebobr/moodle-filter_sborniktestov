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
 * Privacy subsystem implementation for filter_sborniktestov.
 *
 * This plugin embeds quizzes from sborniktestov.ru via an iframe.
 * It does not store any personal data within Moodle, but the
 * embedded iframe may transmit visitor data (IP address, cookies,
 * user agent) to the external service.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_sborniktestov\privacy;

use core_privacy\local\metadata\collection;

/**
 * Privacy metadata provider for filter_sborniktestov.
 *
 * The filter itself stores no user data in Moodle. However, the
 * embedded iframe loads content from an external server, which may
 * process visitor data according to its own privacy policy.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider {

    /**
     * Describe the type of data that may be transmitted to the external service.
     *
     * @param collection $collection The collection to add metadata to.
     * @return collection The updated collection.
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_external_location_link(
            'sborniktestov.ru',
            [
                'ipaddress' => 'privacy:metadata:ipaddress',
                'useragent'  => 'privacy:metadata:useragent',
                'visitorid' => 'privacy:metadata:visitorid',
            ],
            'privacy:metadata:externalpurpose'
        );

        return $collection;
    }
}
