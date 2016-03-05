<?php if ($message = FlashMessage::pop()): ?>
    <div class="alert alert-<?= $message["type"] ?>">
        <?= $message["message"] ?>
    </div>
<?php endif ?>
