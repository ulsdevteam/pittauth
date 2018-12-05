<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Idtype $idtype
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $idtype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $idtype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Idtypes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="idtypes form large-9 medium-8 columns content">
    <?= $this->Form->create($idtype) ?>
    <fieldset>
        <legend><?= __('Edit Idtype') ?></legend>
        <?php
            echo $this->Form->control('idtype');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
