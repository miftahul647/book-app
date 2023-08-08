<?php 
require "../function/init.php";

$id_book = get('id');
$data = query_select('variabel', ['where' => "id_book = '$id_book'"]);
$pertanyaan = arrayWhere('pertanyaan_monev', "id_variabel");

?>

<?php 
$no = 1;
foreach ($data as $item): ?>

	<tr>
		<td><?= $no++ ?></td>
		<td style="width: 50%;">
			<?= $item['nama_variabel'] ?>
		</td>

	<td>
		<div class="dropdown d-inline">
			<button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
			</button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="#" onclick="handleShowModalEdit(<?= $item['id_variabel'] ?>, '<?= $item['nama_variabel'] ?>')" data-bs-toggle="modal" data-bs-target="#editVariabel">Edit</a></li>
				<li><a class="dropdown-item" href="#" onclick="handleShowModalHapus(<?= $item['id_variabel'] ?>)" data-bs-toggle="modal" data-bs-target="#hapusVariabel">Hapus</a></li>
			</ul>
		</div>
		<a href="monev.php?id_variabel=<?= $item['id_variabel'] ?>&id_book=<?= $id_book ?>" class="btn btn-primary btn-sm">Pertanyaan Monev</a>
	</td>

<?php endforeach; ?>



<tr>
	<td></td>
	<td colspan="3">
		<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahVariabel">+</button>
	</td>
</tr>