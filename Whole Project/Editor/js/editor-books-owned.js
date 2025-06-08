document.addEventListener("DOMContentLoaded", () => {
    const micIcon = document.getElementById("mic-icon");
    const searchField = document.getElementById("searchbar-field");
    const sortDropdown = document.getElementById("sorting-dropdown");
    const tbody = document.querySelector("tbody");
    const noResultsRow = document.getElementById("no-results");

    // 🎤 Microphone Feature using Web Speech API
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en-US';
        recognition.interimResults = false;

        micIcon.addEventListener("click", (e) => {
            e.preventDefault();
            recognition.start();
        });

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            searchField.value = transcript;
            filterTable(transcript.toLowerCase());
        };
    } else {
        micIcon.style.display = "none";
    }

    // 🔍 Search as you type
    searchField.addEventListener("input", () => {
        filterTable(searchField.value.toLowerCase());
    });

    // 🔃 Sort Feature
    sortDropdown.addEventListener("change", () => {
        const value = sortDropdown.value;
        // Grab fresh rows every time before sorting to get updated order
        const rowsArray = Array.from(tbody.querySelectorAll("tr")).filter(row => row.id !== "no-results");

        const sortedRows = rowsArray.sort((a, b) => {
            if (value === "az") {
                return a.children[0].textContent.localeCompare(b.children[0].textContent);
            } else if (value === "upload_date" || value === "date_published") {
                // Date is in the 2nd or 3rd column depending on sort
                const index = value === "upload_date" ? 2 : 1;
                const aDate = new Date(a.children[index].textContent);
                const bDate = new Date(b.children[index].textContent);
                return bDate - aDate; // Descending order
            }
            return 0;
        });

        tbody.innerHTML = "";
        sortedRows.forEach(row => tbody.appendChild(row));

        // After sorting, apply current search filter again
        filterTable(searchField.value.toLowerCase());
    });

    function filterTable(query) {
        const rows = Array.from(tbody.querySelectorAll("tr")).filter(row => row.id !== "no-results");
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.children[0].textContent.toLowerCase();
            const datePublished = row.children[1].textContent.toLowerCase();
            const uploadDate = row.children[2].textContent.toLowerCase();
            const status = row.children[3].textContent.toLowerCase();

            const match =
                title.includes(query) ||
                datePublished.includes(query) ||
                uploadDate.includes(query) ||
                status.includes(query);

            row.style.display = match ? "" : "none";

            if (match) visibleCount++;
        });

        noResultsRow.style.display = visibleCount === 0 ? "" : "none";
    }
});