<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/profile.css">
</head>

<body>
    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }

    //how($data);
    ?>

    <main>
        <section class="profile-container">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>
                <?php if (!empty($userDetails) && is_array($userDetails)): ?>
                    <div class="profile-info">
                        <h1><?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                        </h1>
                        <p><?= explode(' ', $userDetails['regDate'])[0]; ?></p>
                        <p>~ <?= htmlspecialchars($userAccount['userType']); ?> ~</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <p><?= htmlspecialchars($userDetails['bio']); ?></p>
                </div>

                <div class="profile-section">
                    <h2>Profile Statistics</h2>
                    <?php if (!empty($listCounts) && is_array($listCounts)): ?>
                        <div class="stats-container">
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Reading">
                                    <h3>Reading</h3>
                                </a>
                                <p id="reading-count"><?= htmlspecialchars($listCounts[0]['reading']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Completed">
                                    <h3>Completed</h3>
                                </a>
                                <p id="completed-count"><?= htmlspecialchars($listCounts[0]['completed']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Onhold">
                                    <h3>On-Hold</h3>
                                </a>
                                <p id="onhold-count"><?= htmlspecialchars($listCounts[0]['hold']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Dropped">
                                    <h3>Dropped</h3>
                                </a>
                                <p id="dropped-count"><?= htmlspecialchars($listCounts[0]['dropped']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Planned">
                                    <h3>To Read</h3>
                                </a>
                                <p id="plan-to-read-count"><?= htmlspecialchars($listCounts[0]['planned']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Edit profile form --------------------------------------- -->
            <div class="edit-profile">
                <div class="edit-profile-container">
                    <form id="edit-profile-form" action="/Free-Write/public/User/EditProfile" method="POST"
                        onsubmit="return validateForm()">
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
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($userDetails['dob']); ?>"
                                required>
                        </div>
                        <div class="edit-profile-item">
                            <label for="country">Country</label>
                            <select type="date" id="country" name="country" required>
                                <!-- 195 main countries -->
                                <option value="">country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia (Plurinational State of)">Bolivia (Plurinational State of)
                                </option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cabo Verde">Cabo Verde</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the
                                </option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Greece">Greece</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, North">Korea, North</option>
                                <option value="Korea, South">Korea, South</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                                </option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macedonia North">Macedonia North</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                </option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey (Türkiye)">Turkey (Türkiye)</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City Holy See">Vatican City Holy See</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>

                            </select>
                        </div>
                        <div class="edit-profile-item">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                value="<?= htmlspecialchars($userAccount['email']); ?>" required>
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
                        <form action="/Free-Write/public/User/DeleteProfile" method="POST">
                            <button class="delete-account-btn" type="submit">Delete Account</button>
                        </form>
                    </div>
                    <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
                </div>
            </div>

            <div class="profile-actions">
                <button id="reportBtn" class="report-btn">Report (this button is not funcitonal yet)</button>
                <button id="profileEditBtn" class="edit-profile-btn">Edit Profile</button>
            </div>

            <div class="extra-profile-buttons">
                <?php
                switch ($userType) {
                    case 'writer':
                        require_once "../app/views/Profile/writerComponent.php";
                        break;
                    case 'covdes':
                        require_once "../app/views/Profile/covdesComponent.php";
                        break;
                    case 'wricov':
                        require_once "../app/views/Profile/writerComponent.php";
                        require_once "../app/views/Profile/covdesComponent.php";
                        break;
                    case 'inst':
                        require_once "../app/views/Profile/instComponent.php";
                        break;
                }
                ?>
            </div>
        </section>

        <?php if ($userType == 'pub'): ?>
            <section class="profile-container">
                <?= require_once "../app/views/Profile/publisherProfile.php"; ?>
            </section>
        <?php endif; ?>

        <section class="profile-container">
            <h1>My Spinoffs</h1>
            <?php if (!empty($spinoffs) && is_array($spinoffs)): ?>
                <div class="spinoff-container">
                    <?php foreach ($spinoffs as $spinoff): ?>
                        <div class="spinoff-item">
                            <div class="spinoff-content">
                                <a href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                    <h2 class="spinoff-title"><?= htmlspecialchars($spinoff['SpinoffName']); ?></h2>
                                </a>
                                <div class="spinoff-details">
                                    <p class="book-title"><?= htmlspecialchars($spinoff['BookTitle']); ?></p>
                                    <div class="spinoff-meta">
                                        <span class="chapter-count"><?= htmlspecialchars($spinoff['SpinoffChapterCount']); ?>
                                            chapters</span>
                                        <span class="access-type"><?= htmlspecialchars($spinoff['AccessType']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\profile.js"></script>

</body>

</html>