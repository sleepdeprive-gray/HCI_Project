const modal = document.getElementById("addBookModal");
const btn = document.getElementById("addBookButton");
const closeModal = document.getElementById("closeModal");
const editButton = document.getElementById("editButton");
const addButton = document.getElementById("addButton");

btn.onclick = () => {
    modal.style.display = "block";
};

closeModal.onclick = () => {
    modal.style.display = "none";
};

window.onclick = (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

editButton.onclick = () => {
    modal.style.display = "none";
};

addButton.onclick = () => {
    alert("Book has been added.");
    window.location.href = "Editor-BooksOwned.html";
};