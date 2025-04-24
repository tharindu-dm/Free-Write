<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply for an advertisement on Free Write">
    <title>Apply for Advertisement</title>
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #1C160C;
        }

        .form-container h4 {
            color: #c47c15;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1C160C;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #FFD700;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #FCFAF5;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #FFD052;
            box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
        }

        button {
            padding: 1rem 1.5rem;
            margin-right: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .submit-btn {
            background-color: #FFD052;
            color: #1C160C;
        }

        .submit-btn:hover {
            background-color: #E0B94A;
        }

        .cancel-btn {
            background-color: #c47c15;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #7A6F50;
        }

        .ad-type-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .ad-type-option {
            border: 2px solid #FFD700;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .ad-type-option:hover {
            background-color: #FFF8E0;
        }

        .ad-type-option.selected {
            background-color: #FFD052;
            border-color: #E0B94A;
        }

        .ad-type-option h3 {
            margin: 0.5rem 0;
            color: #1C160C;
        }

        .ad-type-option p {
            color: #c47c15;
            font-size: 0.9rem;
        }

        .ad-type-option .price {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 0.5rem;
            color: #1C160C;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
            display: none;
        }

        .availability-info {
            background-color: #FFF8E0;
            border-left: 4px solid #FFD052;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0 8px 8px 0;
        }

        .availability-info h4 {
            color: #c47c15;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .availability-info p {
            margin: 0.5rem 0;
            color: #1C160C;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1rem;
            }

            button {
                width: 100%;
                margin: 0.5rem 0;
            }

            .ad-type-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    // Ensure session is started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Determine user type
    $userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'guest';

    // Include appropriate header based on user type
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
    ?>

    <main>
    <?php if(!isset($adDetails) || empty($adDetails)): ?>

        <div class="form-container">
            <h1>Apply for Advertisement</h1>
            <h4>Submit your ad details to promote your work or service</h4>

            <?php if (isset($latestEndDate)): ?>
                <div class="availability-info">
                    <h4>Advertisement Slot Availability</h4>
                    <?php if ($latestEndDate): ?>
                        <p>Our advertisement slots are currently booked until <strong><?= date('F j, Y', strtotime($latestEndDate)) ?></strong>.</p>
                        <p>You can schedule your advertisement to start after this date for the best visibility.</p>
                    <?php else: ?>
                        <p>Good news! All advertisement slots are currently available. Book now for maximum exposure!</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div id="form_error" class="error-message"></div>

            <form action="/Free-Write/public/Publisher/ApplyAdvertisement" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label for="ad_title">Advertisement Title</label>
                <input type="text" maxlength="60" id="ad_title" name="ad_title" placeholder="Enter a catchy title for your advertisement" required />
                <div id="ad_title_error" class="error-message"></div>

                <label>Advertisement Type</label>
                <div class="ad-type-container">
                    <div class="ad-type-option" onclick="selectAdType('sidebar')">
                        <h3>Writer Page Ad</h3>
                        <p>Displayed on page sides</p>
                        <p>300×250 pixels</p>
                        <div class="price">$149/month</div>
                        <input type="radio" name="ad_type" value="sidebar" id="sidebar_type" style="display: none;" required />
                    </div>
                </div>
                <div id="ad_type_error" class="error-message"></div>

                <h4></h4>

                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required />
                <div id="start_date_error" class="error-message"></div>

                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required />
                <div id="end_date_error" class="error-message"></div>

                <div class="form-field">
                    <label for="ad_image">Advertisement Image</label>
                    <input type="file" id="ad_image" name="ad_image" accept="image/*" required />
                    <p class="description">JPG or PNG, 2MB max. Size depends on ad type selected.</p>
                    <div id="ad_image_error" class="error-message"></div>
                </div>

                <label for="contact_email">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" placeholder="Where we can reach you" required />
                <div id="contact_email_error" class="error-message"></div>

                <button type="submit" class="submit-btn">Submit Advertisement</button>
                <button type="button" class="cancel-btn" onclick="location.href='/Free-Write/public/Advertisement/'">Cancel</button>
            </form>
        </div>
        <?php else: ?>
            <div class="form-container">
            <h1>Renew for Advertisement</h1>
            <h4>Submit your ad details to promote your work or service</h4>

            <?php if (isset($latestEndDate)): ?>
                <div class="availability-info">
                    <h4>Advertisement Slot Availability</h4>
                    <?php if ($latestEndDate): ?>
                        <p>Our advertisement slots are currently booked until <strong><?= date('F j, Y', strtotime($latestEndDate)) ?></strong>.</p>
                        <p>You can schedule your advertisement to start after this date for the best visibility.</p>
                    <?php else: ?>
                        <p>Good news! All advertisement slots are currently available. Book now for maximum exposure!</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div id="form_error" class="error-message"></div>

            <form action="/Free-Write/public/Publisher/RenewAdvertisement" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="adID" id="deleteAdID" value="<?=htmlspecialchars(string: $adDetails['adID']) ?>">

                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required />
                <div id="start_date_error" class="error-message"></div>

                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required />
                <div id="end_date_error" class="error-message"></div>


                <button type="submit" class="submit-btn">Submit Advertisement</button>
                <button type="button" class="cancel-btn" onclick="location.href='/Free-Write/public/Advertisement/'">Cancel</button>
            </form>
        </div>
        <?php endif; ?>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        // Select advertisement type
        function selectAdType(type) {
            document.querySelectorAll('.ad-type-option').forEach(element => {
                element.classList.remove('selected');
            });
            const selectedOption = document.querySelector(`.ad-type-option:has(#${type}_type)`);
            selectedOption.classList.add('selected');
            document.getElementById(`${type}_type`).checked = true;
            document.getElementById('ad_type_error').style.display = 'none';
        }

        // Validate form
        function validateForm() {
            let isValid = true;
            const errorMessages = {
                adTitle: document.getElementById('ad_title_error'),
                adType: document.getElementById('ad_type_error'),
                startDate: document.getElementById('start_date_error'),
                endDate: document.getElementById('end_date_error'),
                adImage: document.getElementById('ad_image_error'),
                contactEmail: document.getElementById('contact_email_error')
            };

            // Reset error messages
            Object.values(errorMessages).forEach(elem => {
                elem.style.display = 'none';
            });

            // Title validation
            const adTitle = document.getElementById('ad_title').value;
            if (adTitle.length < 5) {
                errorMessages.adTitle.textContent = 'Advertisement title must be at least 5 characters';
                errorMessages.adTitle.style.display = 'block';
                isValid = false;
            }

            // Ad type validation
            const adTypeSelected = document.querySelector('input[name="ad_type"]:checked');
            if (!adTypeSelected) {
                errorMessages.adType.textContent = 'Please select an advertisement type';
                errorMessages.adType.style.display = 'block';
                isValid = false;
            }

            // Date validations
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (startDate < today) {
                errorMessages.startDate.textContent = 'Start date cannot be in the past';
                errorMessages.startDate.style.display = 'block';
                isValid = false;
            }

            if (endDate <= startDate) {
                errorMessages.endDate.textContent = 'End date must be after start date';
                errorMessages.endDate.style.display = 'block';
                isValid = false;
            }

            const maxDate = new Date(startDate);
            maxDate.setDate(maxDate.getDate() + 7);
            if (endDate > maxDate) {
                errorMessages.endDate.textContent = 'End date cannot be more than 7 days after start date';
                errorMessages.endDate.style.display = 'block';
                isValid = false;
            }

            // Image validation
            const adImage = document.getElementById('ad_image');
            if (adImage.files.length === 0) {
                errorMessages.adImage.textContent = 'Please upload an advertisement image';
                errorMessages.adImage.style.display = 'block';
                isValid = false;
            } else if (adImage.files[0].size > 2 * 1024 * 1024) {
                errorMessages.adImage.textContent = 'Image size cannot exceed 2MB';
                errorMessages.adImage.style.display = 'block';
                isValid = false;
            }

            // Email validation
            const contactEmail = document.getElementById('contact_email').value;
            if (!contactEmail.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                errorMessages.contactEmail.textContent = 'Please enter a valid email address';
                errorMessages.contactEmail.style.display = 'block';
                isValid = false;
            }

            return isValid;
        }

        // Set minimum date for start date
        <?php if (isset($latestEndDate) && $latestEndDate): ?>
            // Create a date object from the latest end date
            const latestEndDate = new Date('<?= $latestEndDate ?>');
            // Add one day to the latest end date
            latestEndDate.setDate(latestEndDate.getDate() + 1);
            // Format the date to YYYY-MM-DD for the input min attribute
            const minStartDate = latestEndDate.toISOString().split('T')[0];
            document.getElementById('start_date').setAttribute('min', minStartDate);
        <?php else: ?>
            // If no latest end date, use today as minimum
            const today = new Date();
            const todayFormatted = today.toISOString().split('T')[0];
            document.getElementById('start_date').setAttribute('min', todayFormatted);
        <?php endif; ?>

        // Update end date constraints
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            if (startDate) {
                const maxDate = new Date(startDate);
                maxDate.setDate(maxDate.getDate() + 7);
                const maxDateFormatted = maxDate.toISOString().split('T')[0];
                const endDateInput = document.getElementById('end_date');
                endDateInput.setAttribute('min', this.value);
                endDateInput.setAttribute('max', maxDateFormatted);
                const endDate = new Date(endDateInput.value);
                if (endDate < startDate || endDate > maxDate) {
                    endDateInput.value = '';
                }
            }
        });

        // Real-time validation
        document.getElementById('ad_title').addEventListener('input', function() {
            const errorElem = document.getElementById('ad_title_error');
            if (this.value.length < 5) {
                errorElem.textContent = 'Advertisement title must be at least 5 characters';
                errorElem.style.display = 'block';
            } else {
                errorElem.style.display = 'none';
            }
        });

        document.getElementById('contact_email').addEventListener('input', function() {
            const errorElem = document.getElementById('contact_email_error');
            if (!this.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                errorElem.textContent = 'Please enter a valid email address';
                errorElem.style.display = 'block';
            } else {
                errorElem.style.display = 'none';
            }
        });

        document.getElementById('ad_image').addEventListener('change', function() {
            const errorElem = document.getElementById('ad_image_error');
            if (this.files.length > 0 && this.files[0].size > 2 * 1024 * 1024) {
                errorElem.textContent = 'Image size cannot exceed 2MB';
                errorElem.style.display = 'block';
            } else {
                errorElem.style.display = 'none';
            }
        });

        document.getElementById('end_date').addEventListener('input', function() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(this.value);
            const errorElem = document.getElementById('end_date_error');
            if (endDate <= startDate) {
                errorElem.textContent = 'End date must be after start date';
                errorElem.style.display = 'block';
            } else {
                const maxDate = new Date(startDate);
                maxDate.setDate(maxDate.getDate() + 7);
                if (endDate > maxDate) {
                    errorElem.textContent = 'End date cannot be more than 7 days after start date';
                    errorElem.style.display = 'block';
                } else {
                    errorElem.style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>