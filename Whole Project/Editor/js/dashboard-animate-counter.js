// Function to animate the number
function animateCounter(elementId, start, end, duration) {
    const element = document.getElementById(elementId);
    const range = end - start;
    const increment = range / (duration / 10);
    let current = start;
    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            current = end; // Ensure it stops at the final number
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 10);
}

// Trigger the animation
animateCounter("published-counter", 1, 25, 2500); // Animate from 1 to 25 over 2 seconds
animateCounter("download-counter", 1, 55, 2500); // Animate from 1 to 25 over 2 seconds

function MostCounterAnimation() {
    animateCounter("popup-most-counter", 1, 45, 2500); // Animate from 1 to 45 over 2.5 seconds
}

function LeastCounterAnimation() {
    animateCounter("popup-least-counter", 1, 10, 1500); // Animate from 1 to 45 over 2.5 seconds
}
