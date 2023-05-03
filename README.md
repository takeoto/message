# System message
### Abstraction for system messages
#### Usage
```php
use Takeoto\Message\Message;

$message = new Message('Hello Earth!');
echo $message; # Hello World!

$message = new Message('Hello {{ platen }}!', [
    '{{ platen }}' => 'Mars 👽',
]);
echo $message; # Hello Mars 👽!"
```