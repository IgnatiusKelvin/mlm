<h1 class="section-header">
    <div>Kelola Pertanyaan</div>
</h1>
<?php $no = 1;
$ambiltarget = $koneksi->query("SELECT * FROM target");
while ($target = $ambiltarget->fetch_assoc()) { ?>
    <div class="row mb-3">
        <div class="col-xl-12 col-md-12">
            <div class="card border-left-primary shadow py-2">
                <div class="card-body">
                    <h4 class="text-center"><?= $target['namatarget'] ?></h4>
                    <a class="btn btn-danger btn-sm mb-3" href="#" data-toggle="modal" data-target="#tambah_<?= $no ?>">Tambah Pertanyaan</a>
                    <div class="modal fade" id="tambah_<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan</h5>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <input type="text" name="idtarget" value="<?= $target['idtarget'] ?>" class="form-control" placeholder="Judul" required>
                                        <div class="form-group">
                                            <label>Pertanyaan</label>
                                            <textarea name="question" value="" class="form-control" placeholder="Pertanyaan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tautan</label>
                                            <textarea name="link" value="" class="form-control" placeholder="https://example.com" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
                                        <button type="submit" name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead class="bg-danger">
                                <tr>
                                    <th style="color: white">No</th>
                                    <th style="color: white">Judul</th>
                                    <th style="color: white">Pertanyaan</th>
                                    <th style="color: white">Tautan</th>
                                    <th style="color: white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                $ambil = $koneksi->query("SELECT * FROM question where idtarget = '$target[idtarget]'");
                                while ($data = $ambil->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $nomor ?></td>
                                        <td> Pertanyaan <?php echo $nomor ?></td>
                                        <td><?php echo $data["question"] ?></td>
                                        <td><a href="<?= $data['link'] ?>" target="_blank"><?php echo $data["link"] ?></a></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#detail_<?= $no ?>_<?= $nomor ?>" class="btn btn-primary btn-sm m-1">Lihat</a>
                                            <a href="#" data-toggle="modal" data-target="#edit_<?= $no ?>_<?= $nomor ?>" class="btn btn-warning btn-sm m-1">Ubah</a>
                                            <a href="index.php?halaman=questionhapus&id=<?php echo $data['idquestion']; ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda yakin akan menghapus pertanyaan ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit_<?= $no ?>_<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pertanyaan</h5>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idquestion" value="<?= $data['idquestion'] ?>" class="form-control" required>
                                                        <div class="form-group">
                                                            <label>Pertanyaan</label>
                                                            <textarea name="question" class="form-control" placeholder="Pertanyaan" required><?= $data['question'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tautan</label>
                                                            <textarea name="link" value="" class="form-control" placeholder="https://example.com" required><?= $data['link'] ?></textarea>
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
                                    <div class="modal fade" id="detail_<?= $no ?>_<?= $nomor ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Pertanyaan</h5>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Pertanyaan</label>
                                                            <textarea name="question" class="form-control" placeholder="Pertanyaan" readonly><?= $data['question'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tautan</label>
                                                            <textarea name="link" value="" class="form-control" placeholder="https://example.com" readonly><?= $data['link'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary tutup" data-dismiss="modal">Tutup</button>
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
<?php
    $no++;
}
?>
<?php
if (isset($_POST["tambah"])) {
    $question = $_POST['question'];
    $idtarget = $_POST['idtarget'];
    $link = $_POST['link'];
    $koneksi->query("INSERT INTO question (question, idtarget, link)
								VALUES('$question','$idtarget','$link')") or die(mysqli_error($koneksi));
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=questiondaftar';</script>";
}
if (isset($_POST['edit'])) {
    $koneksi->query("UPDATE question SET question='$_POST[question]',link='$_POST[link]' WHERE idquestion='$_POST[idquestion]'");
    echo "<script>alert('Data berhasil disimpan')</script>";
    echo "<script> location ='index.php?halaman=questiondaftar';</script>";
}
?>