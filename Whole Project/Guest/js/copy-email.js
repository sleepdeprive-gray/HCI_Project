function copyToClipboard() {
    var emailField = document.getElementById('email');
    emailField.select(); // Select the text in the input field
    emailField.setSelectionRange(0, 99999); // For mobile devices

    document.execCommand("copy"); // Copy the selected text to the clipboard

    alert("Email copied to clipboard: " + emailField.value); // Optional: Show a message to the user
}
