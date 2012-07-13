<?php
$list = array();
foreach ($memberList as $member)
{
  $list[] = op_link_to_member($member);
}
op_include_list('activeFriendList', $list, array('title' => __('Active %my_friend%'), 'border' => false));
