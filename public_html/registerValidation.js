/* registerValidation.js
* @author Nathanael Germain
*
* This file is used to validate the registration form.
*/
// This function checks to make sure no fields are empty, if not returns an error message.
function validate(form) {
    fail = validateUsername(form.username.value)
    fail += validatePassword(form.password.value)
    fail += validateEmail(form.email.value)
    fail += validateConfirmPassword(form.password.value, form.confirmPassword.value)

    if (fail == "") return true
    else {
        alert(fail);
        return false
    }
}

/* validateUsername(username)
* This function checks the username field to make sure it is not empty, is at least 6 characters long,
* and only contains characters a-z, A-Z, 0-9, - and _.
*
* @param username The username field from the form.
* @return A string containing an error message if the username is invalid, otherwise an empty string.
*/
function validateUsername(username) {
    if (username == "")
        return "No Username was entered.\n"
    else if (username.length < 6)
        return "Usernames must be at least 6 characters.\n"
    else if (/[^a-zA-Z0-9_-]/.test(username))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
    return ""
}

/* validatePassword(password)
* This function checks the password field to make sure it is not empty, is at least 8 characters long,
* contains at least one lowercase letter, one uppercase letter, and one number.
*
* @param password The password field from the form.
* @return A string containing an error message if the password is invalid, otherwise an empty string.
*/
function validatePassword(password) {
    if (password == "")
        return "No Password was entered.\n"
    else if (password.length < 8)
        return "Passwords must be at least 8 characters.\n"
    else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password))
        return "Passwords require one each of a-z, A-Z and 0-9.\n"
    return ""
}

/* validateConfirmPassword(password, confirmPassword)
* This function checks the confirm password field to make sure it matches the password field.
*
* @param password The password field from the form.
* @param confirmPassword The confirm password field from the form.
* @return A string containing an error message if the passwords do not match, otherwise an empty string.
*/
function validateConfirmPassword(password, confirmPassword) {
    if (password != confirmPassword)
        return "Passwords do not match.\n"
    return ""
}

/* validateUsername(username)
* This function checks the email field to make sure it is not empty, contains an @ and a ., and only contains
* characters a-z, A-Z, 0-9, ., @, - and _.
*
* @param username The username field from the form.
* @return A string containing an error message if the username is invalid, otherwise an empty string.
*/
function validateEmail(email) {
    if (email == "") return "No Email was entered.\n"
    else if (!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(email))
        return "The Email address is invalid.\n"
    return ""
}

// /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}/.test(email))
/*
* I attempted to create a regex to validate email addresses, but in the end I could not get it to work
* properly. I decided to use the above method instead, but will continue to try and get it to work.
*
* In theory it should do the below
*
* 1. Check for a-z, A-Z, 0-9, ., _, - before an @ symbole
* 2. Then check to make sure there is an @ symbol
* 3. Then, again check for a-z, A-Z, 0-9, ., _, - before a . symbol
* 4. Then check for a . symbol
* 5. Finally, check for a-z, A-Z with at least 2 characters after the . symbol
*/