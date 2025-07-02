
<style>
	.legend-dot {
		display: inline-block;
		height: 12px;
		width: 12px;
		border-radius: 50%;
		margin-right: 6px;
	}
	.legend-item {
		margin-right: 20px;
		display: inline-flex;
		align-items: center;
		font-size: 14px;
	}

	.tr-ketua td {
        background-color: #6ECB63 !important;
        color: #000 !important;
    }

    .tr-sekretaris td {
        background-color: #FFD966 !important;
        color: #000 !important;
    }

	.table-warning * {
		color: #000 !important;
	}
	.table-success * {
		color: #000 !important;
	}

</style>

<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3><?=$title?></h3>
					<p class="text-subtitle text-muted">Anda dapat melihat <?=$title?> di bawah</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>

		<?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <a href="<?php echo base_url('mobil/tambah_mobil/')?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i>
                            Tambah</button></a>

                        <a href="<?= base_url('mobil/dihapus_mobil') ?>">
                           <button class="btn btn-secondary mt-2">Data Mobil yang Dihapus</button>
                        </a>
                    </div>
                </div>

            <div class="card-body">
                <div class="mb-3">
						<div class="legend-item"><span class="legend-dot" style="background-color:#6ECB63;"></span> Tersedia</div>
						<div class="legend-item"><span class="legend-dot" style="background-color:#FFD966;"></span> Terjual</div>
					</div>

                <div class="table-responsive">
                    <table class="table table-striped" id="table-mobil">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Kode/Plat</th>
                                <th>Harga</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $no=1; foreach ($a as $b) {
                        ?>
                            <tr class="<?= $b->status == 'Tersedia' ? 'tr-ketua' : ($b->status == 'Terjual' ? 'tr-sekretaris' : '') ?>">
                                <td><?php echo $no++ ?></td>
                                <td><img src="<?= base_url('uploads/mobil/' . $b->foto_mobil) ?>" width="100"></td>
                                <td><?php echo $b->nama_mobil?> </td>
                                <td>
                                    <?= $b->kode_mobil ?><br>
                                    <?= $b->plat_mobil ?>
                                </td>
                                <td>Rp <?= number_format($b->harga_mobil, 0, ',', '.') ?></td>
                                <td><?php echo $b->tanggal_masuk?> </td>
                                <td><?= $b->tanggal_keluar ?? '-' ?></td>
                                <td><?php echo $b->stok?> </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalKeterangan<?= $b->id_mobil ?>">
                                        Lihat
                                    </button>

                                    <div class="modal fade" id="modalKeterangan<?= $b->id_mobil ?>" tabindex="-1" aria-labelledby="labelKeterangan<?= $b->id_mobil ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="labelKeterangan<?= $b->id_mobil ?>">Keterangan Mobil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= esc($b->keterangan) ?: '<span class="text-muted">Tidak ada keterangan.</span>' ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item text-info" href="<?= base_url('mobil/detail_mobil/' . $b->id_mobil) ?>">
                                                    <i class="fa-solid fa-info me-1"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning" href="<?= base_url('mobil/edit_mobil/' . $b->id_mobil) ?>">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="<?= base_url('mobil/delete_mobil/' . $b->id_mobil) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

<script>
	$(document).ready(function() {
		$('#table-mobil').DataTable({
		});
	});
</script>