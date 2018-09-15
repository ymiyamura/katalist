<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Offer $offer
 */
 $this->assign('title', 'カタリスト詳細');
?>
<div class="users view columns content">
    <h3><?= h($user->disp_name) ?></h3>
    <div class="">
        <table class="vertical-table">
            <tr>
                <td><?= h($user->catch_phrase) ?></td>
            </tr>
            <tr>
                <td>
                    <p class="text-left">◆語れる内容◆</p>
                    <p class="text-left"><?= h($user->description) ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="text-left">◆希望時間帯◆</p>
                    <p class="text-left"><?= h($user->request_condition) ?></p>
                </td>
            </tr>
            <tr>
                <td><?= h($user->price) ?>円</td>
            </tr>
        </table>
    </div>
    <div class="">
        <?= $this->Form->create($offer, [
                'method' => 'post',
                'url' => [
                    "controller" => "Offers",
                    "action" => "add",
                ],
            ]) ?>
            <fieldset>
                <legend><?= __('オファー') ?></legend>
                <?= $this->Form->control('request_message', ['label' => '希望時間帯']) ?>
                <?= $this->Form->control('free_message', ['label' => 'その他伝達事項など']) ?>
                <?= $this->Form->hidden('to_user_id', ['value' => $user->id]) ?>
            </fieldset>
        <?= $this->Form->button(__('この人にオファー')); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
