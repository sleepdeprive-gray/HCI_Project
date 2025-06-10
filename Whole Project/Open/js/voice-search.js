const micIcon = document.getElementById('mic');
const searchInput = document.getElementById('searchInput');

// Check if browser supports SpeechRecognition
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (SpeechRecognition) {
  const recognition = new SpeechRecognition();
  recognition.lang = 'en-US';
  recognition.interimResults = false;
  recognition.maxAlternatives = 1;

  micIcon.addEventListener('click', () => {
    recognition.start();
  });

  recognition.addEventListener('result', (event) => {
    const voiceText = event.results[0][0].transcript;
    searchInput.value = voiceText;
    searchInput.form.submit(); // Submit form automatically
  });

  recognition.addEventListener('error', (event) => {
    console.error('Speech recognition error:', event.error);
  });
} else {
  micIcon.style.display = 'none';
  console.warn('Speech Recognition API not supported in this browser.');
}
