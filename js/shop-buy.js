function addToCartOnClick(e) {
	const cartItem = e[0];
	const cartItemId = cartItem.id;
	const html = cartItem.innerHTML;

	$.ajax({
		url: 'php/addToCart.php',
		type: 'POST',
		data: {
			id: cartItemId
		},
		beforeSend: function() {
			var loader = "<div class='spinner-dark' style='font-size: 2.5px;'></div>";
			cartItem.innerHTML = loader;
		},
		success: function(data) {
			$('#price').text('R' + data);
		},
		error: function(error) {
			$('#price').text('There was an error displaying the price!');
		},
		complete: function() {
			$('#modal').show();
			cartItem.innerHTML = html;
		}
	});
}

function closeModal() {
	$('#modal').hide();
}
