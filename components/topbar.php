<?php
?>
<header class="topbar">
  <div>
    <h1>
      <?= $pageTitle ?>
    </h1>
    <p><?= $pageSubtitle ?></p>
  </div>

  <div class="topbar-user">
    <?= htmlspecialchars($_SESSION['name'] ?? '') ?>
    <span class="badge"><?= $user['role'] ?? '-' ?></span>
  </div>
</header>