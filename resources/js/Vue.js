new Vue({
    el: '#app',
    data: {
        barang: [],
    },
    methods: {
        updateStatus(barang) {
            axios.put(`/barang/${barang.id}`, {
                kondisi: barang.kondisi === 'Sedang Di Pinjam' ? 'Tidak Di Pinjam' : 'Sedang Di Pinjam',
            }).then(() => {
                barang.kondisi = barang.kondisi === 'Sedang Di Pinjam' ? 'Tidak Di Pinjam' : 'Sedang Di Pinjam';
            });
        },
    },
});
