scanner
=======

php string scanner inspired by the [NSScanner](https://developer.apple.com/library/mac/#documentation/Cocoa/Reference/Foundation/Classes/NSScanner_Class/Reference/Reference.html).


```php
use pelish8\scanner as NS;

$string = "github.com";
$scanner = new NS\Scanner($string, NS\Scanner::BACKWARD_SEARCH);

$scanner->scanToCharacterFromString('.');
$index = $scanner->location();
echo '<br>';
echo substr($string, $index, $scanner->length()); //com
echo '<br>';

$string = "aaasad{0}asdasd{{1}}{2}}.asd.as.da.sd.as.da..........{{3}}!@#!@#!@#!@#{{4}}::\"\"asdasdasdasdas{{5}} \\\\\\\" '{{6}}'{{...}}asdasdas";
$scanner = new NS\Scanner($string);

while (!$scanner->isAtEnd()) {
    $scanner->scanToString('{{');
    $start = $scanner->location();

    if (!$scanner->isAtEnd()) {
        $scanner->scanUpToString('}}');
        $end = $scanner->location();
        echo substr($string, $start, $end - $start); //123456...
    }
}


```
