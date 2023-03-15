//Get cat items to view
function appendCart()
{
	$.ajax({
		url : '/store/get_cart_item',
		type: 'POST',
		success: function(res){
			//console.log(res);
			data = $.parseJSON(res);
			//console.log(data);
			$('#cartsummary').html(data.cart);
		}
	});
}

//Remove an cart
function updateCart(product_id, action)
{
	var quantity = $('#quantity'+product_id).val();
	if(quantity == 0)
	{
		alert("Quantity can not be 0");
		$('#quantity'+product_id).val("1");
		return false;
	}
	$.ajax({
		url : '/store/update_cart',
		type: 'POST',
		data: {product_id:product_id, qty:quantity, action:action},
		success: function(res){
			//console.log(res.status);
			if (res.status==true) {
				//location.reload(); 
				window.location.assign("/store/view_cart");
			}
			//console.log(res);
		}
	});
}

$(document).ready(function(){
	appendCart();
});
