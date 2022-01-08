# Telegram Bot Inline Keyboard Calendar

Simple inline keyboard calendar, inspired by [unmonoqueteclea](https://github.com/unmonoqueteclea/calendar-telegram)

## Installation

Use the package manager [composer](https://getcomposer.org/) to install.

```bash
composer require yudaapratama/inline-keyboard-calendar
```

## Usage

```php
use yudaapratama\Calendar\InlineKeyboardCalendar;

//Define Inline Keyboard Calendar
$keyboard = new InlineKeyboardCalendar();

$keyboard->setConfigDate("2022-01"); //Set the date for first show inline keyboard
$keyboard->Calendar();

```

## Example
example using [longman](https://github.com/php-telegram-bot/core) library telegram bot.
```php
//CalendarCommand.php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;

use yudaapratama\Calendar\InlineKeyboardCalendar;

....


$keyboard = new InlineKeyboardCalendar();

$keyboard->setConfigDate("2022-01");

$inlineKeyboard = new InlineKeyboard(...$keyboard->Calendar());

$format =
[
  'chat_id' => $chatId,
  'message_id' => $callbackMessageId,
  'text' => "Choose a date",
  'reply_markup' => $inlineKeyboard
];

return Request::editMessageText($format);
```

```php
//QallbackqueryCommand.php

....

use yudaapratama\Calendar\InlineKeyboardCalendar;

....

list($action, $data) = explode("::", $callbackData);

switch ($action) {
  case 'day': //case when button date is selected
  $format =
    [
      'chat_id' => $callbackChatId,
      'message_id' => $callbackMessageId,
      'text' => "Selected date: " . $data,
      'reply_markup' => $inlineKeyboard
    ];

    return Request::editMessageText($format);
    break;

  case 'ignore': //case when selected except the date
    return $callbackQuery->answer([
        'text'       => 'Oops choose another date.',
        'show_alert' => true,
        'cache_time' => 5,
    ]);
    break;

  case 'prev': //when the prev button pressed

    $keyboard = new InlineKeyboardCalendar();
    $keyboard->setConfigDate($data);
    $keyboar
    $inlineKeyboard = new InlineKeyboard(...$keyboard->Calendar());

    $format =
    [
      'chat_id' => $callbackChatId,
      'message_id' => $callbackMessageId,
      'text' => "Choose a date",
      'reply_markup' => $inlineKeyboard
    ];

    return Request::editMessageText($format);

    break;

  case 'next': //when the next button pressed

    $keyboard = new InlineKeyboardCalendar();
    $keyboard->setConfigDate($data);
    $keyboar
    $inlineKeyboard = new InlineKeyboard(...$keyboard->Calendar());

    $format =
    [
      'chat_id' => $callbackChatId,
      'message_id' => $callbackMessageId,
      'text' => "Choose a date",
      'reply_markup' => $inlineKeyboard
    ];

    return Request::editMessageText($format);

    break;
}

```

## License
[MIT](https://choosealicense.com/licenses/mit/)
