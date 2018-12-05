<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log[]|\Cake\Collection\CollectionInterface $logs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
   <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Assign a Guest Account'), ['controller' => 'accounts', 'action' => 'index', 'prefix' => false]) ?></li>
        
            <ul class="side-nav"> 
                <li class="heading"><?= __('Admin') ?></li>
                <li><?=  $this->Html->link(__('View Accounts'), ['controller'=>'accounts', 'action' => 'index']) ?></li>
                <li><?=  $this->Html->link(__('View Logs'), ['controller'=>'logs', 'action' => 'index']) ?></li>
            </ul>
        

    </ul>
</nav>
<div class="logs index large-9 medium-8 columns content">
    <h3><?= __('Logs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('firstname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lastname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assigned_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cleared') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $this->Number->format($log->id) ?></td>
                <td><?= h($log->username) ?></td>
                <td><?= h($log->firstname) ?></td>
                <td><?= h($log->lastname) ?></td>
                <td><?= h($log->id_number) ?></td>
                <td><?= h($log->idtype->idtype) ?></td>
                <td><?= h($log->note) ?></td>
                <td><?= h($log->assigned_by) ?></td>
                <td><?= h($log->created->i18nFormat(null, 'America/New_York')) ?></td>
                <td>
                  <?php
                    if (h($log->cleared)==''){echo '';}
                    else{echo h($log->cleared->i18nFormat(null, 'America/New_York'));}
                  ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $log->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id)]) ?>
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
