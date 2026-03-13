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
 * Russian language strings for filter_sborniktestov.
 *
 * @package    filter_sborniktestov
 * @copyright  2026 Sbornik Testov <info@sborniktestov.ru>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['filtername'] = 'Сборник Тестов — встраивание тестов';
$string['pluginname'] = 'Сборник Тестов — встраивание тестов';

// Iframe.
$string['iframetitle'] = 'Тест #{$a} — Сборник Тестов';

// Credit.
$string['sitename'] = 'Сборник Тестов';
$string['credittext'] = 'Тест создан на {$a}';

// Settings: display.
$string['settings_display'] = 'Настройки отображения по умолчанию';
$string['settings_display_desc'] = 'Эти значения используются, если не переопределены в теге встраивания.';
$string['settings_header'] = 'Показывать заголовок теста';
$string['settings_header_desc'] = 'Отображать заголовок теста внутри встраиваемого блока.';
$string['settings_desc'] = 'Показывать описание теста';
$string['settings_desc_desc'] = 'Отображать описание теста внутри встраиваемого блока.';
$string['settings_stats'] = 'Показывать статистику';
$string['settings_stats_desc'] = 'Отображать количество просмотров и прохождений.';
$string['settings_comments'] = 'Показывать комментарии';
$string['settings_comments_desc'] = 'Отображать раздел комментариев под тестом.';
$string['settings_related'] = 'Показывать похожие тесты';
$string['settings_related_desc'] = 'Отображать сетку похожих тестов после результата.';
$string['settings_minheight'] = 'Минимальная высота (px)';
$string['settings_minheight_desc'] = 'Минимальная высота iframe в пикселях. Не менее 200.';
$string['settings_maxwidth'] = 'Максимальная ширина контента (px)';
$string['settings_maxwidth_desc'] = 'Максимальная ширина контента внутри блока в пикселях.';

// Settings: behaviour.
$string['settings_behaviour'] = 'Поведение';
$string['settings_autoembed'] = 'Автоматическое встраивание ссылок';
$string['settings_autoembed_desc'] = 'Автоматически заменять ссылки на sborniktestov.ru/quiz/NNN на встроенный тест.';

// Settings: branding.
$string['settings_branding'] = 'Брендинг';
$string['settings_showcredit'] = 'Показывать ссылку на источник';
$string['settings_showcredit_desc'] = 'Отображать ссылку «Тест создан на Сборник Тестов» под блоком.';

// Privacy API.
$string['privacy:metadata:ipaddress'] = 'IP-адрес пользователя передаётся на sborniktestov.ru в составе стандартного HTTP-запроса при загрузке теста.';
$string['privacy:metadata:useragent'] = 'Строка User Agent браузера передаётся на sborniktestov.ru в составе стандартного HTTP-запроса.';
$string['privacy:metadata:visitorid'] = 'Анонимный идентификатор посетителя, хранящийся в cookie. Не содержит персональных данных и используется только для запоминания результатов тестов.';
$string['privacy:metadata:externalpurpose'] = 'Содержимое теста загружается с sborniktestov.ru через iframe. Внешний сервис получает стандартные данные HTTP-запроса (IP-адрес, user agent) и может устанавливать анонимный cookie для отслеживания прохождения теста. Данные пользователей Moodle не передаются. Политика конфиденциальности: https://sborniktestov.ru/privacy.html';
