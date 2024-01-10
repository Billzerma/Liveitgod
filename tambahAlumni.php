<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <h4>Form Tambah Data Alumni</h4>

    <?= form_open('alumniSave', ['enctype' => 'multipart/form-data']); ?>

    <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>

    <?php if (session()->has('err')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session('err'); ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-2">
            <!-- Image preview container -->
            <div id="image-preview">
                <img src="<?= base_url('Asset/alumniCSSJS/gambar/Anggota/default.png') ?>"
                    class="img-thumbnail img-preview" alt="Preview">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text"
                    class="form-control <?= (isset($validation) && $validation->hasError('nama')) ? 'is-invalid' : ''; ?>"
                    id="nama" name="nama" value="<?= old('nama'); ?>">
                <?php if (isset($validation) && $validation->hasError('nama')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="tahun_lulus">Tahun Lulus</label>
                <input type="text"
                    class="form-control <?= (isset($validation) && $validation->hasError('tahun_lulus')) ? 'is-invalid' : ''; ?>"
                    id="tahun_lulus" name="tahun_lulus" value="<?= old('tahun_lulus'); ?>">
                <?php if (isset($validation) && $validation->hasError('tahun_lulus')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('tahun_lulus'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text"
                    class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                    id="email" name="email" value="<?= old('email'); ?>">
                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="sampul_profile">Sampul</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="sampul_profile" name="sampul_profile"
                        onchange="previewImg(this)">
                    <label class="custom-file-label" for="sampul_profile">Pilih Gambar</label>
                </div>
                <?php if (isset($validation) && $validation->hasError('sampul_profile')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('sampul_profile'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <?= form_close(); ?>
</div>


<?= $this->endSection(); ?>