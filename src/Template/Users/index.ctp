<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index columns content">
    <h3><?= __('Users') ?></h3>
    <div class="">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <?= $this->Form->text('search', ['value' => h($search_text) ?? '', 'placeholder' => '例：人事']) ?>
        <?= $this->Form->submit('検索') ?>
        <?= $this->Html->link('検索条件をクリア', ['action' => 'index']) ?>
        <?= $this->Form->end() ?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">katalists</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <div class="">
                        <p><?= $this->Html->image('/files/Users/image1/' . $user->id . '/' . h($user->image1), ['alt' => h($user->image1), '']); ?></p>
                        <p><?= h($user->catch_phrase) ?></p>
                        <p><?= h($user->disp_name) ?></p>
                        <p><?= $this->Html->link(__('詳しく見る'), ['action' => 'view', $user->id]) ?></p>
                    </div>
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
