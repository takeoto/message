# System message
### Abstraction for system messages
#### Usage
```php
use Takeoto\Message\Message;
use Takeoto\Message\NoticeMessage;
use Takeoto\Message\ErrorMessage;
use Takeoto\Message\WarningMessage;
use Takeoto\Message\MessagesCollection;

$message = new Message('Hello Earth!');
echo $message; # Hello World!

# --- The message with template variables --------

$message = new Message('Hello {{ planet }}!', [
    '{{ planet }}' => 'Mars 👽',
]);
echo $message; # Hello Mars 👽!"

# --- Messages collection ------------------------

$messages = new MessagesCollection([
    new NoticeMessage('☀️The notice message.'),
    new WarningMessage('⚠️The warning message!'),
    new ErrorMessage(500, 'The error message ‼️'),
]);

if ($messages->getErrors()->count() > 0) {
    throw new \RuntimeException((string)$messages->getErrors()->first());
}
```