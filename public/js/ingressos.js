let cart = {
    meia: 0,
    inteira: 0,
    vip: 0
};

function addToCart(ticketType) {
    cart[ticketType]++;
    alert(`Você adicionou 1 ingresso ${ticketType} ao seu carrinho.`);
    console.log(cart);
}
