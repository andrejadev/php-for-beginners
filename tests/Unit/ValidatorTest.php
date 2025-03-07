<?php

use Core\Validator;

//we can use it() instead of test() for defining a test

it('validates a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
    /*Can be written like this as well:
     * $result = Validator::string('foobar');
    expect($result)->toBe(true); //we can use the method toBeTrue() as well
    */
});

it('validates a string with a minimum length', function () {
    expect(Validator::string('foobar',20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foobar'))->toBeFalse();
    expect(Validator::email('example@foobar.com'))->toBeTrue();
});

it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThen(10, 1))->toBeTrue();
})->only(); // using PEST method only() we define that we only want to run this particular test