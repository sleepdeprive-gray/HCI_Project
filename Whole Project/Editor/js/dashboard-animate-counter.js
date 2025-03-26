document.addEventListener("DOMContentLoaded", function () {
    // Ensure the elements exist before animating
    if (document.getElementById("published-counter")) {
        animateCounter("published-counter", 1, totalBooks, 2500);
    }

    if (document.getElementById("download-counter")) {
        animateCounter("download-counter", 1, totalDownloads, 2500);
    }
});

// Function to animate the counter
function animateCounter(elementId, start, end, duration) {
    const element = document.getElementById(elementId);
    if (!element) return; // Prevent errors if the element is missing

    const range = end - start;
    const increment = range / (duration / 10);
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            current = end; // Stop exactly at the final number
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 10);
}

// Function to trigger when opening popups
function MostCounterAnimation() {
    animateCounter("popup-most-counter", 1, $mostDownloads, 2500);
}

function LeastCounterAnimation() {
    animateCounter("popup-least-counter", 1, $leastDownloads, 1500);
};