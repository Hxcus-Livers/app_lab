// Ketika user submit form request barang
function submitRequest() {
    // Kirim data request ke server
    const data = {
        nama: $("nama").val(), // Ganti selector dengan ID/nama element input nama
        email: $("email").val(), // Ganti selector dengan ID/nama element input email
        barang: $("item_name").val(), // Ganti selector dengan ID/nama element input barang
        jumlah: $("quantity").val(), // Ganti selector dengan ID/nama element input jumlah
    };

    $.ajax({
        url: "/api/request-barang",
        method: "POST",
        data: data,
        success: function (response) {
            console.log("Data request berhasil dikirim!");
            // Kirim notifikasi FCM ke admin
            const notification = {
                title: "Permintaan Barang Baru",
                body: "Sebuah permintaan barang baru telah diajukan.",
                data: {
                    type: "request_barang",
                    requestId: response.id, // Ganti dengan ID request dari response server
                },
            };

            firebase
                .messaging()
                .send(
                    notification,
                    "AAAAKwH1jzY:APA91bG5HMhglUdJgtirNBIt-xOdkh5abOCctj-iHlcvxnSYmGSaekvdycE_bXWgxvLYTGEdzxHY2Xx-mhRXdSz3XrBHIbKdxpnHff61Gr06bsQysp26Hqdwn3yZVlBSHEAZN7HlrnJW"
                ); // Ganti dengan key server FCM Anda
        },
        error: function (error) {
            console.error(
                "Terjadi kesalahan saat mengirim data request:",
                error
            );
        },
    });
}
