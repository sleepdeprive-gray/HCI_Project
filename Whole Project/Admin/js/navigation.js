function rejects(locations) {
            let userResponse = confirm('Do you want to proceed?');

        // Check the user's response
        if (userResponse) {
        window.location.href = locations;
        } else {
        console.log('User clicked Cancel!');
        }
        }

        function archive(locations) {
            let userResponse = confirm('Do you want to proceed?');

        // Check the user's response
        if (userResponse) {
        window.location.href = locations;
        } else {
        console.log('User clicked Cancel!');
        }
        }