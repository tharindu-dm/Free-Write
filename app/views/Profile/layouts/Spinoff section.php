<!-- Spin-offs Section -->
<div id="spinoffs" class="view-section">
    <h2>My Spin-offs</h2>
    <div class="spin-off-message">
        <h3>Creating a Spin-off</h3>
        <p>
            Spin-offs are stories that are based on existing stories. You can create a spin-off of
            your
            own story or any other story you like. Please note that you need to have read the
            chapter
            you create a spin-off of, and you can only create spin-offs of chapters that are public
            except the first chapter.
        </p>
        <p>
            Additionally, spin-offs are a great way to explore alternate storylines, character arcs,
            or
            even dive deeper into untold backstories. Remember to give credit to the original story
            where required,
            and ensure your spin-off aligns with the community guidelines to maintain a respectful
            and
            engaging environment for all users.
        </p>
        <p>Access spinoff creation through the book overview.</p>
    </div>

    <?php if (!empty($spinoffs)): ?>
        <div class="spinoff-container">
            <?php foreach ($spinoffs as $spinoff): ?>
                <a href="/Free-Write/public/spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                    <div class="spinoff-item">
                        <div class="spinoff-content">
                            <h3 class="spinoff-title"><?= htmlspecialchars($spinoff['SpinoffName']); ?></h3>
                            <p class="book-title"><?= htmlspecialchars($spinoff['BookTitle']); ?></p>
                            <div class="spinoff-details">
                                <div class="spinoff-meta">
                                    <span class="chapter-count"><?= $spinoff['SpinoffChapterCount'] ?>
                                        Chapters</span>
                                    <span class="access-type"><?= htmlspecialchars($spinoff['AccessType']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No spin-offs yet.</p>
    <?php endif; ?>
</div>