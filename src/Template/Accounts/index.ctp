<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account[]|\Cake\Collection\CollectionInterface $accounts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Assign a Guest Account'), ['action' => 'add']) ?></li>
        <li><?php if(h($user)==='admin'):?>
            <ul class="side-nav"> 
                <li class="heading"><?= __('Admin') ?></li>
                <li><?=  $this->Html->link(__('View Accounts'), ['controller'=>'admin/accounts', 'action' => 'index']) ?></li>
                <li><?=  $this->Html->link(__('View Logs'), ['controller'=>'admin/logs', 'action' => 'index']) ?></li>
            </ul>
        <?php endif; ?>

    </ul>
</nav>
<div class="accounts index large-9 medium-8 columns content">
  <h3><?= __('Active Guest Accounts') ?></h3>
  <table cellpadding="0" cellspacing="0">
      <thead>
          <tr>

              <th scope="col"><?= $this->Paginator->sort('username') ?></th>
              <th scope="col"><?= $this->Paginator->sort('firstname') ?></th>
              <th scope="col"><?= $this->Paginator->sort('lastname') ?></th>
              
              
              <th scope="col"><?= $this->Paginator->sort('note') ?></th>
              <th scope="col"><?= $this->Paginator->sort('assigned_by') ?></th>
              <th scope="col"><?= $this->Paginator->sort('created') ?></th>

              <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($accounts as $account): ?>
          <tr>

              <td><?= h($account->username) ?></td>
              <td><?= h($account->firstname) ?></td>
              <td><?= h($account->lastname) ?></td>
              
              
              <td><?= h($account->note) ?></td>
              <td><?= h($account->assigned_by) ?></td>
              <td><?= h($account->created->i18nFormat(null, 'America/New_York')) ?></td>






              <td class="actions">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $account->id]) ?>
                  <?= $this->Html->link(__('Clear'), ['action' => 'clear', $account->username]) ?>

              </td>
          </tr>
          <?php endforeach; ?>
      </tbody>
  </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
