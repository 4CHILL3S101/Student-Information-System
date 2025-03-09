
export function showAlert(response) {
    let title, text, icon;

    // Check the response message and set the alert properties accordingly
    if (response.success) {
        title = "Success!";
        text = response.message || 'Operation was successful!';
        icon = 'success';
    } else {
        title = "Error!";
        text = response.message || 'Something went wrong.';
        icon = 'error';
    }

    // Display SweetAlert based on the above information
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'OK'
    });
}
