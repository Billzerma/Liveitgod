<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:wght@400;500;600&family=Poppins:wght@700;600;500;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/css/sewa.css">
    <link rel="shortcut icon" type="image/png" href="/Asset/liveit/landing/logo.png">
    <title>LIVEit</title>
    
</head>

<body>

<body>




<div class="form-cont  form-ukuran shadow">

    <div class="form-container">
        
        <form class="form" action="<?= base_url('user/simpanTransaksi') ?>" method="post">
            <div class="form-group">
                <label for="select">Pilih Paket Yang Akan Diambil :</label>
                <select name="id_layanan" class="form-select">
                    <?php foreach ($layanans as $layanan) : ?>
                        <option value="<?= $layanan['id_layanan']; ?>"><?= $layanan['nama_layanan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="select">Pilih Ruangan Yang Akan Tersedia Berikut :</label>
                <select name="id_ruangan" class="form-select" id="ruanganSelect" aria-label="Ruangan select example">
                    <!-- Opsi ruangan akan dimuat di sini menggunakan JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="input">Tentukan Tanggal dan Jam Akan Melakukan Reservasi</label>
                <input type="datetime-local" name="checkin" class="res">
            </div>
            <div class="form-group">
                <label for="input">Lama Sewa</label>
                <input type="datetime-local" name="checkout" class="res">
            </div>
            <div class="form-group">
                <label for="textarea"><b>BIAYA</b></label>
                <textarea required="" cols="50" rows="10" id="textarea" name="textarea" readonly class="ket"></textarea>
            </div>
            <button type="submit" class="form-submit-btn">Pesan</button>
        </form>
    </div>

</div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const layananSelect = document.querySelector('select[name="id_layanan"]');
            const ruanganSelect = document.querySelector('select[name="id_ruangan"]');
            const checkinInput = document.querySelector('input[name="checkin"]');
            const checkoutInput = document.querySelector('input[name="checkout"]');
            const biayaTextarea = document.querySelector('textarea[name="textarea"]');
            let nominalPerJam = 0;

            // Fungsi untuk menghitung selisih antara dua tanggal dalam jam
            function hitungDurasiSewa(checkin, checkout) {
                let durasi = (new Date(checkout) - new Date(checkin)) / 1000 / 60 / 60; // Hasil dalam jam
                return durasi;
            }

            layananSelect.addEventListener('change', function() {
                const layananId = this.value;
                ruanganSelect.innerHTML = ''; // Bersihkan pilihan ruangan

                // Request ke server untuk mendapatkan ruangan berdasarkan layanan terpilih
                fetch(`/user/sewa/getKetersediaanRuangan/${layananId}`)
                    .then(response => response.json())
                    .then(ruangans => {
                        ruangans.forEach(ruangan => {
                            const option = new Option(ruangan.nomor_ruangan, ruangan.id_ruangan);
                            ruanganSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error fetching ruangans:', error));

                // Request untuk mengambil nominal_perjam berdasarkan layanan yang dipilih
                fetch(`/user/sewa/getNominalPerJam/${layananId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Debugging response
                        nominalPerJam = data.nominal_perjam;
                        console.log(`Nominal per jam: ${nominalPerJam}`); // Debugging value
                    })
                    .catch(error => console.error('Error fetching nominal per jam:', error));
            });

            checkoutInput.addEventListener('change', function() {
                if (checkinInput.value && this.value && nominalPerJam) {
                    let totalJamSewa = hitungDurasiSewa(checkinInput.value, this.value);
                    let totalBiaya = parseFloat((totalJamSewa * nominalPerJam).toFixed(2)); // Ini akan menghasilkan Number
                    console.log(`Total biaya: ${totalBiaya}`); // Debugging calculation
                    biayaTextarea.value = `TOTAL JAM SEWA = ${totalJamSewa.toFixed(2)} JAM\n` +
                        `PERHITUNGAN: ${totalJamSewa.toFixed(2)} JAM X ${nominalPerJam}\n` +
                        `TOTAL = Rp.${totalBiaya}`;
                }
            });
        });
    </script>
</body>

</html>