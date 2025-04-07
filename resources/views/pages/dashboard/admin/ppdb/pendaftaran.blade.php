@extends('layouts.dashboard.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Pendaftaran</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">SCIS</li>
                            <li class="breadcrumb-item">PPDB</li>
                            <li class="breadcrumb-item active">Form Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Main Content -->
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Formulir Pendaftaran</h4>
                            <p class="sub-title">Silakan pilih jenjang dan lengkapi formulir pendaftaran di bawah ini.</p>

                            <!-- Dropdown untuk memilih jenjang -->
                            <div class="form-group">
                                <label for="jenjang">Pilih Jenjang</label>
                                <select class="form-control" id="jenjang" name="jenjang" onchange="toggleForm()">
                                    <option value="">-- Pilih Jenjang --</option>
                                    <option value="tk">TK</option>
                                    <option value="sd">SD</option>
                                    <option value="smp">SMP</option>
                                    <option value="sma">SMA</option>
                                </select>
                            </div>

                            <!-- Form untuk TK -->
                            <form id="form-tk" style="display: none;" enctype="multipart/form-data">
                                <h5>Pendaftaran TK</h5>
                                <div class="form-group">
                                    <label>Biaya Pendaftaran</label>
                                    <input type="text" class="form-control" value="Rp. 450.000,-" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Anak</label>
                                    <input type="text" class="form-control" name="nama_anak" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Orang Tua</label>
                                    <input type="text" class="form-control" name="nama_orang_tua" required>
                                </div>
                                <div class="form-group">
                                    <label>No HP Orang Tua</label>
                                    <input type="tel" class="form-control" name="no_hp_orang_tua" required pattern="[0-9]{10,13}" placeholder="Contoh: 081234567890">
                                    <small class="text-muted">Masukkan nomor HP aktif (10-13 digit)</small>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required max="2019-08-31">
                                    <small class="text-muted">Usia minimal 4 tahun 10 bulan per 30 Juni 2025</small>
                                </div>
                                <div class="form-group">
                                    <label>Upload Kartu Keluarga (KK)</label>
                                    <input type="file" class="form-control-file" name="kk" accept=".pdf,.jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Akta Kelahiran</label>
                                    <input type="file" class="form-control-file" name="akta" accept=".pdf,.jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Pas Foto (3x4)</label>
                                    <input type="file" class="form-control-file" name="pasfoto" accept=".jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Piagam Kejuaraan (Opsional)</label>
                                    <input type="file" class="form-control-file" name="piagam" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                    <small class="text-muted">Upload bukti pembayaran biaya pendaftaran Rp. 450.000,-</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>

                            <!-- Form untuk SD -->
                            <form id="form-sd" style="display: none;" enctype="multipart/form-data">
                                <h5>Pendaftaran SD</h5>
                                <div class="form-group">
                                    <label>Biaya Pendaftaran</label>
                                    <input type="text" class="form-control" value="Rp. 450.000,-" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Anak</label>
                                    <input type="text" class="form-control" name="nama_anak" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Orang Tua</label>
                                    <input type="text" class="form-control" name="nama_orang_tua" required>
                                </div>
                                <div class="form-group">
                                    <label>No HP Orang Tua</label>
                                    <input type="tel" class="form-control" name="no_hp_orang_tua" required pattern="[0-9]{10,13}" placeholder="Contoh: 081234567890">
                                    <small class="text-muted">Masukkan nomor HP aktif (10-13 digit)</small>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required max="2019-08-31">
                                    <small class="text-muted">Usia minimal 5 tahun 10 bulan per 30 Juni 2025</small>
                                </div>
                                <div class="form-group">
                                    <label>Upload Kartu Keluarga (KK)</label>
                                    <input type="file" class="form-control-file" name="kk" accept=".pdf,.jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Akta Kelahiran</label>
                                    <input type="file" class="form-control-file" name="akta" accept=".pdf,.jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Pas Foto (3x4)</label>
                                    <input type="file" class="form-control-file" name="pasfoto" accept=".jpg,.png" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Piagam Kejuaraan (Opsional)</label>
                                    <input type="file" class="form-control-file" name="piagam" accept=".pdf,.jpg,.png">
                                </div>
                                <div class="form-group">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                    <small class="text-muted">Upload bukti pembayaran biaya pendaftaran Rp. 450.000,-</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>

                            <!-- Form untuk SMP -->
                            <form id="form-smp" style="display: none;" enctype="multipart/form-data">
                                <h5>Pendaftaran SMP</h5>
                                <div class="form-group">
                                    <label>Biaya Pendaftaran</label>
                                    <input type="text" class="form-control" value="Rp. 450.000,-" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Anak</label>
                                    <input type="text" class="form-control" name="nama_anak" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Orang Tua</label>
                                    <input type="text" class="form-control" name="nama_orang_tua" required>
                                </div>
                                <div class="form-group">
                                    <label>No HP Orang Tua</label>
                                    <input type="tel" class="form-control" name="no_hp_orang_tua" required pattern="[0-9]{10,13}" placeholder="Contoh: 081234567890">
                                    <small class="text-muted">Masukkan nomor HP aktif (10-13 digit)</small>
                                </div>
                                <div class="form-group">
                                    <label>Upload Ijazah SD (Legalisir)</label>
                                    <input type="file" class="form-control-file" name="ijazah" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Akta Kelahiran</label>
                                    <input type="file" class="form-control-file" name="akta" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Kartu Keluarga</label>
                                    <input type="file" class="form-control-file" name="kk" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Pas Foto (3x4)</label>
                                    <input type="file" class="form-control-file" name="pasfoto" accept=".jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                    <small class="text-muted">Upload bukti pembayaran biaya pendaftaran Rp. 450.000,-</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>

                            <!-- Form untuk SMA -->
                            <form id="form-sma" style="display: none;" enctype="multipart/form-data">
                                <h5>Pendaftaran SMA</h5>
                                <div class="form-group">
                                    <label>Biaya Pendaftaran</label>
                                    <input type="text" class="form-control" value="Rp. 450.000,-" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Anak</label>
                                    <input type="text" class="form-control" name="nama_anak" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap Orang Tua</label>
                                    <input type="text" class="form-control" name="nama_orang_tua" required>
                                </div>
                                <div class="form-group">
                                    <label>No HP Orang Tua</label>
                                    <input type="tel" class="form-control" name="no_hp_orang_tua" required pattern="[0-9]{10,13}" placeholder="Contoh: 081234567890">
                                    <small class="text-muted">Masukkan nomor HP aktif (10-13 digit)</small>
                                </div>
                                <div class="form-group">
                                    <label>Upload Ijazah SMP (Legalisir)</label>
                                    <input type="file" class="form-control-file" name="ijazah" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Akta Kelahiran</label>
                                    <input type="file" class="form-control-file" name="akta" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Kartu Keluarga</label>
                                    <input type="file" class="form-control-file" name="kk" accept=".pdf,.jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Pas Foto (3x4)</label>
                                    <input type="file" class="form-control-file" name="pasfoto" accept=".jpg,.png" required multiple>
                                </div>
                                <div class="form-group">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".pdf,.jpg,.png" required>
                                    <small class="text-muted">Upload bukti pembayaran biaya pendaftaran Rp. 450.000,-</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (akan di-render oleh app.blade.php) -->
                <div class="col-lg-3">
                    <!-- Sidebar sudah diatur di app.blade.php -->
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        © SCIS, 2024. All Right Reserved
    </footer>
</div>
@endsection

@section('scripts')
<script>
    // Fungsi untuk mengatur ulang form dan dropdown
    function resetForm() {
        var jenjang = document.getElementById('jenjang');
        jenjang.value = ''; // Mengatur dropdown kembali ke "-- Pilih Jenjang --"
        document.getElementById('form-tk').style.display = 'none';
        document.getElementById('form-sd').style.display = 'none';
        document.getElementById('form-smp').style.display = 'none';
        document.getElementById('form-sma').style.display = 'none';
    }

    // Fungsi untuk menampilkan form berdasarkan pilihan jenjang
    function toggleForm() {
        var jenjang = document.getElementById('jenjang').value;
        document.getElementById('form-tk').style.display = jenjang === 'tk' ? 'block' : 'none';
        document.getElementById('form-sd').style.display = jenjang === 'sd' ? 'block' : 'none';
        document.getElementById('form-smp').style.display = jenjang === 'smp' ? 'block' : 'none';
        document.getElementById('form-sma').style.display = jenjang === 'sma' ? 'block' : 'none';
    }

    // Jalankan resetForm saat halaman dimuat ulang
    document.addEventListener('DOMContentLoaded', function() {
        resetForm();
    });
</script>
@endsection
