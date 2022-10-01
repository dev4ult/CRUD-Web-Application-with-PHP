<?php

require '../functions.php';

$key = $_GET['keyword'];

$selected_mhs = query_select("SELECT * FROM mahasiswa WHERE nama LIKE '%" . $key . "%' OR nim LIKE '%" . $key . "%' OR email LIKE '%" . $key . "%' OR jurusan LIKE '%" . $key . "%'");

?>

<?php $list_num = 1;foreach ($selected_mhs as $mhs): ?>
<tr>
    <th><?=$list_num?></th>
    <td><img src="./img/pfp/<?=$mhs['gambar']?>" alt="<?=$mhs['nama']?> profile pic" class="w-20 h-20 object-cover">
    </td>
    <td><?=$mhs['nama']?></td>
    <td><?=$mhs['email']?></td>
    <td><?=$mhs['nim']?></td>
    <td><?=$mhs['jurusan']?></td>
    <td>
        <a href="detail.php?data-id=<?=$mhs['id']?>" class="btn btn-info btn-sm text-white">Edit</a>
    </td>
</tr>
<?php $list_num++;endforeach?>