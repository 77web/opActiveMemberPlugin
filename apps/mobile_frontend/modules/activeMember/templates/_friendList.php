<?php
$options = array(
  'title' => __('Active %my_friend%'),
);

if (count($memberList) > 0)
{
  $list = array();
  foreach ($memberList as $member)
  {
    $list[] = op_link_to_member($member);
  }
  $options['border'] = false;

  op_include_list('activeFriendList', $list, $options);
}
else
{
  op_include_box('activeFriendList', 'No active %my_friend%.', $options);
}
