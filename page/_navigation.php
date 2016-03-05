<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><?= e($brand) ?></a>
        </div>
        <ul class="nav navbar-nav">
            <li
                <?php if ($active === "home"): ?>class="active"<?php endif ?>
            ><a href="/">Home</a></li>
            <li
                <?php if ($active === "company-list"): ?>class="active"<?php endif ?>
            ><a href="?p=company-list">Companies</a></li>
        </ul>
    </div>
</nav>
