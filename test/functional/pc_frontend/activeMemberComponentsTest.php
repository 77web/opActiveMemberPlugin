<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';
$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser->setCulture('en');
$browser->get('/')->with('user')->isAuthenticated(false);

$browser->info('activeMember/_list component is open');
$html = get_component('activeMember', 'list');
$browser->test()->ok('' != $html, 'activeMember/_list was rendered successfully.');
$browser->getResponse()->setContent($html);
$browser
  ->with('response')->begin()
    ->checkElement('#activeMemberList')
    ->checkElement('.partsHeading h3:contains("Active members")')
    ->checkElement('ul li', 2)
    ->checkElement('ul li a:contains("Member4")')
    ->checkElement('ul li a:contains("Member2")')
    ->checkElement('ul li a:contains("Member3")', false)
  ->end()
;

$browser->info('activeMember/_friendList component requires membership');
$html = get_component('activeMember', 'friendList');
$browser->test()->ok('' == $html);

$browser->login('sns@example.com', 'password')->setCulture('en');
$browser->get('/')->with('user')->isAuthenticated();

$html = get_component('activeMember', 'list');
$browser->test()->ok('' != $html, 'activeMember/_list was rendered successfully.');
$browser->getResponse()->setContent($html);
$browser
  ->with('response')->begin()
    ->checkElement('#activeMemberList')
    ->checkElement('.partsHeading h3:contains("Active members")')
    ->checkElement('ul li', 3)
    ->checkElement('ul li a:contains("Member4")')
    ->checkElement('ul li a:contains("Member2")')
    ->checkElement('ul li a:contains("Member1")')
    ->checkElement('ul li a:contains("Member3")', false)
  ->end()
;

$html = get_component('activeMember', 'friendList');
$browser->test()->ok('' != $html, 'activeMember/_friendList was rendered successfully.');
$browser->getResponse()->setContent($html);
$browser
  ->with('response')->begin()
    ->checkElement('#activeFriendList')
    ->checkElement('ul li', 1)
    ->checkElement('ul li a:contains("Member4")')
    ->checkElement('ul li a:contains("Member2")', false)
  ->end()
;