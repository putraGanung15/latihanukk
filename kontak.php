<?php
include 'header.php';
?>

<div class="container" style="margin-top:60px; margin-bottom:100px;">
    <h2 class="text-center"
        style="font-weight:bold; color:#28a745; border-bottom:4px solid #28a745; display:inline-block; padding-bottom:8px;">
        Kontak & Bantuan
    </h2>

    <div class="row mt-5">
    >
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm" style="border-radius:15px; border:none;">
                <div class="card-body">
                    <h4 style="color:#28a745; margin-bottom:20px;">Kirim Pesan</h4>
                    <form method="post" action="proses_kontak.php">

                    
                        <div class="form-group mb-3">
                            <label><strong>Nama:</strong></label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Masukkan nama Anda" required>
                        </div>

                    
                        <div class="form-group mb-3">
                            <label><strong>Kelas / Jurusan:</strong></label>
                            <select name="kelas" class="form-control" required>
                                <option value=""> Pilih Jurusan </option>
                                <option value="Tata Busana">Tata Busana</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Kuliner">Kuliner</option>
                                <option value="Perhotelan">Perhotelan</option>
                            </select>
                        </div>

                       
                        <div class="form-group mb-3">
                            <label><strong>Metode Kontak:</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode" id="viaEmail" value="email"
                                    checked>
                                <label class="form-check-label" for="viaEmail">Email</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode" id="viaHP" value="hp">
                                <label class="form-check-label" for="viaHP">No. HP</label>
                            </div>
                        </div>

                        
                        <div class="form-group mb-4">
                            <label id="labelKontak"><strong>Email:</strong></label>
                            <input type="email" name="kontak" id="kontakInput" class="form-control"
                                placeholder="Masukkan email Anda" required>
                        </div>

                        
                        <div class="form-group mb-4">
                            <label><strong>Pesan:</strong></label>
                            <textarea name="pesan" class="form-control" rows="5"
                                placeholder="Tulis pesan Anda..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-block"
                            style="border-radius:25px; padding:10px; font-weight:600;">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control {
    border-radius: 12px;
    border: 1px solid #28a745;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-success:hover {
    background-color: #19692c;
}
</style>

<script>
const viaEmail = document.getElementById('viaEmail');
const viaHP = document.getElementById('viaHP');
const kontakInput = document.getElementById('kontakInput');
const labelKontak = document.getElementById('labelKontak');

viaEmail.addEventListener('change', () => {
    if (viaEmail.checked) {
        kontakInput.type = 'email';
        kontakInput.placeholder = 'Masukkan email Anda';
        labelKontak.innerHTML = '<strong>Email:</strong>';
    }
});

viaHP.addEventListener('change', () => {
    if (viaHP.checked) {
        kontakInput.type = 'text';
        kontakInput.placeholder = 'Masukkan No. HP Anda';
        labelKontak.innerHTML = '<strong>No. HP:</strong>';
    }
});
</script>

<?php include 'footer.php'; ?>
