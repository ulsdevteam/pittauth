<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Idtype $idtype
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Idtype'), ['action' => 'edit', $idtype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Idtype'), ['action' => 'delete', $idtype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $idtype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Idtypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Idtype'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="idtypes view large-9 medium-8 columns content">
    <h3><?= h($idtype->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Idtype') ?></th>
            <td><?= h($idtype->idtype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($idtype->id) ?></td>
        </tr>
    </table>
</div>
