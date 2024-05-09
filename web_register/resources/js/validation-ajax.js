// The popup functions
function openPopupWithData(title, data) {
    var popup = document.getElementById("popup");
    var popupTitle = popup.querySelector("h2");
    var popupMessage = popup.querySelector("p");

    popupTitle.textContent = title;

    var actors = data.split(/[0-9]+\.\s+/).filter(Boolean);
    var i = 1;

    var list = "<div class='list-now'>";
    actors.forEach(function(actor) {
        list += i + ". "+ actor + "<br>";
        i++;
    });
    list += "</div>";

    popupMessage.innerHTML = list;

    popup.style.display = "block";
}

function openPopupWithDataReg(title, message) {
    var popup = document.getElementById("popup");
    var popupTitle = popup.querySelector("h2");
    var popupMessage = popup.querySelector("p");

    popupTitle.textContent = title;
    popupMessage.textContent = message;

    popup.style.display = "block";
}

function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

function openPopup(title, message) {
    openPopupWithData(title, message);
}
///////////////////////////////////////////////////////////////////////////////////////////

$(function () {
    $("#actors-butt").on("click", function(event) {
        event.preventDefault();

        let birthdate = $("#birthdate").val();

        var token = $('meta[name="csrf-token"]').attr('content');

        // Retrieve the route URL from the data attribute
        var actorsRoute = $("#actorsRoute").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: actorsRoute, // Use the correct route here
            data: {
                birthdate: birthdate
            },
            dataType: 'json',
            beforeSend: function() {
                $("#actors-butt").prop('disabled', true);
            },
            success: function(response) {
                console.log(response);
                // Check if response contains actor names
                if (response) {
                    openPopupWithData("Actors Names", response);
                } else {
                    alert('Actors Names Failed to get');
                }
            },
            error: function(xhr, status, error) {
                // Error callback function
                console.error(xhr.responseText);
                alert('Error occurred while fetching actor names. Please try again.');
            }
        });
    });

    // Add event listener to close the popup in the blade file
    $(".close").on("click", function() {
        closePopup();
    });
});


$(function () {
    $("#submit-butt").on("click", function(event) {
        event.preventDefault();

        // Create a new FormData object to handle file uploads
        var formData = new FormData();
        // formData.append('_token', token);
        formData.append('fname', $("#fname").val());
        formData.append('name', $("#name").val());
        formData.append('birthdate', $("#birthdate").val());
        formData.append('phone', $("#phone").val());
        formData.append('address', $("#address").val());
        formData.append('password', $("#password").val());
        formData.append('confirm-password', $("#confirm-password").val()); // Corrected ID
        formData.append('email', $("#email").val());
        formData.append('photo', $('#photo')[0].files[0]); // Append the file data

        var strongPasswordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

        // Clear previous error messages
        $(".error").remove();

        // Flag to track if any field is has errors
        var hasErrors = false;

        // Check each field for emptiness
        if ($("#fname").val() === "") {
            $("#fname").after('<span class="error">Please enter your full name</span>');
            hasErrors = true;
        }
        if ($("#name").val() === "") {
            $("#name").after('<span class="error">Please enter a user name</span>');
            hasErrors = true;
        }
        if ($("#birthdate").val() === "") {
            $("#birthdate").after('<span class="error">Please enter your birthdate</span>');
            hasErrors = true;
        }
        if ($("#phone").val() === "") {
            $("#phone").after('<span class="error">Please enter your phone number</span>');
            hasErrors = true;
        }
        else if (!$("#phone").val().match(/^(011|012|010|015)\d{8}$/)) {
            $("#phone").after('<span class="error">Please enter a valid phone number (e.g., 01125443179)</span>');
            hasErrors = true;
        }
        if ($("#address").val() === "") {
            $("#address").after('<span class="error">Please enter your address</span>');
            hasErrors = true;
        }
        if ($("#password").val() === "") {
            $("#password").after('<span class="error">Please enter a password</span>');
            hasErrors = true;
        }
        if ($("#confirm-password").val() === "") {
            $("#confirm-password").after('<span class="error">Please confirm your password</span>');
            hasErrors = true;
        }
        if ($("#email").val() === "") {
            $("#email").after('<span class="error">Please enter your email</span>');
            hasErrors = true;
        }
        else if (!$("#email").val().match(/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/)) {
            $("#email").after('<span class="error">Please enter a valid email address</span>');
            hasErrors = true;
        }

        // Check if passwords match
        if ($("#confirm-password").val() !== $("#password").val() && $("#confirm-password").val() !== "") {
            $("#confirm-password").after('<span class="error">Passwords do not match</span>');
            hasErrors = true;
        }
        else if (!$("#password").val().match(strongPasswordRegex) && $("#password").val() !== "") {
            $("#password").after('<span class="error">Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character</span>');
            hasErrors = true;
        }

        if(hasErrors) {
            return;
        }

        var token = $('meta[name="csrf-token"]').attr('content');

        // Retrieve the route URL from the data attribute
        var registerRoute = $("#registerRoute").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: registerRoute,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $("#submit-butt").prop('disabled', true);
            },
            success: function(response) {
                // Success callback function
                if (response.success) {
                    // If registration successful, do something (e.g., show success message)
                    var message = response.success;
                    openPopupWithDataReg("Registration Status", message);
                } else {
                    // If registration failed, show error message
                    alert('Registration failed. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                // Error callback function
                // Display error message if username is already taken
                var responseText = JSON.parse(xhr.responseText);
                if (responseText.errors && responseText.errors.name) {
                    openPopupWithDataReg("Registration Status", "Username already exists");
                } else {
                    alert('Error occurred while registering. Please try again .');
                }
            }
        });
    });

    // Add event listener to close the popup in the blade file
    $(".close").on("click", function() {
        closePopup();
    });
});
