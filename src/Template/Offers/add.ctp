<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="offers form large-9 medium-8 columns content">
    <?= $this->Form->create($offer) ?>
    <fieldset>
        <legend><?= __('Add Offer') ?></legend>
        <?php
            echo $this->Form->control('from_user_id');
            echo $this->Form->control('to_user_id');
            echo $this->Form->control('request_message');
            echo $this->Form->control('free_message');
            echo $this->Form->control('status');
            echo $this->Form->control('accepted', ['empty' => true]);
            echo $this->Form->control('cancelled', ['empty' => true]);
            echo $this->Form->control('called', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
