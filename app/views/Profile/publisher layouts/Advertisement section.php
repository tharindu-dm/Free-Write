<!-- Advertisement Section -->
<div id="advertisements" class="view-section">
    <h2>My Advertisement Site</h2>
    <div class="advertisement-container">
        <?php if (!empty($data['advertisements'])): ?>
            <table class="advertisement-table">
                <thead>
                    <tr data-ad-id="<?= htmlspecialchars($ad['adID']) ?>">
                        <th>Advertisement Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Contact Email</th>
                        <th>Status</th>
                        <th>Actions</th> <!-- New column for Edit, Save, Cancel, and Delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['advertisements'] as $ad): ?>
                        <tr>
                            <td><?= htmlspecialchars($ad['advertisementType']) ?></td>
                            <td><?= htmlspecialchars($ad['startDate']) ?></td>
                            <td class="editable" contenteditable="false"><?= htmlspecialchars($ad['endDate']) ?>
                            </td>
                            <td><?= htmlspecialchars($ad['contactEmail']) ?></td>
                            <td><?= htmlspecialchars($ad['status']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <?php if ($ad['status'] === 'expired'): ?>
                                        <a
                                            href="/Free-Write/public/Publisher/applyingAdvertisement/<?= htmlspecialchars($ad['adID']) ?>"><button
                                                class="edit-btn">
                                                <i class="fas fa-edit"></i> Renew
                                            </button></a>
                                    <?php endif; ?>
                                    <?php if ($ad['status'] === 'active' || $ad['status'] === 'pending'): ?>
                                        <button class="btn delete-btn" id="deleteAdBtn"
                                            onclick="showDeleteConfirmation('<?= htmlspecialchars($ad['adID']) ?>')">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-ads-message">
                <p>No currently hired advertisements</p>
            </div>
        <?php endif; ?>
        <a href="/Free-Write/public/Publisher/applyingAdvertisement">
            <button class="edit-profile-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Apply for Advertisement
            </button>
        </a>
    </div>
</div>

<!-- Delete Confirmation Overlay -->
<div class="deleteOverlay-container">
    <div class="deleteOverlay">
        <h2>You will not get refund for this.
            Are you sure you want to remove this advertisement?</h2>
        <form action="/Free-Write/public/Publisher/deleteAdvertisement" method="POST">
            <input type="hidden" name="adID" id="deleteAdID" value="<?=
                htmlspecialchars(string: $ad['adID']) ?>">
            <label for="adID-label">Advertisement ID</label>
            <input type="text" id="adID-label" disabled value="<?=
                htmlspecialchars(string: $ad['adID']) ?>">
            <label for="adType-label">Advertisement Type</label>
            <input type="text" id="adType-label" disabled value="<?=
                htmlspecialchars(string: $ad['advertisementType']) ?>">
            <button type="submit" id="deleteAd_Agree">Yes, Delete</button>
            <button type="button" id="cancelDeleteAd" onclick="hideDeleteOverlay()">Cancel</button>
        </form>
    </div>
</div>

<div class="editOverlay-container">
    <div class="editOverlay">
        <h2>Edit Advertisement End Date</h2>
        <form action="/Free-Write/public/Publisher/payPage4ad" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="adID" id="editAdID">
            <div class="form-group">
                <label for="currentEndDate">Current End Date</label>
                <input type="text" id="currentEndDate" name="oldEndDate" readonly>
            </div>
            <div class="form-group">
                <label for="newEndDate">New End Date</label>
                <input type="date" id="newEndDate" name="newEndDate" required>
            </div>
            <div class="form-group">
                <label for="newAdImage">New Advertisement Image</label>
                <input type="file" id="newAdImage" name="newAdImage" accept="image/*">
                <p class="description">JPG or PNG, 2MB max</p>
            </div>
            <div class="button-group">
                <button type="submit" class="save-btn">Proceed to Payment</button>
                <button type="button" class="cancel-btn" onclick="hideEditOverlay()">Cancel</button>
            </div>
        </form>
    </div>
</div>