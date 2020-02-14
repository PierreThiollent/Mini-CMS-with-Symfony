const searchInput = document.getElementById('search');
const articles = document.querySelectorAll('article');

searchInput.addEventListener('input', event => {
    articles.forEach(name => {
        if (name.innerHTML.toLowerCase().includes(event.target.value.toLowerCase())) {
            name.style.display = 'block';
        } else {
            name.style.display = 'none';
        }
    });
});