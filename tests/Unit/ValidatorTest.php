<?php

use Core\Validator;

it('validates a string', function () {
   $result = Validator::string('foobar');
   expect($result)->toBe(true); //we can use the method toBeTrue() as well
});