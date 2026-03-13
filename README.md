# Sbornik Testov — Quiz Embed Filter for Moodle

Embed interactive quizzes from [Sbornik Testov](https://sborniktestov.ru) (Сборник Тестов) into any text area in your Moodle site — course descriptions, pages, assignments, forums, labels and more.

Sbornik Testov is a free quiz platform with over 15,000 quizzes covering education, psychology, pop culture and general knowledge.

## Requirements

- Moodle 4.5 or later.
- No external dependencies or API keys required.

## Installation

1. Download the plugin and extract it to `filter/sborniktestov/` in your Moodle installation.
2. Log in as an administrator and visit **Site administration → Notifications** to complete the installation.
3. Go to **Site administration → Plugins → Filters → Manage filters** and enable the **Sbornik Testov quiz embed** filter.

## Usage

### Basic embed

In any text editor in Moodle, type:

```
{sborniktestov id=12345}
```

Replace `12345` with the quiz ID from sborniktestov.ru. The ID is the number in the quiz URL: `sborniktestov.ru/quiz/12345`.

### Parameters

You can customise the embed with additional parameters:

```
{sborniktestov id=12345 comments=1 related=1 header=0 min_height=500}
```

| Parameter   | Values | Default | Description                         |
|-------------|--------|---------|-------------------------------------|
| id          | number | —       | Quiz ID (required)                  |
| comments    | 1 / 0  | 0       | Show comments section               |
| related     | 1 / 0  | 0       | Show related quizzes                |
| header      | 1 / 0  | 1       | Show quiz title                     |
| desc        | 1 / 0  | 1       | Show quiz description               |
| stats       | 1 / 0  | 1       | Show view/completion statistics     |
| min_height  | px     | 400     | Minimum iframe height               |
| max_width   | px     | 800     | Maximum content width inside embed  |

### Custom colours

```
{sborniktestov id=12345 color_accent=FF5722 color_bg=FFFFFF color_text=333333 radius=12}
```

Available colour parameters: `color_accent`, `color_bg`, `color_title`, `color_text`, `color_btn_text`, `color_selected_bg`, `color_progress_bg`, `color_progress_fill`, `color_border`, `color_border_selected`, `color_btn_prev`, `color_hover`.

Font size parameters (in px): `font_title`, `font_desc`, `font_stats`, `font_question`, `font_answer`.

Layout parameters (in px): `radius`, `padding`.

### Auto-embed links

When enabled in settings, the filter will automatically replace links to `sborniktestov.ru/quiz/NNN` with an embedded quiz. This can be enabled in **Site administration → Plugins → Filters → Sbornik Testov quiz embed**.

### Finding the quiz ID

1. Open any quiz on [sborniktestov.ru](https://sborniktestov.ru).
2. The number in the URL is the quiz ID: `sborniktestov.ru/quiz/12345`.
3. You can also click the "HTML код" link in the quiz stats line to see the embed code.

## Settings

Visit **Site administration → Plugins → Filters → Sbornik Testov quiz embed** to configure:

- **Default display options** — set defaults for title, description, statistics, comments and related quizzes visibility.
- **Minimum height / Maximum width** — default iframe dimensions.
- **Auto-embed quiz links** — automatically convert links to embedded quizzes.
- **Show credit link** — display a "Quiz powered by Sbornik Testov" attribution below embeds.

## Privacy

This plugin loads quiz content from sborniktestov.ru via an iframe. The external service receives standard HTTP request data (IP address, browser user agent) and may set an anonymous cookie to remember quiz results.

**No Moodle user data is transmitted to the external service.** The plugin does not send usernames, email addresses, or any other Moodle profile information.

For more information, see the [Sbornik Testov privacy policy](https://sborniktestov.ru/privacy-en.html).

## Licence

This plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

## Support

- **Bug reports**: [GitHub Issues](https://github.com/sborniktestov/moodle-filter_sborniktestov/issues)
- **Documentation**: [GitHub Wiki](https://github.com/sborniktestov/moodle-filter_sborniktestov/wiki)
- **Email**: info@sborniktestov.ru
