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
animateCounter("published-counter", 1, 25, 1500); // Animate from 1 to 25 over 2 seconds
animateCounter("download-counter", 1, 25, 3000); // Animate from 1 to 25 over 2 seconds