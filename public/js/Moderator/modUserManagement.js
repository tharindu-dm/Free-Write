
        // Static time for when the query was run
        const queryRunTime = new Date();

        function updateDateTime() {
            document.getElementById('currentDate').textContent = queryRunTime.toLocaleDateString();
            document.getElementById('currentTime').textContent = queryRunTime.toLocaleTimeString();
        }

        // Fill form with the data when a row is clicked
        function fillForm(userId, email, password, userType, premium, activated, loginAttempts) {
            document.getElementById('userId').value = userId;
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            document.getElementById('userType').value = userType;
            document.getElementById('premium').value = premium;
            document.getElementById('activated').value = activated;
            document.getElementById('loginAttempts').value = loginAttempts;
        }

        // Initialize the date and time
        updateDateTime();