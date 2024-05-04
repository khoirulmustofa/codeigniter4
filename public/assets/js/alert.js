function alert_success(message, timer = 1000, confirm_button = true) {
    Swal.fire({
        title: app_name,
        html: Array.isArray(message) ? message.join("<br>") : message,
        icon: "success",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: confirm_button,
        timer: timer,
    });
}

function alert_warning(message, timer = 0, confirm_button = true) {
    Swal.fire({
        title: app_name,
        html: Array.isArray(message) ? message.join("<br>") : message,
        icon: "warning",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: confirm_button,
        timer: timer,
    });
}

function alert_error(message, confirm_button = true) {
    Swal.fire({
        title: app_name,
        html: Array.isArray(message) ? message.join("<br>") : message,
        icon: "error",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: confirm_button,
    });
}

function toast_success(message, timer = 1000, position = "bottom-end") {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    Toast.fire({
        icon: "success",
        html: Array.isArray(message) ? message.join("<br>") : message,
    });
}

function toast_warning(message, timer = 1000, position = "bottom-end") {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    Toast.fire({
        icon: "warning",
        html: Array.isArray(message) ? message.join("<br>") : message,
    });
}


function swal_loading() {
    Swal.fire({
        title: app_name,
        html: "Loading ...",
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        },
    });
}
