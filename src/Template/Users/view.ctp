<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
        <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('オファー') ?></legend>
                <?= $this->Form->control('offer_message', ['label' => '希望時間帯']) ?>
                <?= $this->Form->control('user_message', ['label' => 'その他伝達事項など']) ?>
            </fieldset>
        <?= $this->Form->button(__('この人にオファー')); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
