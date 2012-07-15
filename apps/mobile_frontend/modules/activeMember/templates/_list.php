<?php
$list = array();
foreach ($memberList as $member)
{
  $list[] = op_link_to_member($member);
}
op_include_list('activeMemberList', $list, array('title' => __('Active members'), 'border' => false));
