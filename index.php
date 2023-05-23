<?php
  session_start();
  require_once "config/connection.php";
  include "views/fixed/head.php";
  require_once "models/functions.php";

  if(isset($_GET['page'])){
    switch($_GET['page'])
    {
      case 'home': 
        include "views/fixed/menu.php";
        include "views/pages/home.php";
        include "views/fixed/footer.php";
        break;
      case 'registration': 
        include "views/pages/sign_up.php";
        break;
      case 'log_in': 
          include "views/pages/log_in.php";
          break;
      case 'add_product': 
          include "views/pages/admin/dodaj_proizvod.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'admin_sneakers': 
          include "views/fixed/admin/sidebar.php";
          include "views/pages/admin/sneakers.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'admin_users': 
          include "views/fixed/admin/sidebar.php";
          include "views/pages/admin/users.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'products': 
          include "views/fixed/menu.php";
          include "views/pages/products.php";
          include "views/fixed/footer.php";
          break;
      case 'product_page': 
          include "views/fixed/menu.php";
          include "views/pages/product_page.php";
          include "views/fixed/footer.php";
          break;
      case 'cart': 
          include "views/fixed/menu.php";
          include "views/pages/cart.php";
          include "views/fixed/footer.php";
          break;
      case 'author': 
          include "views/fixed/menu.php";
          include "views/pages/author.php";
          include "views/fixed/footer.php";
          break;
      case 'contact': 
          include "views/fixed/menu.php";
          include "views/pages/contact.php";
          include "views/fixed/footer.php";
          break;
      case 'message': 
          include "views/fixed/admin/sidebar.php";
          include "views/pages/admin/message.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'message_body': 
          include "views/fixed/admin/sidebar.php";
          include "views/pages/admin/message_body.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'purchase': 
          include "views/fixed/admin/sidebar.php";
          include "views/pages/admin/purchase.php";
          include "views/fixed/admin/footer.php";
          break;
      case 'profile': 
        include "views/fixed/admin/sidebar.php";
        include "views/pages/admin/profile.php";
        include "views/fixed/admin/footer.php";
        break;
    }
  }
   else {
    include "views/fixed/menu.php";
    include "views/pages/home.php";
    include "views/fixed/footer.php";
  }
?>