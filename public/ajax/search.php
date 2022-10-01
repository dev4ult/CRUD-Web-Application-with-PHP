<?php

require '../functions.php';

$key = $_GET['keyword'];

$selected_mhs = query_select("SELECT * FROM mahasiswa WHERE
    nama LIKE '%$key%' OR
    nim LIKE '%$key%' OR
    email LIKE '%$key%' OR
    jurusan LIKE '%$key%' LIMIT 5");

?>
<?php $list_num = 1;foreach ($selected_mhs as $mhs): ?>
<tr>
    <td class="rounded-none">
        <div class="flex items-center space-x-3">
            <div class="avatar">
                <div class="mask mask-squircle w-12 h-12">
                    <img src="./img/pfp/<?=$mhs['gambar']?>" alt="<?=$mhs['nama']?> profile pic">
                </div>
            </div>
            <div>
                <div class="font-bold"><?=$mhs['nama']?></div>
                <div class="text-sm opacity-50"><?=$mhs['email']?></div>
            </div>
        </div>
    </td>
    <td>
        <?=$mhs['jurusan']?>
        <br />
        <span class="badge badge-ghost badge-sm"><?=$mhs['nim']?></span>
    </td>
    <th class="rounded-none">
        <a href="detail.php?data-id=<?=$mhs['id']?>" class="btn btn-ghost btn-xs">details</a>
    </th>
</tr>
<?php $list_num++;endforeach?>