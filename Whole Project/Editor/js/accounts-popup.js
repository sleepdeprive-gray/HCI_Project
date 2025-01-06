// Get the buttons
var btn1 = document.getElementById("openModal1");
var btn2 = document.getElementById("openModal2");
var btn3 = document.getElementById("openModal3");

// Get the modals
var modal1 = document.getElementById("modal1");
var modal2 = document.getElementById("modal2");
var modal3 = document.getElementById("modal3");

// Get the close buttons
var close1 = document.getElementById("closeModal1");
var close2 = document.getElementById("closeModal2");
var close3 = document.getElementById("closeModal3");

// Open modals on button click
btn1.onclick = function () {
    modal1.style.display = "block";
};
btn2.onclick = function () {
    modal2.style.display = "block";
};
btn3.onclick = function () {
    modal3.style.display = "block";
};

// Close modals on close button click
close1.onclick = function () {
    modal1.style.display = "none";
};
close2.onclick = function () {
    modal2.style.display = "none";
};
close3.onclick = function () {
    modal3.style.display = "none";
};

// Close modals on clicking outside
window.onclick = function (event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
};
