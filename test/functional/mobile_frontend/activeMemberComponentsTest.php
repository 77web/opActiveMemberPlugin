<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';
$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));
include dirname(__FILE__).'/../../bootstrap/database.php';

$browser->setCulture('en')->setMobile();
$browser->get('/')->with('user')->isAuthenticated(false);

$browser->info('activeMember/_list component is open');
$html = get_component('activeMember', 'list');
$browser->test()->ok('' != $html, 'activeMember/_list was rendered successfully.');
$browser->getResponse()->setContent($html);
$browser
  ->with('response')->begin()
    ->checkElement('#activeMemberList')
    ->checkElement('tr', 3)
    ->checkElement('td:contains("Active members")')
    ->checkElement('td:contains("Member4")')
    ->checkElement('td:contains("Member2")')
    ->checkElement('td:contains("Member3")', false)
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
    ->checkElement('tr', 4)
    ->checkElement('td:contains("Active members")')
    ->checkElement('td:contains("Member4")')
    ->checkElement('td:contains("Member2")')
    ->checkElement('td:contains("Member1")')
    ->checkElement('td:contains("Member3")', false)
  ->end()
;

$html = get_component('activeMember', 'friendList');
$browser->test()->ok('' != $html, 'activeMember/_friendList was rendered successfully.');
$browser->getResponse()->setContent($html);
$browser
  ->with('response')->begin()
    ->checkElement('#activeFriendList')
    ->checkElement('tr', 2)
    ->checkElement('td:contains("Member4")')
    ->checkElement('td:contains("Member2")', false)
  ->end()
;
