<?php slot('activeFriendList'); ?>
  <ul>
    <?php foreach ($memberList as $member): ?>
      <li><?php echo op_link_to_member($member); ?></li>
    <?php endforeach; ?>
  </ul>
<?php end_slot(); ?>
<?php op_include_box('activeFriendList', get_slot('activeFriendList'), array('title' => __('Active %my_friend%'))); ?>
