<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('disp_name');
            echo $this->Form->control('catch_phrase');
            echo $this->Form->control('description');
            echo $this->Form->control('request_condition');
            echo $this->Form->control('price');
            echo $this->Form->control('gender');
            echo $this->Form->control('birth');
        ?>
        <?php
            if (empty($user->image1)) {
                echo $this->Form->control('image1', ['type' => 'file']);
            } else {
                echo $this->Html->image('/files/Users/image1/' . $user->id . '/' . h($user->image1), ['alt' => h($user->image1)]);
                echo '<br>別の写真をアップロード';
                echo $this->Form->control('image1', ['type' => 'file']);

            }
        ?>
        <?php //debug($user); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
