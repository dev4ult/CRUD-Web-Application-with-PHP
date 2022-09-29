const searchBtn = document.querySelector('#search-btn');
const searchKey = document.querySelector('#search-key');
searchBtn.addEventListener('click', (_) => {
  const key = searchKey.value;
  window.location.href = 'index.php?search=' + key;
});

searchKey.addEventListener('keypress', (event) => {
  if (event.key == 'Enter') {
    const key = searchKey.value;
    window.location.href = 'index.php?search=' + key;
  }
});

const dataContainer = document.querySelector('#data-container');

searchKey.addEventListener('keyup', (_) => {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataContainer.innerHTML = xhr.responseText;
    }
  };

  const keyword = searchKey.value;

  xhr.open('GET', `ajax/search.php?search=${keyword}`, true);
  xhr.send();
});
