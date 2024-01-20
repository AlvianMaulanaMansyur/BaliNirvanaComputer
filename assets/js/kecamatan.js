$(document).ready(function () {
	// Handle form submission using AJAX
	$("#form-tambah-kecamatan").submit(function (e) {
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

				if (response === "add-kecamatan-success") {
					// SweetAlert for success
					Swal.fire({
						title: "Sukses!",
						text: "Data berhasil ditambahkan.",
						icon: "success",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = base_url + "dashboard/kecamatan";
						}
					});
				} else {
					Swal.fire({
						title: "Gagal!",
						text: "Gagal menambahkan data.",
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
					text: "Gagal menambahkan data.",
					icon: "error",
					confirmButtonColor: "#3085d6",
					confirmButtonText: "OK",
				});
			},
		});
	});

	$('form[id^="form-edit-kecamatan"]').submit(function (e) {
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

				if (response === "edit-kecamatan-success") {
					// SweetAlert for success
					Swal.fire({
						title: "Sukses!",
						text: "Data berhasil ditambahkan.",
						icon: "success",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = base_url + "dashboard/kecamatan";
						}
					});
				} else if (response === "edit-kecamatan-failed") {
					Swal.fire({
						title: "Gagal!",
						text: "Gagal menambahkan data.",
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
					text: "Gagal menambahkan data.",
					icon: "error",
					confirmButtonColor: "#3085d6",
					confirmButtonText: "OK",
				});
			},
		});
	});
});

$(".delete-kecamatan").on("click", function (e) {
	e.preventDefault();

	var kecamatanId = $(this).data("id");
	var kecamatanName = $(this).data("name");

	Swal.fire({
		title: "Hapus Kecamatan?",
		text: "Anda yakin ingin menghapus kecamatan '" + kecamatanName + "'?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Ya, hapus!",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.isConfirmed) {
			// Redirect to delete endpoint
			window.location.href = base_url + 'dashboard/deletekecamatan/' + kecamatanId;
		}
	});
});
