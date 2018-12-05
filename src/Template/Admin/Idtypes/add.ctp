<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Idtype $idtype
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Idtypes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="idtypes form large-9 medium-8 columns content">
    <?= $this->Form->create($idtype) ?>
    <fieldset>
        <legend><?= __('Add Idtype') ?></legend>
        <?php
            echo $this->Form->control('idtype');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
