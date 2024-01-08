function confirmUpdateOrder(orderId, orderStatus) {
    // Pengecekan status pesanan
    if (orderStatus == 1) {
        Swal.fire({
            title: "Pesanan Sudah Lunas",
            text: "Pesanan ini sudah lunas dan tidak dapat diubah lagi.",
            icon: "info",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
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
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke halaman updateOrder jika konfirmasi diterima
            window.location.href = base_url + 'dashboard/updateOrder/' + orderId;
        }
    }).catch((error) => {
        // If there is an error, display the error message using SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.responseJSON.message, // Assuming the server sends an error message
        });
    });
    
}