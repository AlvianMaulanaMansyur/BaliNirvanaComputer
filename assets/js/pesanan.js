function confirmUpdateOrder(orderId, orderStatus) {
	// Pengecekan status pesanan
	if (orderStatus == 1) {
		Swal.fire({
			title: "Pesanan Sudah Lunas",
			text: "Pesanan ini sudah lunas dan tidak dapat diubah lagi.",
			icon: "info",
			confirmButtonColor: "#3085d6",
			confirmButtonText: "OK",
		});
		return;
	}

	// Konfirmasi untuk pesanan yang belum lunas
	Swal.fire({
        title: "Update Order?",
        text: "Apakah Anda yakin ingin mengupdate pesanan ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, update!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, send AJAX request to updateOrder endpoint
            $.ajax({
                url: base_url + "dashboard/updateOrder/" + orderId,
                type: "POST",
                dataType: "JSON",
                success: function (response) {
                    if (response.berhasil) {
                        Swal.fire({
                            title: "Sukses!",
                            text: response.message,
                            icon: "success",
                        }).then(() => {
                            window.location.href = base_url + "dashboard/orders";
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error",
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan saat mengupdate pesanan.",
                        icon: "error",
                    });
                },
            });
        }
    });
    
}
