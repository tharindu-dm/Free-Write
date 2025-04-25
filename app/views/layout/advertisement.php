<?php if ((isset($_SESSION['user_premium']) && $_SESSION['user_premium'] == 0) || !isset($_SESSION['user_id'])): ?>
    <div>
        <img src="/Free-Write/app/images/advertisements/<?= isset($_SESSION['user_ads']) ? htmlspecialchars($_SESSION['user_ads']) : 'ad.png'; ?>"
            alt="Ad" class="ad-image">
    </div>
<?php endif; ?>