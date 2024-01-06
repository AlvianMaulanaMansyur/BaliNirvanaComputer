// $(document).ready(function() {
//     // Handle click on delete button
//     $('.delete-product-item').on('click', function(e) {
//         e.preventDefault();

//         var productId = $(this).data('id');
//         var productName = $(this).data('name');

//         Swal.fire({
//             title: "Hapus Produk?",
//             text: "Anda yakin ingin menghapus produk '" + productName + "'?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#d33",
//             cancelButtonColor: "#3085d6",
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Batal"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Redirect to delete endpoint
//                 window.location.href = deleteEndpoint + productId;
//             }
//         });
//     });

//     // Check if errorMessage is defined
//     if (typeof errorMessage !== 'undefined') {
//         Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: errorMessage
//         });
//     }

//     // Check if successAddMessage is defined
//     if (typeof successAddMessage !== 'undefined') {
//         Swal.fire({
//             title: 'Sukses!',
//             text: successAddMessage,
//             icon: 'success',
//             confirmButtonText: 'OK'
//         });
//     }

//     // Check if successEditMessage and editedProductId are defined
//     if (typeof successEditMessage !== 'undefined' && typeof editedProductId !== 'undefined') {
//         Swal.fire({
//             title: 'Sukses!',
//             text: successEditMessage,
//             icon: 'success',
//             confirmButtonText: 'OK'
//         }).then(() => {
//             // Redirect to the edited product
//             window.location.href = base_url+'dashboard/edit/' + editedProductId;
//         });
//     }
// });
