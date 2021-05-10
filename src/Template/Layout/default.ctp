<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'KATALI.ST: 聞ける、自由をつくる。';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('call.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?= $this->Html->link('katali.st', ['controller' => 'Users', 'action' => 'index']); ?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if ($is_login): ?>
                    <li><?= h($login_user['disp_name']) ?>さん</li>
                    <li><?= $this->Html->link('profile', ['controller' => 'Users', 'action' => 'edit']) ?></li>
                    <li><?= $this->Html->link('my offer', ['controller' => 'Offers', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('received offer', ['controller' => 'Offers', 'action' => 'offered']) ?></li>
                    <li><?= $this->Html->link('logout', ['controller' => 'Users', 'action' => 'logout']) ?></li>
                <?php else: ?>
                    <li><?= $this->Html->link('sign up', ['controller' => 'Users', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('log in', ['controller' => 'Users', 'action' => 'login']) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    </div>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
        <?php if ($is_login): ?>
            <div class="pure-u-2-3" id="audio-container">
                <audio id="their-audio" autoplay></audio>
                <audio id="my-audio" muted="true" autoplay></audio>
            </div>
            <div style="display: none;" id="x_call_key" data-value="<?= env('CALL_KEY', ''); ?>">
            <div style="display: none;" id="x_user_peer_id" data-value="<?= $login_user['user_peer_id'] ?>">
            <script type="text/javascript" src="https://cdn.webrtc.ecl.ntt.com/skyway-latest.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            <!-- <script type="text/javascript" src="/js/call.js"></script> -->
            <?= $this->Html->script('call.js'); ?>
        <?php endif; ?>
    </div>
    <footer>
    </footer>
</body>
</html>
