function show_modal(modal_id = "modal_1", html, size = "") {
    // Membuat instance modal
    const modal = new bootstrap.Modal(document.getElementById(modal_id), {
        backdrop: "static",
        focus: false,
        keyboard: false,
    });

    // Menambahkan class size ke elemen dengan class modal-dialog
    if (size != "") {
        const modal_dialog = document.querySelector(
            `#${modal_id} .modal-dialog`
        );
        modal_dialog.classList.add(size);
    }

    const html_dialog = $(`#${modal_id} .modal-dialog`);
    html_dialog.html(html);

    modal.show();
}

function close_modal(modal_id = "modal_1") {
    // Mengambil instance modal
    const modal = bootstrap.Modal.getInstance(
        document.getElementById(modal_id)
    );

    // Menutup modal jika instance ada
    if (modal) {
        modal.hide();
    }
}

function set_modal_form(url, modal_id = "modal_1", size = "") {
    swal_loading();
    $.ajax({
        url: url,
        type: "GET",
        contentType: "application/json",
        success: function (response) {
            Swal.close();
            if (response.success) {
                show_modal(modal_id, response.data.html, size);
            } else {
                alert_warning(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Request failed:", status, error);
        },
    });
}

function submit_form_post(form_id = "form_id", url = "", is_alert = true) {
    $(`#${form_id}`).submit(function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();        
        swal_loading();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,         
            data: $(this).serialize(),
            success: function (response) {
                // set_csrf(response.data.csrf_token);
                document.querySelector('meta[name="csrf-token"]').setAttribute('content', response.data.csrf_token);
                Swal.close();
                if (response.success) {
                    reload_datatable();
                    if (is_alert) {
                        alert_success(response.message);
                    } else {
                        toast_success(response.message);
                    }
                } else {
                    alert_warning(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });
}

function submit_form_get(form_id = "form_id", url = "", is_alert = true) {
    $(`#${form_id}`).submit(function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        swal_loading();
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: function (response) {
                Swal.close();
                if (response.success) {
                    reload_datatable();
                    if (is_alert) {
                        alert_success(response.message);
                    } else {
                        toast_success(response.message);
                    }
                } else {
                    alert_warning(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });
}

function reload_datatable(table_id = table_1) {
    $(`#${table_id}`).DataTable().ajax.reload(null, false);
}
