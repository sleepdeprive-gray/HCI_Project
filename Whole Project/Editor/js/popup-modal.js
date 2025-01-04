// Function to open the "Most Downloaded" popup
function openPopupMost() {
    const modal = document.getElementById("popup-modal");
    modal.style.display = "flex"; // Show the modal (centered using flexbox)
}

// Function to close the "Most Downloaded" popup
function closePopupMost() {
    const modal = document.getElementById("popup-modal");
    modal.style.display = "none"; // Hide the modal
}

// Function to open the "Least Downloaded" popup
function openPopupLeast() {
    const modal = document.getElementById("popup-modal-least");
    modal.style.display = "flex"; // Show the modal (centered using flexbox)
}

// Function to close the "Least Downloaded" popup
function closePopupLeast() {
    const modal = document.getElementById("popup-modal-least");
    modal.style.display = "none"; // Hide the modal
}

// Close the popup if the user clicks outside the content (for both modals)
window.onclick = function (event) {
    const modalMost = document.getElementById("popup-modal");
    const modalLeast = document.getElementById("popup-modal-least");
    
    if (event.target === modalMost) {
        modalMost.style.display = "none"; // Close the "Most Downloaded" modal
    } else if (event.target === modalLeast) {
        modalLeast.style.display = "none"; // Close the "Least Downloaded" modal
    }
};