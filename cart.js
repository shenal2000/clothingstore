// Add to Cart function (called from product pages)
function addToCart(productName, price, imageId) {
  const size = document.getElementById("product-size").value;
  const qty = parseInt(document.getElementById("product-qty").value);

  if (!size) {
    alert("Please select a size!");
    return;
  }

  const product = {
    name: productName,
    price: price,
    size: size,
    qty: qty,
    image: document.getElementById(imageId).src
  };

  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let existing = cart.find(item => item.name === product.name && item.size === product.size);

  if (existing) {
    existing.qty += product.qty;
  } else {
    cart.push(product);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  alert("Added to cart!");
  window.location.href = "cart.html"; // redirect to cart page
}

// Load cart items inside cart.html
function loadCart() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let cartTable = document.getElementById("cart-items");
  let totalPrice = 0;

  if (cart.length === 0) {
    cartTable.innerHTML = "<tr><td colspan='6'>Your cart is empty!</td></tr>";
    document.getElementById("total-price").innerText = "0";
    return;
  }

  cart.forEach((item, index) => {
    let row = `<tr>
      <td><img src="${item.image}" width="60"></td>
      <td>${item.name}</td>
      <td>${item.size}</td>
      <td>${item.qty}</td>
      <td>${item.price} LKR</td>
      <td>${item.price * item.qty} LKR</td>
      <td><button class="btn remove-btn" onclick="removeItem(${index})">Remove</button></td>
    </tr>`;
    cartTable.innerHTML += row;
    totalPrice += item.price * item.qty;
  });

  document.getElementById("total-price").innerText = totalPrice;
}

// Remove an item
function removeItem(index) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  location.reload();
}

// Clear all
function clearCart() {
  localStorage.removeItem("cart");
  location.reload();
}
