<?php
/**
 * opActiveMemberPluginBaseComponents
 *
 * @package    OpenPNE
 * @subpackage opActiveMemberPlugin
 * @auther     Hiromi Hishida<info@77-web.com>
 */
class opActiveMemberPluginBaseComponents extends sfComponents
{
 /**
  * SNS全体のログイン中ユーザーを表示する
  * 
  * @access public
  * @param  $request
  */
  public function executeList($request)
  {
    $query = Doctrine::getTable('Member')->createQuery('m');
    $this->addActiveCondition($query);

    $this->memberList = $query->execute();
  }

 /**
  * ログイン中のフレンドを表示する
  * 
  * @access public
  * @param  $request
  */
  public function executeFriendList($request)
  {
    if (!$this->getUser()->isSNSMember())
    {
      return sfView::NONE;
    }

    $friendIdList = Doctrine::getTable('MemberRelationship')->getFriendMemberIds($this->getUser()->getMemberId());
    $this->memberList = array();
    if (0 != count($friendIdList))
    {
      $query = Doctrine::getTable('Member')->createQuery('m')->andWhereIn('id', $friendIdList);
      $this->addActiveCondition($query);

      $this->memberList = $query->execute();
    }
  }

 /**
  * メンバーのクエリに現在ログイン中の条件を付加する
  * 
  * @access protected
  * @param  Doctrine_Query $query
  * @return void
  */
  protected function addActiveCondition(Doctrine_Query $query)
  {
    $timeStamp = time() - sfConfig::get('app_active_member_seconds', 60);
    $limit = sfConfig::get('app_active_member_limit', 10);

    $query->leftJoin('m.MemberConfig mc')->addWhere('mc.name = ?', 'lastLogin')->addWhere('mc.value_datetime >= ?', date('Y-m-d H:i:s', $timeStamp));

    if ($limit > 0)
    {
      $query->limit($limit);
    }
  }
}
