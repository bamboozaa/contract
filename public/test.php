<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form id="registrationForm" class="needs-validation" novalidate>
                            <!-- Personal Information -->
                            <h5 class="mb-3">Personal Information</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                    <div class="invalid-feedback">
                                        Please provide your first name.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                    <div class="invalid-feedback">
                                        Please provide your last name.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailAddress" required>
                                <div class="invalid-feedback">
                                    Please provide a valid email address.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phoneNumber">
                                <div class="form-text">Optional</div>
                            </div>

                            <!-- Account Information -->
                            <h5 class="mb-3 mt-4">Account Information</h5>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="username" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">
                                    Password is required.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                                <div class="invalid-feedback">
                                    Please confirm your password.
                                </div>
                            </div>

                            <!-- Address -->
                            <h5 class="mb-3 mt-4">Address</h5>

                            <div class="mb-3">
                                <label for="address" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="address" required>
                                <div class="invalid-feedback">
                                    Please provide your street address.
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" required>
                                    <div class="invalid-feedback">
                                        Please provide your city.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" required>
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <!-- Add all states here -->
                                        <option value="WY">Wyoming</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a state.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="zipCode" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zipCode" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>

                            <!-- Preferences -->
                            <h5 class="mb-3 mt-4">Preferences</h5>

                            <div class="mb-3">
                                <label class="form-label">Interests</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="technology" id="techCheck">
                                    <label class="form-check-label" for="techCheck">
                                        Technology
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="sports" id="sportsCheck">
                                    <label class="form-check-label" for="sportsCheck">
                                        Sports
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="music" id="musicCheck">
                                    <label class="form-check-label" for="musicCheck">
                                        Music
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="travel" id="travelCheck">
                                    <label class="form-check-label" for="travelCheck">
                                        Travel
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">How did you hear about us?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="referralSource" id="searchEngine" value="searchEngine" required>
                                    <label class="form-check-label" for="searchEngine">
                                        Search Engine
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="referralSource" id="socialMedia" value="socialMedia">
                                    <label class="form-check-label" for="socialMedia">
                                        Social Media
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="referralSource" id="friendReferal" value="friendReferal">
                                    <label class="form-check-label" for="friendReferal">
                                        Friend Referral
                                    </label>
                                </div>
                                <div class="invalid-feedback">
                                    Please select one option.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="comments" class="form-label">Additional Comments</label>
                                <textarea class="form-control" id="comments" rows="3"></textarea>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">I agree to the Terms and Conditions</label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Form Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            // Form is valid, you can submit data or handle it here
                            event.preventDefault()
                            alert('Form submitted successfully!')
                            // You would typically send the form data to your server here
                            // using fetch or another AJAX method
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
