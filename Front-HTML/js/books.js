// script.js

const books = [
    {
        id: 1,
        title: 'HEARTLESS HUNTER',
        author: 'Kristen Ciccarelli',
        image: 'img/heartless-hunter-kristen-ciccarelli.jpg',
        description: 'The stunning first book in the epic fantasy series...',
        price: '18.90 €',
        stars: 4.5
    },
    {
        id: 2,
        title: 'HOUSE OF FLAME AND SHADOW',
        author: 'Sarah J. Maas',
        image: 'img/house-of-flame-and-shadow-sarah-j-maas.jpg',
        description: 'The stunning third book in the sexy, action-packed Crescent City series...',
        price: '21.37 €',
        stars: 4.5
    },
    // Más libros...
];

document.addEventListener('DOMContentLoaded', () => {
    const bookContainer = document.getElementById('book-container');
    if (bookContainer) {
        bookContainer.addEventListener('click', (e) => {
            const bookElement = e.target.closest('.book');
            if (bookElement) {
                const bookId = bookElement.getAttribute('data-id');
                localStorage.setItem('selectedBookId', bookId);
                window.location.href = 'details.html';
            }
        });
    }

    const bookDetailsPage = document.querySelector('body');
    if (bookDetailsPage && bookDetailsPage.id === 'book-details-page') {
        const bookId = localStorage.getItem('selectedBookId');
        if (bookId) {
            const book = books.find(b => b.id === parseInt(bookId));
            if (book) {
                document.getElementById('book-image').src = book.image;
                document.getElementById('book-title').textContent = book.title;
                document.getElementById('book-author').textContent = book.author;
                document.getElementById('book-description').textContent = book.description;
                document.getElementById('book-price').textContent = book.price;
                const starsContainer = document.getElementById('book-stars');
                starsContainer.innerHTML = '';
                for (let i = 0; i < Math.floor(book.stars); i++) {
                    starsContainer.innerHTML += '&#9733;';
                }
                if (book.stars % 1 !== 0) {
                    starsContainer.innerHTML += '&#189;';
                }
            }
        }
    }
});
