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
 * Sbornik Testov quiz embed filter.
 *
 * Replaces {sborniktestov id=NNN} tags with an iframe embed of the
 * corresponding quiz from sborniktestov.ru. Optionally auto-embeds
 * direct links to quiz pages.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Filter class for embedding Sbornik Testov quizzes.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_sborniktestov extends moodle_text_filter {

    /** @var string Base URL for the embed endpoint. */
    private const EMBED_BASE = 'https://sborniktestov.ru/embed/';

    /** @var string Base URL for the main site. */
    private const SITE_URL = 'https://sborniktestov.ru';

    /**
     * Apply the filter to the text.
     *
     * @param string $text    The text to filter.
     * @param array  $options Filter options.
     * @return string The filtered text.
     */
    public function filter($text, array $options = []) {
        // Quick bail-out: no point processing if the marker is not present.
        if (stripos($text, '{sborniktestov') === false
            && stripos($text, 'sborniktestov.ru/quiz/') === false) {
            return $text;
        }

        // Replace {sborniktestov id=NNN ...} tags.
        $text = preg_replace_callback(
            '/\{sborniktestov\s+([^}]+)\}/i',
            [$this, 'replace_tag'],
            $text
        );

        // Optionally auto-embed links to quiz pages.
        $autoembed = get_config('filter_sborniktestov', 'autoembed');
        if (!empty($autoembed)) {
            $text = preg_replace_callback(
                '#<a\s[^>]*href=["\']https?://sborniktestov\.ru/quiz/(\d+)[^"\']*["\'][^>]*>.*?</a>#is',
                [$this, 'replace_link'],
                $text
            );
        }

        return $text;
    }

    /**
     * Callback for {sborniktestov ...} tag replacement.
     *
     * @param array $matches Regex matches.
     * @return string The replacement HTML.
     */
    private function replace_tag(array $matches): string {
        $params = $this->parse_tag_params($matches[1]);

        $quizid = isset($params['id']) ? (int) $params['id'] : 0;
        if ($quizid < 1) {
            return $matches[0]; // Return original tag if no valid ID.
        }

        return $this->build_embed($quizid, $params);
    }

    /**
     * Callback for auto-embedding quiz links.
     *
     * @param array $matches Regex matches.
     * @return string The replacement HTML.
     */
    private function replace_link(array $matches): string {
        $quizid = (int) $matches[1];
        if ($quizid < 1) {
            return $matches[0];
        }

        return $this->build_embed($quizid, []);
    }

    /**
     * Parse key=value parameters from the tag body.
     *
     * Supports both key=value and key="value" syntax.
     *
     * @param string $raw The raw parameter string.
     * @return array Associative array of parameters.
     */
    private function parse_tag_params(string $raw): array {
        $params = [];
        // Match key=value or key="value" or key='value'.
        if (preg_match_all('/(\w+)\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|(\S+))/', $raw, $m, PREG_SET_ORDER)) {
            foreach ($m as $match) {
                $key = strtolower($match[1]);
                $val = $match[2] !== '' ? $match[2] : ($match[3] !== '' ? $match[3] : $match[4]);
                $params[$key] = $val;
            }
        }
        return $params;
    }

    /**
     * Build the iframe embed HTML for a quiz.
     *
     * @param int   $quizid Quiz ID on sborniktestov.ru.
     * @param array $params Optional display parameters from the tag.
     * @return string The embed HTML.
     */
    private function build_embed(int $quizid, array $params): string {
        global $PAGE;

        // Merge tag parameters with global defaults.
        $defaults = $this->get_defaults();
        $config = array_merge($defaults, $params);

        // Build the iframe URL query parameters.
        $urlparams = ['id' => $quizid];

        // Boolean toggles — only send non-default values.
        if (!empty($config['comments']) && $config['comments'] === '1') {
            $urlparams['comments'] = '1';
        }
        if (!empty($config['related']) && $config['related'] === '1') {
            $urlparams['related'] = '1';
        }
        if (isset($config['header']) && $config['header'] === '0') {
            $urlparams['header'] = '0';
        }
        if (isset($config['desc']) && $config['desc'] === '0') {
            $urlparams['desc'] = '0';
        }
        if (isset($config['stats']) && $config['stats'] === '0') {
            $urlparams['stats'] = '0';
        }

        // Style parameters — pass through if set.
        $stylekeys = [
            'color_accent', 'color_bg', 'color_title', 'color_text',
            'color_btn_text', 'color_selected_bg', 'color_progress_bg',
            'color_progress_fill', 'color_border', 'color_border_selected',
            'color_btn_prev', 'color_hover',
            'font_title', 'font_desc', 'font_stats', 'font_question', 'font_answer',
            'radius', 'padding', 'max_width',
        ];

        foreach ($stylekeys as $key) {
            if (!empty($config[$key])) {
                $val = ltrim($config[$key], '#');
                $urlparams[$key] = $val;
            }
        }

        $iframeurl = new moodle_url(self::EMBED_BASE, $urlparams);

        // Sanitize dimensions.
        $minheight = isset($config['min_height']) ? max(200, (int) $config['min_height']) : 400;

        // Unique frame ID.
        $frameid = 'st-embed-' . $quizid . '-' . random_string(6);

        // Load the iframe resize AMD module.
        $PAGE->requires->js_call_amd('filter_sborniktestov/loader', 'init');

        // Build the output HTML.
        $html = html_writer::start_div('filter-sborniktestov-embed', ['data-quiz-id' => $quizid]);

        $iframeattrs = [
            'id'               => $frameid,
            'src'              => $iframeurl->out(false),
            'style'            => 'width:100%;min-height:' . $minheight . 'px;'
                                . 'height:' . $minheight . 'px;border:none;'
                                . 'display:block;overflow:hidden',
            'allowtransparency' => 'true',
            'scrolling'        => 'no',
            'allow'            => 'web-share',
            'loading'          => 'lazy',
            'title'            => get_string('iframetitle', 'filter_sborniktestov', $quizid),
        ];
        $html .= html_writer::tag('iframe', '', $iframeattrs);

        // Optional credit link below the iframe.
        $showcredit = get_config('filter_sborniktestov', 'showcredit');
        if (!empty($showcredit)) {
            $creditlink = html_writer::link(
                self::SITE_URL,
                get_string('sitename', 'filter_sborniktestov'),
                ['target' => '_blank', 'rel' => 'noopener']
            );
            $credittext = get_string('credittext', 'filter_sborniktestov', $creditlink);
            $html .= html_writer::div(
                $credittext,
                'filter-sborniktestov-credit',
                ['style' => 'text-align:center;font-size:12px;color:#999;margin-top:4px']
            );
        }

        $html .= html_writer::end_div();

        return $html;
    }

    /**
     * Retrieve default configuration values.
     *
     * @return array Default parameter values.
     */
    private function get_defaults(): array {
        return [
            'comments'   => get_config('filter_sborniktestov', 'default_comments') ?: '0',
            'related'    => get_config('filter_sborniktestov', 'default_related') ?: '0',
            'header'     => get_config('filter_sborniktestov', 'default_header') ?: '1',
            'desc'       => get_config('filter_sborniktestov', 'default_desc') ?: '1',
            'stats'      => get_config('filter_sborniktestov', 'default_stats') ?: '1',
            'min_height' => get_config('filter_sborniktestov', 'default_min_height') ?: '400',
            'max_width'  => get_config('filter_sborniktestov', 'default_max_width') ?: '800',
        ];
    }
}
