function rejects(locations) {
   
        window.location.href = locations;
   
}

function archive(locations) {
    let userResponse = confirm('This will put the book in Archive, Do you want to proceed?');

    // Check the user's response
    if (userResponse) {
        window.location.href = locations;
    } else {
        console.log('User clicked Cancel!');
    }
}

function deletes(locations) {
    let userResponse = confirm('This will put the book in Archive, Do you want to proceed?');

    // Check the user's response
    if (userResponse) {
        window.location.href = locations;
    } else {
        console.log('User clicked Cancel!');
    }
}

