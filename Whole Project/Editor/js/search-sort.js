document.addEventListener('DOMContentLoaded', () => {
    const micIcon = document.getElementById('mic-icon');
    const searchField = document.getElementById('searchbar-field');
    const searchForm = document.getElementById('search-form');
    const searchIcon = document.getElementById('search-icon');
    const orderDropdown = document.getElementById('order-dropdown');
    const sortDropdown = document.getElementById('sort-type-dropdown');
    const orderHidden = document.getElementById('order-hidden');
    const sortHidden = document.getElementById('sort-hidden');

    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';

        micIcon.addEventListener('click', () => recognition.start());

        recognition.onresult = function (event) {
            const transcript = event.results[0][0].transcript.toLowerCase().trim();

            // Handle voice genre navigation
            if (transcript.startsWith("go to ")) {
                const genre = transcript.replace("go to ", "").trim();

                const genreRoutes = {
                    "science": "Editor-Books-Science.php",
                    "novel": "Book_Category/Editor-Books-Novel.php",
                    "mystery": "Book_Category/Editor-Books-Mystery.php",
                    "narrative": "Book_Category/Editor-Books-Narrative.php",
                    "fiction": "Book_Category/Editor-Books-Fiction.php",
                    "fantasy": "Book_Category/Editor-Books-Fantasy.php",
                    "horror": "Book_Category/Editor-Books-Horror.php",
                    "history": "Book_Category/Editor-Books-History.php"
                    // Add more if needed
                };

                if (genre in genreRoutes) {
                    window.location.href = genreRoutes[genre];
                    return; // Stop further execution
                } else {
                    alert(`Genre "${genre}" not found.`);
                    return;
                }
            }

            // Otherwise, treat as a search
            searchField.value = transcript;
            orderHidden.value = orderDropdown.value;
            sortHidden.value = sortDropdown.value;
            searchForm.submit();
        };
    } else {
        micIcon.style.display = "none";
    }

    // Search icon click
    searchIcon.addEventListener('click', () => {
        orderHidden.value = orderDropdown.value;
        sortHidden.value = sortDropdown.value;
        searchForm.submit();
    });

    // Dropdown change handling
    function updateURLParams() {
        const params = new URLSearchParams(window.location.search);
        if (searchField.value) params.set("search", searchField.value);
        params.set("order", orderDropdown.value);
        params.set("sort", sortDropdown.value);
        window.location.search = params.toString();
    }

    orderDropdown.addEventListener("change", updateURLParams);
    sortDropdown.addEventListener("change", updateURLParams);
});