<?php
	if(isset($_SESSION['user'])): 
		$status=0;
		$cart_items=get_cart_items($_SESSION['user']->user_id,$status);
		$total_price=get_total_price($_SESSION['user']->user_id,$status);
		$get_num_of_products=get_num_of_products($_SESSION['user']->user_id,$status);
		var_dump($get_num_of_products);
		
?>
<div class="container mt-5 strana">
		<div class="row pt-5">
			<div class="nee">
				<ul class="d-flex stay">
					<li>Home</li>
					<span><li>/</li></span>
					<li>Checkout</li>
				</ul>
			</div>
			<h1 class="naslovC">Checkout</h1>
		</div>
	</div>
	<hr/>
	<section id="cart_items">
		<div class="container">
			<div class="review-payment">
				<h2>View cart</h2>
			</div>
			<div class="table-responsive cart_info">
				<table class=" table table-borderless table-striped table-earning">
				<thead>
    				<tr class="red colorHead">
						<th>Picture</th>
						<th>Model name</th>
						<th>Price</th>
						<th class="text-right">Delete</th>
    				</tr>
				</thead>
				<tbody id="itemsList">
					<?php
						if(count($cart_items)): 
						foreach($cart_items as $item): 
					?>
					<tr class="red">
						<td class="img_cart"><img src="<?= $item->cover_picture ?>"></td>
						<td><?= $item->sneaker_name ?></td>
						<td><?= $item->price.",00$" ?></td>
						<td class=""><a class="btn-obrisiNek deleteItem" href="#" id="deleteAd" data-iddeleteitem="<?= $item->cart_snaker_id ?>"
						><i class="fa fa-trash"></a></td>
					</tr>
					<?php
						endforeach;
					?>
					<?php else: ?>
						<div>
							<p class="error-text dark">Your cart is empty</p>
						<div>
					<?php
						endif;
					?>
				</tbody>
				</table>
				<div id="responseDeleteCart">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-4">
						<div class="order-message">
							<h4>Payment information</h4>
							<div class="total_area">
						<?php
							$user=get_user($_SESSION['user']->user_id);
						?>
							<ul id="kupovina-info">
									<li>Name <span><?= $user -> first_name. " " .$user->last_name ?></span></li>
									<li>Street <span><?= $user -> street. " " .$user->street_number ?></span></li>
									<li>Shipping <span>FREE</span></li>
									<li>Total price <span class="totalnaCena"><?= $total_price->total_price. ",00$" ?></span></li>
								</ul>
							</div>
							<div id="conf-btn">
							<?php if(!$get_num_of_products): ?>
							<input type="button" id="btnZavrsi" class="btn btn-primary bojaDug" value="Confirm purchase" disabled>
							<?php else: ?>
							<input type="button" id="btnZavrsi" class="btn btn-primary bojaDug" value="Confirm purchase">
							<?php endif; ?>
							</div>
							<div id="thankYou">
							</div>
						</div>	
					</div>					
				</div>
			</div>
		</div>
	</section>
<?php else: header('location: index.php') ?>
<?php endif; ?>

