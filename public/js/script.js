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
});
