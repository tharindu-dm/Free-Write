<?php if (!isset($_SESSION['user_id']) || (isset($_GET['user']) && $_GET['user'] != $_SESSION['user_id'])): ?>
    <div id="report-profile" class="edit-profile">
        <div class="close-overlay-button">
            <button id="report-cancelOverlayBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                close
            </button>
        </div>
        <div class="edit-profile-container">
            <form id="report-profile-form" action="/Free-Write/public/User/ReportProfile" method="POST"
                onsubmit="return validateForm()">
                <input hidden type="text" id="reportedUserID" name="reportedUserID"
                    value="<?= htmlspecialchars($userAccount['userID']); ?>">

                <div class="edit-profile-item edit-name">
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName"
                            value="<?= htmlspecialchars($userDetails['firstName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="First name can only contain letters and spaces" disabled>
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName"
                            value="<?= htmlspecialchars($userDetails['lastName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="Last name can only contain letters and spaces" disabled>
                    </div>
                </div>
                <div class="edit-profile-item">
                    <label for="select">For further details we may contact you</label>
                    <select type="select" id="selectReason" name="selectReason" required>
                        <option value="">Select Reason</option>
                        <option value="harassment">Harassment</option>
                        <option value="spam">Spam</option>
                        <option value="hate speech">Hate Speech</option>
                        <option value="violence">Violence</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="edit-profile-item">
                    <label for="description">Briefly Describe Your Reason (600 characters)</label>
                    <textarea id="description" rows="6" name="description" maxlength="600" required></textarea>
                </div>

                <div class="edit-profile-item">
                    <label for="email">We may contact you for further details</label>
                    <input type="email" id="email" name="email" maxlength="50" required>
                </div>
                <div class="edit-profile-item">
                    <label for="bio">You can contact us via</label>
                    <p>freewrite_support@freewrite.com</p>
                </div>
                <div class="edit-profile-item">
                    <button type="submit" name="submit">Submit Report</button>
                </div>
            </form>
            <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
        </div>
    </div>
<?php endif; ?>