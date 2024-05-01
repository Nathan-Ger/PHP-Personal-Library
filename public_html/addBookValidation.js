/* addBookValidation.js
* @author Nathanael Germain
*
* This file is used to validate the addBook form.
*/
// This function checks to make sure no fields are empty, if not returns an error message.
function validate(form) {
    fail = validateISBN(form.ISBN.value)
    fail += validateTitle(form.title.value)
    fail += validateBookNumber(form.bookNumber.value)
    fail += validatePubName(form.publisherName.value)
    fail += validateFormatName(form.formatName.value)
    fail += validateYear(form.year.value)
    fail += validateHaveRead(form.haveRead.value)

    if (fail == "") return true
    else {
        alert(fail);
        return false
    }
}

/* validateISBN(ISBN)
* This function checks the ISBN field to make sure it is not empty, is 13 characters long,
* and only contains characters 0-9.
*
* @param ISBN The ISBN field from the form.
* @return A string containing an error message if the ISBN is invalid, otherwise an empty string.
*/
function validateISBN(ISBN) {
    const ISBN_LENGTH = 13;

    if (ISBN == "")
        return "No ISBN was entered.\n"
    else if (ISBN.length != ISBN_LENGTH)
        return "ISBN must be 13 characters.\n"
    else if (/[^0-9]/.test(ISBN))
        return "Only 0-9 allowed in ISBN.\n"
    return ""
}

/* validateTitle(title)
* This function checks the Title field to make sure it is not empty.
*
* @param title The title field from the form.
* @return A string containing an error message if the title is invalid, otherwise an empty string.
*/
function validateTitle(title) {
    if (title == "")
        return "No Title was entered.\n"
    return ""
}

/* validateBookNumber(bookNumber)
* This function checks the Book Number field to make sure it is not empty,
* and only contains characters 0-9.
*
* @param bookNumber The book number field from the form.
* @return A string containing an error message if the book number is invalid, otherwise an empty string.
*/
function validateBookNumber(bookNumber) {
    if (bookNumber == "")
        return "No Book Number was entered.\n"
    else if (/[^0-9]/.test(bookNumber))
        return "Only 0-9 allowed in Book Number.\n"
    return ""
}

/* validatePubName(publisherName)
* This function checks the Publisher Name field to make sure it is not empty.
*
* @param publisherName The publisher name field from the form.
* @return A string containing an error message if the publisher name is invalid, otherwise an empty string.
*/
function validatePubName(publisherName) {
    if (publisherName == "")
        return "No Publisher Name was entered.\n"
    return ""
}

/* validateFormatName(formatName)
* This function checks the Format Name field to make sure it is not empty.
*
* @param formatName The format name field from the form.
* @return A string containing an error message if the format name is invalid, otherwise an empty string.
*/
function validateFormatName(formatName) {
    if (formatName == "")
        return "No Format Name was entered.\n"
    return ""
}

/* validateYear(year)
* This function checks the Year field to make sure it is not empty, is 4 characters long,
* and only contains characters 0-9.
*
* @param tear The year field from the form.
* @return A string containing an error message if the year is invalid, otherwise an empty string.
*/
function validateYear(year) {
    const YEAR_LENGTH = 4;

    if (year == "")
        return "No Year was entered.\n"
    else if (year.length != YEAR_LENGTH)
        return "Year must be 4 characters.\n"
    else if (/[^0-9]/.test(year))
        return "Only 0-9 allowed in Year.\n"
    return ""
}

/* validateHaveRead(haveRead)
* This function checks the Have Read field to make sure it is not empty, and only contains
* characters y, n, t, f, 1, 0, true, or false. These are all the possible ways to say yes or no.
* This is case insensitive. We only tell the user to use Yes or No, but we accept other variations
* for convenience.
*
* @param haveRead The have read field from the form.
* @return A string containing an error message if the have read is invalid, otherwise an empty string.
*/
function validateHaveRead(haveRead) {
    if (haveRead == "")
        return "No Have Read was entered.\n"

    // Convert to lowercase for comparison
    haveRead - haveRead.toLowerCase();

    if (haveRead != "yes" && haveRead != "no"
        && haveRead != "true" && haveRead != "false"
        && haveRead != "1" && haveRead != "0"
        && haveRead != "y" && haveRead != "n"
        && haveRead != "t" && haveRead != "f")
        return "Only Yes or No allowed in Have Read.\n"
    return ""
}