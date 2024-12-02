<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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

    //show($data);
    ?>
    <main>
        <div class="user-profile-container">
            <div class="user-profile-sidebar">
                <div class="user-profile-header">
                    <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                        alt="Profile Picture" class="user-profile-picture">
                    <div class="follower-stats">
                        <span>Followers 250</span>
                        <span>Following 100</span>
                    </div>
                    <h2 style="color: var(--black);">
                        <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                    </h2>

                    <div class="user-profile-details">
                        <div class="user-profile-actions">
                            <?php if ($userAccount['userID'] == $_SESSION['user_id']): ?>
                                <button id="profileEditBtn" class="edit-profile-btn">Edit Profile</button>

                            <?php endif; ?>
                            <?php if ($userAccount['userID'] != $_SESSION['user_id']): ?>
                                <button id="reportBtn" class="report-profile-btn">Report</button>
                            <?php endif; ?>
                        </div>
                        <p>
                            <strong>Birthday:</strong>
                            <?= date('M d', strtotime($userDetails['dob'])); ?>
                        </p>
                        <p>
                            <strong>Country:</strong>
                            <?= htmlspecialchars($userDetails['country']); ?>
                        </p>
                        <p>
                            <strong>Joined:</strong>
                            <?= date('M d, Y', strtotime($userDetails['regDate'])); ?>
                        </p>
                    </div>
                </div>

                <hr class="user-profile-divider">
                <div class="user-profile-navigation">
                    <button class="user-nav-button active" data-view="dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </button>
                    <?php if ($userType != 'pub' && $userType != 'inst'): ?>
                        <button class="user-nav-button" data-view="spinoffs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            My Spin-offs
                        </button>
                        <?php if ($userAccount['userID'] == $_SESSION['user_id']): ?>
                            <button class="user-nav-button" data-view="purchased-books">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                Purchased Books
                            </button>
                            <button class="user-nav-button" data-view="orders">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                My Orders
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="user-profile-content">
                <div id="dashboard" class="view-section active">
                    <h2>Dashboard</h2>
                    <!-- Existing stats -->
                    <div class="dashboard-stats">
                        <div class="stat-card">
                            <h3>About</h3>
                            <p><?= htmlspecialchars($userDetails['bio']) ?></p>
                        </div>
                    </div>

                    <!-- My Book List Section -->
                    <div class="my-book-list">
                        <h3>My Book List</h3>
                        <div class="book-list-stats">
                            <a href="/Free-Write/public/BookList/Reading">
                                <div class="book-list-item">
                                    <span class="book-list-label">Reading</span>
                                    <span
                                        class="book-list-count"><?= htmlspecialchars($listCounts[0]['reading']) ?></span>
                                </div>
                            </a>
                            <a href="/Free-Write/public/BookList/Completed">
                                <div class="book-list-item">
                                    <span class="book-list-label">Completed</span>
                                    <span
                                        class="book-list-count"><?= htmlspecialchars($listCounts[0]['completed']) ?></span>
                                </div>
                            </a>
                            <a href="/Free-Write/public/BookList/Onhold">
                                <div class="book-list-item">
                                    <span class="book-list-label">On Hold</span>
                                    <span class="book-list-count"><?= htmlspecialchars($listCounts[0]['hold']) ?></span>
                                </div>
                            </a>
                            <a href="/Free-Write/public/BookList/Dropped">
                                <div class="book-list-item">
                                    <span class="book-list-label">Dropped</span>
                                    <span
                                        class="book-list-count"><?= htmlspecialchars($listCounts[0]['dropped']) ?></span>
                                </div>
                            </a>
                            <a href="/Free-Write/public/BookList/Planned">
                                <div class="book-list-item">
                                    <span class="book-list-label">To Read</span>
                                    <span
                                        class="book-list-count"><?= htmlspecialchars($listCounts[0]['planned']) ?></span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- My Book Collections Section -->
                    <div class="my-book-collections">
                        <h3>My Book Collections</h3>
                        <!-- Add book collection items here -->
                        <div class="collection-item">
                            <span>Favorite Sci-Fi</span>
                            <span>5 Books</span>
                        </div>
                        <div class="collection-item">
                            <span>Romance Reads</span>
                            <span>3 Books</span>
                        </div>
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
                    <div>
                        <?php if ($userType == 'pub'): ?>
                            <section class="profile-container">
                                <?= require_once "../app/views/Profile/publisherProfile.php"; ?>
                            </section>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="spinoffs" class="view-section">
                    <h2>My Spin-offs</h2>
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
                                                    <span
                                                        class="access-type"><?= htmlspecialchars($spinoff['AccessType']); ?></span>
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

                <div id="purchased-books" class="view-section">
                    <h2>Purchased Books</h2>
                    <?php if (!empty($purchasedBooks)): ?>
                        <?php foreach ($purchasedBooks as $book): ?>
                            <div class="book-item">
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image']); ?>"
                                    alt="Book Cover">
                                <div class="book-details">
                                    <h3><?= htmlspecialchars($book['title']); ?></h3>
                                    <p>Author: <?= htmlspecialchars($book['author']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No purchased books.</p>
                    <?php endif; ?>
                </div>

                <div id="orders" class="view-section">
                    <h2>My Orders</h2>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="order-item">
                                <p>Order #<?= htmlspecialchars($order['orderID']); ?></p>
                                <p>Date: <?= htmlspecialchars($order['orderDate']); ?></p>
                                <p>Total: $<?= number_format($order['total'], 2); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No orders yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <!-- Edit profile form --------------------------------------- -->
    <div class="edit-profile">
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
                        <input type="file" id="profileImage" name="profileImage" accept="image/*">
                    </label>
                </div>

                <div class="edit-profile-item">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($userDetails['dob']); ?>">
                </div>
                <div class="edit-profile-item">
                    <label for="country">Country</label>
                    <select type="date" id="country" name="country">
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
                <form action="/Free-Write/public/User/DeleteProfile" method="POST">
                    <button class="delete-account-btn" type="submit">Delete Account</button>
                </form>
            </div>
            <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
        </div>
    </div>

    <script src="/Free-Write/public/js/profile.js"></script>
    <script>
        //handle navigation button clicks
        document.querySelectorAll(".user-nav-button").forEach((button) => {
            button.addEventListener("click", () => {
                // Remove active class from all buttons and sections
                document
                    .querySelectorAll(".user-nav-button")
                    .forEach((btn) => btn.classList.remove("active"));
                document
                    .querySelectorAll(".view-section")
                    .forEach((section) => section.classList.remove("active"));

                // Add active class to clicked button and corresponding section
                button.classList.add("active");
                document.getElementById(button.dataset.view).classList.add("active");
            });
        });
    </script>
</body>

</html>