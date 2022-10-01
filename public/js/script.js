$(document).ready(function () {
  $('#search-btn').click(function () {
    const keyword = $('#search-keyword').val();
    window.location.href = 'index.php?search=' + keyword;
  });

  $('#search-keyword').keypress(function (e) {
    if (e.key == 'Enter') {
      const keyword = $('#search-keyword').val();
      window.location.href = 'index.php?search=' + keyword;
    }
  });

  $('#search-keyword').on('keyup', function () {
    const keyword = $('#search-keyword').val();
    $('#data-container').load('ajax/search.php?keyword=' + keyword);
  });

  let fileName = $('#file-name').text();
  console.log(fileName);
  console.log(fileName.length);

  if (fileName.length > 38) {
    fileName = fileName.slice(0, 38) + '...';
    $('#file-name').text(fileName);
  }

  $('#file-img').change(function () {
    fileName = $(this)[0].files[0].name;
    if (fileName.length > 38) {
      fileName = fileName.slice(0, 38) + '...';
    }
    $('#file-name').text(fileName);
  });
});
