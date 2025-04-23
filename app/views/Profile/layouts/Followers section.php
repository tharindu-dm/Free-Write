<!-- Followers Section -->
<div id="my-network" class="view-section">
    <div class="myfollow-tabs">
        <div class="myfollow-tab active" onclick="switchTab('followers')">Followers</div>
        <div class="myfollow-tab" onclick="switchTab('following')">Following</div>
    </div>

    <div id="followers-grid" class="myfollow-user-grid">
        <?php if ($followedByList): ?>
            <?php foreach ($followedByList as $follower): ?>
                <a href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($follower['user']) ?>">
                    <div class="myfollow-user-card">
                        <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($follower['profileImage'] ?? 'profile-image.jpg') ?>"
                            alt="John Doe" class="myfollow-user-image">
                        <div class="myfollow-user-info">
                            <div class="myfollow-user-name"><?= htmlspecialchars($follower['userName']) ?>
                            </div>
                            <div class="myfollow-user-last-logged">
                                <?= htmlspecialchars($follower['lastLogDate']) ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No followers yet.</p>
        <?php endif; ?>
    </div>

    <div id="following-grid" class="myfollow-user-grid" style="display: none;">
        <?php if ($followingList): ?>
            <?php foreach ($followingList as $follower): ?>
                <a href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($follower['user']) ?>">
                    <div class="myfollow-user-card">
                        <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($follower['profileImage'] ?? 'profile-image.jpg') ?>"
                            alt="Sarah Lee" class="myfollow-user-image">
                        <div class="myfollow-user-info">
                            <div class="myfollow-user-name"><?= htmlspecialchars($follower['userName']) ?>
                            </div>
                            <div class="myfollow-user-last-logged">
                                <?= htmlspecialchars($follower['lastLogDate']) ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Not following anyone yet.</p>
        <?php endif; ?>
    </div>
</div>