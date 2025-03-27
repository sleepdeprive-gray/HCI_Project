document.addEventListener("DOMContentLoaded", function () {
    const addBookButton = document.getElementById("addBookButton");
    const addBookModal = document.getElementById("addBookModal");
    const closeModal = document.getElementById("closeModal");
    const confirmAddButton = document.getElementById("confirmAddButton");
    const editButton = document.getElementById("editButton");

    // Form fields
    const titleInput = document.getElementById("title");
    const authorInput = document.getElementById("authorname");
    const genreSelect = document.getElementById("genre");
    const descriptionInput = document.getElementById("description");
    const languageSelect = document.getElementById("language");
    const datePublishedInput = document.getElementById("date-published");
    const frontCoverInput = document.getElementById("front-upload");
    const backCoverInput = document.getElementById("back-upload");
    const bookFileInput = document.getElementById("book-file-upload");
    const authorPhotoInput = document.getElementById("author-upload");

    // Modal elements
    const modalTitle = document.getElementById("modal-title");
    const modalAuthor = document.getElementById("modal-author");
    const modalGenre = document.getElementById("modal-genre");
    const modalFrontCover = document.getElementById("modal-front-cover");
    const modalBackCover = document.getElementById("modal-back-cover");

    // Debugging: Check if elements are found
    console.log("Modal Front Cover:", modalFrontCover);
    console.log("Modal Back Cover:", modalBackCover);

    // Function to validate file types
    function validateFileType(input, allowedTypes, errorMessage) {
        if (input.files.length > 0) {
            const file = input.files[0];
            const fileType = file.type;
            if (!allowedTypes.includes(fileType)) {
                alert(errorMessage);
                input.value = ""; // Clear the input field
                return false;
            }
        }
        return true;
    }

    // Function to validate required fields
    function validateForm() {
        if (!titleInput.value.trim()) {
            alert("Title is required.");
            return false;
        }
        if (!authorInput.value.trim()) {
            alert("Author name is required.");
            return false;
        }
        if (!genreSelect.value) {
            alert("Genre is required.");
            return false;
        }
        if (!descriptionInput.value.trim()) {
            alert("Description is required.");
            return false;
        }
        if (!languageSelect.value) {
            alert("Language is required.");
            return false;
        }
        if (!datePublishedInput.value) {
            alert("Date published is required.");
            return false;
        }
        if (!frontCoverInput.files.length) {
            alert("Front cover image is required.");
            return false;
        }
        if (!backCoverInput.files.length) {
            alert("Back cover image is required.");
            return false;
        }
        if (!bookFileInput.files.length) {
            alert("Book file (PDF) is required.");
            return false;
        }
        if (!authorPhotoInput.files.length) {
            alert("Author photo is required.");
            return false;
        }

        // Validate file types
        if (!validateFileType(frontCoverInput, ["image/png", "image/jpeg", "image/jpg"], "Front cover must be a PNG, JPG, or JPEG file.")) return false;
        if (!validateFileType(backCoverInput, ["image/png", "image/jpeg", "image/jpg"], "Back cover must be a PNG, JPG, or JPEG file.")) return false;
        if (!validateFileType(authorPhotoInput, ["image/png", "image/jpeg", "image/jpg"], "Author picture must be a PNG, JPG, or JPEG file.")) return false;
        if (!validateFileType(bookFileInput, ["application/pdf"], "Book file must be a PDF.")) return false;

        return true;
    }

    // Open modal and populate data only if form is valid
    addBookButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent form submission for now

        if (!validateForm()) {
            return; // Stop if validation fails
        }

        // Populate modal with entered values
        modalGenre.textContent = genreSelect.value;
        modalTitle.textContent = titleInput.value.trim();
        modalAuthor.textContent = authorInput.value.trim();

        // Check if front/back cover elements exist before setting src
        if (modalFrontCover && frontCoverInput.files.length) {
            modalFrontCover.src = URL.createObjectURL(frontCoverInput.files[0]);
        } else {
            console.warn("Front cover element not found or file not selected.");
        }

        if (modalBackCover && backCoverInput.files.length) {
            modalBackCover.src = URL.createObjectURL(backCoverInput.files[0]);
        } else {
            console.warn("Back cover element not found or file not selected.");
        }

        // Show modal
        addBookModal.style.display = "block";
    });

    // Close modal
    closeModal.addEventListener("click", function () {
        addBookModal.style.display = "none";
    });

    // Edit button - close modal and allow changes
    editButton.addEventListener("click", function () {
        addBookModal.style.display = "none";
    });

    // Confirm Add Book - Submit the form
    addButton.addEventListener("click", function () {
        document.getElementById("addBookForm").submit();
    });

    // Close modal when clicking outside content
    window.addEventListener("click", function (event) {
        if (event.target === addBookModal) {
            addBookModal.style.display = "none";
        }
    });
});