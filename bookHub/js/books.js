const libros = [
    {
        isbn: "9780063058501",
        title: "HEARTLESS HUNTER",
        author: "Kristen Ciccarelli",
        stars: 4.7,
        price: 18.90,
        image: "img/heartless-hunter-kristen-ciccarelli.jpg",
        description: "In a land ruled by ancient gods and treacherous politics, Asha is a fierce hunter dedicated to protecting her people from the monstrous beasts that lurk in the dark. When a new threat arises, Asha must join forces with a mysterious stranger who challenges everything she believes. Together, they embark on a perilous journey to uncover secrets that could change their world forever.",
        editorial: "HarperTeen",
        language: "English",
        binding: "Hardcover",
        releaseDate: "15/06/2023"
    },
    {
        isbn: "9781635574091",
        title: "HOUSE OF FLAME AND SHADOW",
        author: "Sarah J. Maas",
        stars: 4.8,
        price: 21.37,
        image: "img/house-of-flame-and-shadow-sarah-j-maas.jpg",
        description: "The latest installment in the Crescent City series, 'House of Flame and Shadow' follows Bryce Quinlan as she navigates a world of magic, danger, and intrigue. As ancient powers awaken and new threats emerge, Bryce and her allies must confront their deepest fears and uncover long-buried secrets to protect their city and those they love.",
        editorial: "Bloomsbury Publishing",
        language: "English",
        binding: "Hardcover",
        releaseDate: "14/11/2023"
    },
    {
        isbn: "9781982181183",
        title: "Miss Morgan's Book Brigade",
        author: "Janet Skeslien Charles",
        stars: 4.5,
        price: 22.70,
        image: "img/miss-morgans-book-brigade-janet-skeslien-charles.jpg",
        description: "Set against the backdrop of World War II, 'Miss Morgan's Book Brigade' tells the story of an unlikely group of women who come together to form a mobile library, bringing books and hope to those in need. As they navigate the challenges of war and personal loss, these women find strength, friendship, and a sense of purpose in the power of literature.",
        editorial: "Atria Books",
        language: "English",
        binding: "Paperback",
        releaseDate: "10/09/2023"
    },
    {
        isbn: "9780593239473",
        title: "THE DEMON OF UNREST",
        author: "Erik Larson",
        stars: 4.6,
        price: 20.65,
        image: "img/the-demon-of-unrest-erik-larson.jpg",
        description: "Erik Larson's 'The Demon of Unrest' delves into the dark sides of human nature and the chaos that can arise when societal order breaks down. Through meticulously researched historical events and compelling narratives, Larson explores how fear, paranoia, and violence can spread like wildfire, transforming ordinary people into agents of chaos.",
        editorial: "Crown Publishing Group",
        language: "English",
        binding: "Hardcover",
        releaseDate: "05/05/2023"
    },
    {
        isbn: "9780593336829",
        title: "Bride",
        author: "Ali Hazelwood",
        stars: 4.4,
        price: 14.00,
        image: "img/bride-ali-hazelwood.jpg",
        description: "In 'Bride,' Ali Hazelwood crafts a witty and heartwarming romance filled with unexpected twists and delightful characters. When a fiercely independent scientist agrees to an arranged marriage to secure funding for her research, she never expects to find herself falling for her charming but enigmatic fiancé. As they navigate the complexities of love and ambition, they discover that true partnership means embracing each other's strengths and vulnerabilities.",
        editorial: "Berkley",
        language: "English",
        binding: "Paperback",
        releaseDate: "08/02/2023"
    }
];

$(document).ready(function() {
    $(".add-to-cart").click(function() {
        let isbn = $(this).attr("data-isbn");
        let book = libros.find(b => b.isbn === isbn);

        if (book) {
            addToCart(book);
        }
    });

    function addToCart(book) {
        // Crear el HTML del elemento del carrito
        let cartItem = `
            <div class="cart-item">
                <div>${book.title}</div>
                <div class="cart-item-price">${book.price.toFixed(2)} €</div>
            </div>
        `;

        // Agregar el elemento al carrito
        $("#cart-items").append(cartItem);

        // Calcular y actualizar el total
        updateCartTotal(book.price);
    }

    function updateCartTotal(price) {
        let currentTotal = parseFloat($("#cart-total").text());
        let newTotal = currentTotal + price;
        $("#cart-total").text(newTotal.toFixed(2));
    }
});