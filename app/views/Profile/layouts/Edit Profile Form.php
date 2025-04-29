<div class="edit-profile">
    <div class="close-overlay-button">
        <button id="cancelOverlayBtn" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            close
        </button>
    </div>
    <div class="edit-profile-container">
        <form enctype="multipart/form-data" id="edit-profile-form" action="/Free-Write/public/User/EditProfile"
            method="POST" onsubmit="return validateForm()">

            <div class="edit-profile-item edit-name">
                <div>
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName"
                        value="<?= htmlspecialchars($userDetails['firstName']); ?>" required maxlength="45"
                        pattern="[A-Za-z\s]+" title="First name can only contain letters and spaces">
                </div>
                <div>
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName"
                        value="<?= htmlspecialchars($userDetails['lastName']); ?>" required maxlength="45"
                        pattern="[A-Za-z\s]+" title="Last name can only contain letters and spaces">
                </div>
            </div>
            <div class="edit-profile-item">
                <label for="bio">Bio</label>
                <textarea id="bio" rows="6" name="bio" maxlength="255"
                    required><?= htmlspecialchars($userDetails['bio']); ?></textarea>
            </div>

            <div class="edit-profile-item">
                <label for="profileImage" class="drop-zone" id="drop-zone">
                    <span>Drag & drop your profile image here or click to select</span>
                    <input type="file" id="PlaceImage" name="profileImage" accept="image/*">
                </label>
            </div>

            <div class="edit-profile-item">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($userDetails['dob']); ?>"
                    max="<?= date('Y-m-d') ?>">
            </div>
            <div class="edit-profile-item">
                <label for="country">Country</label>

                <?php
                $countryJson = '[
                                "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina",
                                "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
                                "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bosnia and Herzegovina", "Botswana",
                                "Brazil", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia",
                                "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia",
                                "Comoros", "Congo", "Congo, Democratic Republic of the", "Costa Rica", "Croatia", "Cuba", "Cyprus",
                                "Czech Republic", "Côte d\'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
                                "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (Swaziland)",
                                "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece",
                                "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary",
                                "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan",
                                "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan",
                                "Lao People\'s Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
                                "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia North", "Madagascar", "Malawi", "Malaysia",
                                "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia",
                                "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar (Burma)", "Namibia",
                                "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman",
                                "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
                                "Portugal", "Qatar", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
                                "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
                                "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia",
                                "Solomon Islands", "Somalia", "South Africa", "South Sudan", "Spain", "Sri Lanka", "Sudan",
                                "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
                                "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey (Türkiye)", "Turkmenistan",
                                "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
                                "Uzbekistan", "Vanuatu", "Vatican City Holy See", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
                                ]';
                $countries = json_decode($countryJson);
                $selectedCountry = $userDetails['country'];
                ?>


                <select id="country" name="country" required>
                    <option value="">Select your country</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?= htmlspecialchars($country) ?>" <?= ($country === $selectedCountry) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($country) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="edit-profile-item">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userAccount['email']); ?>"
                    required>
            </div>
            <div class="edit-profile-item">
                <button type="submit" name="submit">Save Changes</button>
            </div>
        </form>


        <hr class="horizontal-divider">

        <div class="danger-zone">
            <h3>Danger Zone</h3>
            <div class="warning-message">
                <p>Warning: Deleting your account will permanently remove:</p>
                <ul>
                    <li>All your posts and writings</li>
                    <li>Your profile information</li>
                    <li>Your comments and interactions</li>
                    <li>All associated data</li>
                </ul>
                <p>This action cannot be undone.</p>
            </div>
            <div class="warning-message">
                <p>Warning: For writers, spinoffwriters and cover designers</p>
                <ul>
                    <li>If you want your content to be removed, please use your dashboards to manually delete your
                        Intellectual properties (IPs)</li>
                </ul>
                <p>This action cannot be undone.</p>
            </div>
            <form action="/Free-Write/public/User/DeleteProfile" method="POST">
                <button class="delete-account-btn" type="submit">Delete Account</button>
            </form>
        </div>
        <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
    </div>
</div>