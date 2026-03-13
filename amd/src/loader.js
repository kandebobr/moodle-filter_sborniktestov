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
 * Iframe auto-resize listener for Sbornik Testov quiz embeds.
 *
 * Listens for postMessage events from the embedded quiz iframes and
 * adjusts each iframe height accordingly. The message protocol uses
 * type 'sborniktestov-resize' with a numeric 'height' property.
 *
 * @module     filter_sborniktestov/loader
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function() {

    /** @var {boolean} Whether the listener has been initialised. */
    var initialised = false;

    return {
        /**
         * Initialise the postMessage listener.
         *
         * Safe to call multiple times — only one listener is attached.
         */
        init: function() {
            if (initialised) {
                return;
            }
            initialised = true;

            window.addEventListener('message', function(e) {
                if (!e.data || e.data.type !== 'sborniktestov-resize') {
                    return;
                }

                var height = parseInt(e.data.height, 10);
                if (isNaN(height) || height <= 0) {
                    return;
                }

                // Find matching iframe by source window.
                var iframes = document.querySelectorAll('.filter-sborniktestov-embed iframe');
                var matched = false;

                for (var i = 0; i < iframes.length; i++) {
                    try {
                        if (iframes[i].contentWindow === e.source) {
                            iframes[i].style.height = (height + 16) + 'px';
                            matched = true;
                            break;
                        }
                    } catch (ex) {
                        // Cross-origin — cannot compare contentWindow.
                    }
                }

                // Fallback: update all plugin iframes when cross-origin check fails.
                if (!matched) {
                    for (var j = 0; j < iframes.length; j++) {
                        iframes[j].style.height = (height + 16) + 'px';
                    }
                }
            });
        }
    };
});
