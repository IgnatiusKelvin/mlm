    <style>
        div.dt-buttons {
            float: right;
            position: absolute;
            bottom: 0;
        }
    </style>
    <h1 class="section-header">
        <div>Laporan</div>
    </h1>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <h4>Presentasi</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered laporanpresentation">
                            <thead class="bg-danger">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Tanggal</th>
                                    <th style="color: white">Nama</th>
                                    <th style="color: white">ID Enterprise</th>
                                    <th style="color: white;">Presentasi</th>
                                    <th style="color: white">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                $ambil = $koneksi->query("SELECT * FROM presentation join pengguna on presentation.idpengguna = pengguna.idpengguna order by idpresentation desc");
                                while ($data = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $nomor ?></td>
                                        <td><?php echo tanggal($data["tanggal"]) ?></td>
                                        <td><?php echo $data["nama"] ?></td>
                                        <td><?php echo $data["identerprise"] ?></td>
                                        <td><?php echo $data["presentation"] ?></td>
                                        <td>
                                            <?php
                                            if ($data['keterangan'] != '') {
                                                echo '<b>' . $data["status"] . '</b><br>(' . $data['keterangan'] . ')';
                                            } else {
                                                echo '<b>' . $data["status"];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <h4>Target Pengguna</h4>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered laporanusertarget">
                                <thead class="bg-danger">
                                    <tr>
                                        <th style="color: white">No</th>
                                        <th style="color: white">Nama</th>
                                        <th style="color: white">ID Enterprise</th>
                                        <th style="color: white">ID Sponsor</th>
                                        <th style="color: white">Target Pengguna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1;
                                    $ambil = $koneksi->query("SELECT * FROM peserta left join pengguna on peserta.idpengguna = pengguna.idpengguna left join target on peserta.idtarget = target.idtarget group by peserta.idtarget") or die(mysqli_error($koneksi));
                                    while ($data = $ambil->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $nomor ?></td>
                                            <td><?php echo $data["nama"] ?></td>
                                            <td><?php echo $data["identerprise"] ?></td>
                                            <td><?php echo $data["idsponsor"] ?></td>
                                            <td><?php echo $data["namatarget"] ?></td>
                                        </tr>
                                        <div class="modal fade" id="edit<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Target Pengguna</h5>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama</label>
                                                                <input type="hidden" name="idusertarget" value="<?= $data['idusertarget'] ?>" class="form-control" readonly>
                                                                <input type="text" name="idpengguna" value="<?= $data['nama'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Target Pengguna</label>
                                                                <textarea name="usertarget" class="form-control ckeditor" placeholder="Target Pengguna" required><?= $data['usertarget'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" name="edit" value="edit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $nomor++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>