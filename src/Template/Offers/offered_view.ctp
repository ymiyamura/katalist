<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<div class="offers view columns content">
    <?php //debug($offer); ?>
    <h3><?= h($offer->from_user->disp_name) ?> さん</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('catch_phrase') ?></th>
            <td><?= h($offer->from_user->catch_phrase) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('description') ?></th>
            <td><?= h($offer->from_user->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $statuses[$offer->status] ?? '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($offer->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($offer->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('希望時間帯') ?></h4>
        <?= $this->Text->autoParagraph(h($offer->request_message)); ?>
    </div>
    <div class="row">
        <h4><?= __('その他伝達事項など') ?></h4>
        <?= $this->Text->autoParagraph(h($offer->free_message)); ?>
    </div>
    <div class="">
        <?php if ($offer->status === 1): ?>
            <button type="button" name="button"><?= $this->Html->link('承認する', ['action' => 'accept', $offer->id], ['confirm' => 'オファーを承認します。よろしいですか？']) ?></button>
            <button type="button" name="button"><?= $this->Html->link('拒否する', ['action' => 'cancel', $offer->id], ['confirm' => 'オファーを拒否します。よろしいですか？']) ?></button>
        <?php elseif ($offer->status === 2): ?>
            <button type="button" name="button">電話をかける</button>
            <form id="make-call" class="pure-form">
                <input type="text" placeholder="Call user id..." id="callto-id" value="<?= $offer->from_user->id; ?>">
                <button href="#" class="pure-button pure-button-success" type="submit">Call</button>
            </form>
            <form id="end-call" class="pure-form">
                <p>Currently in call with <span id="their-id">...</span></p>
                <button href="#" class="pure-button pure-button-success" type="submit">End Call</button>
            </form>
        <?php endif; ?>
    </div>
</div>
