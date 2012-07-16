<?php slot('activeList'); ?>
  <?php if (count($memberList) > 0): ?>
    <ul>
      <?php foreach ($memberList as $member): ?>
        <li><?php echo op_link_to_member($member); ?></li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p><?php echo __('No active members.'); ?></p>
  <?php endif; ?>
<?php end_slot(); ?>
<?php op_include_box('activeMemberList', get_slot('activeList'), array('title' => __('Active members'))); ?>
