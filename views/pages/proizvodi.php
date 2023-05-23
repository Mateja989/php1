<main>
            <div class="container mt-5">
                <div class="row mt-5">
                    <div class="col-12">
                        <ul class="d-flex stay">
                            <li>Home</li>
                            <span><li>/</li></span>
                            <li>Products</li>
                        </ul>
                    </div>
                    <h1>Sneakers</h1>
                </div>
            </div>
            <hr class="line"/>
            <div class="container bor">
                <div class="row justify-content-around">
                    <div class="main-properties order-2 order-md-1" id='products'>
						<?php 
							$products=get_products_with_price();
							foreach($products as $product): 
						?>
                                <div class="cart-properties">
									<div class="product-tumb">
										<img src="<?= $product->cover_picture ?>" alt="<?= $product->sneaker_name ?>">
									</div>
                                    <div class="body-cart">
										<span class="product-catagory"><?= $product->category_name.",".$product->gender_name ?></span>
										<h4><a href="index.php?page=product_page&&id=<?= $product->sneaker_id?>"><?= $product->brand_name." ".$product->sneaker_name ?></a></h4>
                                    </div>
									<div class="product-bottom-details">
										<div class="product-price"><?= $product->currently_price.",00$" ?></div>
										<div class="product-links">
											<a href="index.php?page=product_page&&id=<?= $product->sneaker_id?>"><i class="fa fa-eye"></i></a>
										</div>
									</div>
                                </div>
							<?php 
								endforeach;
							?>	
                        <div class="number">
                            <?php 
                                $modelsCount=get_pagination_count();
                            ?>
                            <ul class="page-number" id="paginacija">
                                <?php
                                    for($i=0;$i<$modelsCount;$i++):
                                ?>
                                <span><li><a class="pagination" data-limit="<?=$i?>" href="#"><?=($i+1)?></a></li></span>
                                <?php 
                                    endfor;
                                ?>
                            </ul>
                        </div>                    
                    </div>
                    <div class="sidebar mt-5 pb-5 order-1 order-md-2">
                        <div class="search">
                            <h3>Browse our model</h3>
                            <form action="">
                               <!-- <div class="ddl">
                                    <input type="search" placeholder="Enter Keyword...">
                                </div>-->
                                <div class="ddl custom-select">
                                    <select name="" id="brand" class="ddl-filter">
										<option value="0">All brand</option>
										<?php	
											$brands=get_data('brand');
											foreach($brands as $brand):
										?>
                                        <option value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
										<?php	
											endforeach;
										?>
                                    </select>
                                </div>
                                <div class="ddl custom-select">
                                    <select name="" id="category" class="ddl-filter">
                                        <option value="0">All category</option>
										<?php	
											$categories=get_data('category');
											foreach($categories as $category):
										?>
                                        <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
										<?php	
											endforeach;
										?>
                                    </select>
                                </div>
                                <div class="ddl custom-select">
                                    <select name="" id="gender" class="ddl-filter">
                                        <option value="0">All gender</option>
                                        <?php	
											$genders=get_data('gender');
											foreach($genders as $gender):
										?>
                                        <option value="<?= $gender->gender_id ?>"><?= $gender->gender_name ?></option>
										<?php	
											endforeach;
										?>
                                    </select>
                                </div>
                                <div class="ddl custom-select">
                                    <select name="" id="gender" class="ddl-filter">
                                        <option value="0">Kategorija</option>
                                        <?php	
											$genders=get_data('kategorije');
											foreach($genders as $gender):
										?>
                                        <option value="<?= $gender->kategorija_id ?>"><?= $gender->kategorija_naziv ?></option>
										<?php	
											endforeach;
										?>
                                    </select>
                                </div>
                                <div class="ddl custom-select mb-3">
                                    <select name="" id="sort" class="ddl-filter">
                                        <option value="0">Sort A/B</option>
                                        <option value="asc">Name ASC</option>
                                        <option value="desc">Name DESC</option>
                                    </select>
                                </div>
                               <input type="button" value="Reset Filter" class="mb-3 pt-3" id="srcBtn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>