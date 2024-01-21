$(document).ready(function () {
	// Handle form submission using AJAX
	$("#form-tambah-kota").submit(function (e) {
		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (response) {
				console.log("Formulir berhasil dikirim!", response);

				if (response === "add-kota-success") {
					// SweetAlert for success
					Swal.fire({
						title: "Sukses!",
						text: "Data kota berhasil ditambahkan.",
						icon: "success",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					}).then((result) => {
						if (result.isConfirmed) {
							// $('#tambahKategoriModal').modal('hide');
							window.location.href = base_url + "dashboard/kota";
						}
					});
				} else {
					Swal.fire({
						title: "Gagal!",
						text: "Gagal menambahkan data kota.",
						icon: "error",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					});
				}
			},
			error: function (error) {
				console.error("Terjadi kesalahan saat mengirim formulir", error);
				console.log(error.responseText);

				// SweetAlert for failure
				Swal.fire({
					title: "Gagal!",
					text: "Gagal menambahkan data kota.",
					icon: "error",
					confirmButtonColor: "#3085d6",
					confirmButtonText: "OK",
				});
			},
		});
	});

	$('form[id^="form-edit-kota"]').submit(function (e) {
		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (response) {
				console.log("Formulir berhasil dikirim!", response);

				if (response === "edit-kota-success") {
					// SweetAlert for success
					Swal.fire({
						title: "Sukses!",
						text: "Data berhasil diedit.",
						icon: "success",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = base_url + "dashboard/kota";
						}
					});
				} else if (response === "edit-kota-failed") {
					Swal.fire({
						title: "Gagal!",
						text: "Gagal mengedit data.",
						icon: "error",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					});
				}
			},
			error: function (error) {
				console.error("Terjadi kesalahan saat mengirim formulir", error);
				console.log(error.responseText);

				Swal.fire({
					title: "Gagal!",
					text: "Gagal sistem.",
					icon: "error",
					confirmButtonColor: "#3085d6",
					confirmButtonText: "OK",
				});
			},
		});
	});
});

// Handle click on delete button
$(".delete-kota").on("click", function (e) {
	e.preventDefault();

	var kotaId = $(this).data("id");
	var kotaName = $(this).data("name");

	Swal.fire({
		title: "Hapus Kota?",
		text:
			"Anda yakin ingin menghapus kota '" +
			kotaName +
			"'?, maka akan menghapus semua kecamatan yang berkaitan!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Ya, hapus!",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.isConfirmed) {
			// Redirect to delete endpoint
			window.location.href = base_url + "dashboard/deletekota/" + kotaId;
		}
	});
});
