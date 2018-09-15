<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer[]|\Cake\Collection\CollectionInterface $offers
 */
?>
<div class="offers index columns content">
    <h3><?= __('来たオファー') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">送り主</th>
                <th scope="col">状態</th>
                <th scope="col">オファー日</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $offer): ?>
            <tr>
                <td><?= h($offer->from_user->disp_name) ?></td>
                <td><?= $statuses[$offer->status] ?></td>
                <td><?= $offer->created ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('見る'), ['action' => 'view', $offer->id]) ?>
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
