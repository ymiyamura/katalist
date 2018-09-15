<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Offer'), ['action' => 'edit', $offer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Offer'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="offers view large-9 medium-8 columns content">
    <h3><?= h($offer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($offer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From User Id') ?></th>
            <td><?= $this->Number->format($offer->from_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To User Id') ?></th>
            <td><?= $this->Number->format($offer->to_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($offer->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accepted') ?></th>
            <td><?= h($offer->accepted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cancelled') ?></th>
            <td><?= h($offer->cancelled) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Called') ?></th>
            <td><?= h($offer->called) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($offer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($offer->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Request Message') ?></h4>
        <?= $this->Text->autoParagraph(h($offer->request_message)); ?>
    </div>
    <div class="row">
        <h4><?= __('Free Message') ?></h4>
        <?= $this->Text->autoParagraph(h($offer->free_message)); ?>
    </div>
</div>
