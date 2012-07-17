<?php
$options = array(
  'title' => __('Active members'),
);

if (count($memberList) > 0)
{
  $list = array();
  foreach ($memberList as $member)
  {
    $list[] = op_link_to_member($member);
  }
  $options['border'] = false;

  op_include_list('activeMemberList', $list, $options);
}
else
{
  op_include_box('activeMemberList', 'No active members.', $options);
}
