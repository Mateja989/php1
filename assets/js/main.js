const registration_form=document.querySelector('#registration_form')
const login_form=document.querySelector('#log_in_form')
const models=document.querySelector('#models')
const admin_user=document.querySelector('#users')
const product_page=document.querySelector('#addBtn')
const cart=document.querySelector('#cart_items')
const cart_details=document.querySelector('#cart_details')

if(registration_form) registerForm()
if(login_form) logInForm()
if(models) deleteItem('.deleteModel','iddelete','models/delete_model.php',printModel,printResponse,printNothing)
if(admin_user) userDetails()
if(models) changePrice()
if(product_page) addToCart()
if(cart) deleteItem('.deleteItem','iddeleteitem','models/delete_item.php',printCartTable,printCartResponse,printTotalPrice)
if(cart) confirmPurchase()
if(cart_details) cartDetails()

function confirmPurchase(){
    document.querySelector('#btnZavrsi').addEventListener('click',function(e){
        e.preventDefault()
        data={
            "confirm": 1
        }
        ajax2('models/confirm_purchase.php',"post",data,function(result){
            printConfirmResponse(result)
            clearCart()
            document.querySelector('#conf-btn').innerHTML='<input type="button" id="btnZavrsi" class="btn btn-primary bojaDug" value="Confirm purchase" disabled>'
        })
    })
}

function clearCart(){
    document.querySelector('#itemsList').innerHTML=""
}

//var klik=document.querySelector('.ulNav');



$(document).ready(function(){
    $('#icon').click(function(){
        $('ul').toggleClass('show')
    })
})

function printConfirmResponse(result){
    let html=`<p class='error-text green'>${result.message}</p>`

    document.querySelector('#thankYou').innerHTML=html
}

function registerForm(){
    const firstName=document.querySelector('#first_name')
    const lastName=document.querySelector('#last_name')
    const username=document.querySelector('#username')
    const password=document.querySelector('#password')
    const email=document.querySelector('#email')
    const street=document.querySelector('#street')
    //const street_number=document.querySelector('#street_number')
    const form=document.querySelector('#registration_form')

    const firstNameRegex =  /^[A-Z]{1}[a-z]{2,14}$/
    const lastNameRegex = /^[A-Z]{1}[a-z]{4,29}$/
    const passwordRegex = /^[A-Z]{1}[a-z0-9!@#$%^.&*]{7,19}$/   
    const userMailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
    const userNameRegex = /^([a-z]{1})[a-z0-9]{4,29}$/
    const streetRegex=/^([A-ZČĆŽŠĐ]|[1-9]{1,5})[A-ZČĆŽŠĐa-zčćžšđ\d\-\.\s]+$/

    form.addEventListener('submit',function(e){
        if(!submitBtn()){
            e.preventDefault()
            validationField(firstName,firstNameRegex)
            validationField(lastName,lastNameRegex) 
            validationField(username,userNameRegex) 
            validationField(password,passwordRegex) 
            validationField(email,userMailRegex) 
            validationField(street,streetRegex) 
            //validationField(street_number,streetNumberRegex) 
        }else{
            console.log('poslao')
        }
    })

    document.querySelector('#submit-btn',submitBtn)

    listenerField(firstName,'blur',firstNameRegex)
    listenerField(lastName,'blur',lastNameRegex)
    listenerField(username,'blur',userNameRegex)
    listenerField(password,'blur',passwordRegex)
    listenerField(email,'blur',userMailRegex)
    listenerField(street,'blur',streetRegex)
    //listenerField(street_number,'blur',streetNumberRegex)

    function submitBtn(){
        if(
            validationField(firstName,firstNameRegex) &&
            validationField(lastName,lastNameRegex) &&
            validationField(username,userNameRegex) &&
            validationField(password,passwordRegex) &&
            validationField(email,userMailRegex) &&
            validationField(password,passwordRegex) &&
            validationField(street,streetRegex) 
            //validationField(street_number,streetNumberRegex) 
        ){
            return 1
        }else{
            return 0
        }
    }
}
function printResponse(txt){
    let html=`<p class="error-text green">${txt}</p>`
  
    document.querySelector('#responseDelete').innerHTML=html
}

function printCartResponse(txt){
    let html=`<p class="error-text green">${txt}</p>`
  
    document.querySelector('#responseDeleteCart').innerHTML=html
    console.log(txt)
}
function printModel(array){
    let html=''
    if(array.length!=0){
        for(let x of array){
            html+=`<tr class="red">
            <td>${x.sneaker_name}</td>
            <td>${x.inserted_at}</td>
            <td class="text-center"><a class="btn-potvrdiNek" href="index.php?page=product_page&&id=${x.sneaker_id}" id="realEstate" data-id="${x.sneaker_id}"><i class="fa fa-eye"></i></a></td>
            <td class="text-center"><a class="btn-potvrdiNek editbtn" href="#" id="changePrice" data-id="${x.sneaker_id}"><i class="fa fa-pen"></i></a></td>
            <td class="text-center"><a class="btn-obrisiNek deleteModel" href="#" id="deleteAd" data-iddelete="${x.sneaker_id}"><i class="fa fa-trash"></a></a></td>
            `
        }
     }
     else{
         html+='<h4 class="text-center">Currently do not have any model.</h4>'
     }
  
     document.querySelector('#modelsList').innerHTML=html
}
function deleteItem(className,dataName,url,functionNameForPrint,functionNameForResponse,functionForTotalPrice){

    $(document).on('click',className,function(e){
        var id=$(this).data(dataName)
        var data={
            "id":id
        }
        
        ajax2(url,'post',data,function(result){
            functionNameForPrint(result.models);
            functionNameForResponse(result.message);
            functionForTotalPrice(result.total);
        })
    })
}
function printNothing(x){
    
}

function printTotalPrice(price){
    let html=`${price.total_price},00$`

    document.querySelector('.totalnaCena').innerHTML=html 
}
function ajax2(url, method, data, result) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        success: result,
        error: function(xhr){
            console.error(xhr);
        }
    })
}
//FUNCTION FOR LOGIN USERS
function logInForm(){
    const username=document.querySelector('#username-login')
    const password=document.querySelector('#password-login')
    const form=document.querySelector('#log_in_form')

    const userNameRegex = /^([a-z]{1})[a-z0-9]{4,29}$/
    const passwordRegex = /^[A-Z]{1}[a-z0-9!@#$%^.&*]{7,19}$/ 

    form.addEventListener('submit',function(e){
        if(!submitBtn()){
            e.preventDefault()
            validationField(username,userNameRegex)
            validationField(password,passwordRegex) 
        }else{
            console.log('poslao')
        }
    })

    function submitBtn(){
        if(
            validationField(username,userNameRegex) &&
            validationField(password,passwordRegex) 
        ){
            return 1
        }else{
            return 0
        }
    }

    document.querySelector('#btn-log',submitBtn)

    listenerField(username,'blur',userNameRegex)
    listenerField(password,'blur',passwordRegex)
}


function validationField(id,reg){
    if(reg.test(id.value)){
        id.nextElementSibling.classList.add('hidden')
        return 1
    }
    else if(id.value==""){
        id.nextElementSibling.classList.remove('hidden')
        return 0
    }
    else{
        id.nextElementSibling.classList.remove('hidden')
        return 0
    }
}

function listenerField(field,event,regEx){
    field.addEventListener(event,function(){
        validationField(field,regEx)
    })
}

function listenerDdl(field,event){
    field.addEventListener(event,function(){
        validationDdl(field)
    })
}

function validationDdl(tagOpt){
    if(tagOpt.value==""){
        tagOpt.nextElementSibling.classList.remove('hidden')
        return 0
    }
    else{
        tagOpt.nextElementSibling.classList.add('hidden')
        return 1
    }
}

function addToCart(){
    $(document).on('click','#cartBtn',function(e){
        e.preventDefault()
        let id=$(this).data('sneakerid')
        let data={
            "sneaker": id,
        }
        ajax2('models/add_item.php','post',data,function(result){
            printAddToCart(result)
        })
    })
}

function printAddToCart(result){
    let html=`<p class="error-text green">${result.message}</p>`

    document.querySelector('#addInfo').innerHTML=html

}
function cartDetails(){
    $(document).on("click","#cart", function() {
        $(".modal-bg").css("visibility", "visible");   
        $(".nes").css("visibility", "visible"); 
    })
    $(document).on("click","#closeModal", function(){
        $(".nes").css("visibility", "hidden"); 
        $(".modal-bg").css("visibility", "hidden");
    })

    $(document).on('click','.details',function(e){
        e.preventDefault()
        var id=$(this).data('id')
        console.log(id)
        var data={
            "id":id
        }
        ajax2('models/cart_details.php','post',data,function(result){
            printCartDetails(result)
        })
       
    })
}

function printCartDetails(array){
    let html=''
    for(let x of array){
        html+=`<div class="d-flex flex-column align-items-center text-center">
        <img src="${x.cover_picture}" alt="Admin" class="rounded-circle" width="150">
        <div class="mt-3">
          <h4>Model: ${x.brand_name + " " +x.sneaker_name}</h4>
          <p class="text-secondary mb-1">Price: ${x.price},00$</p>
        </div>
      </div>`
    }

    html+='<a href="#" id="closeModal"><button class="btn btn-outline-primary w-100">Back to panel</button></a>'
    document.querySelector('#cartDetails').innerHTML=html
}

function userDetails(){
    $(document).on("click","#userInfo", function() {
        $(".modal-bg").css("visibility", "visible");   
        $(".nes").css("visibility", "visible"); 
    })
    $(document).on("click","#closeModal", function(){
        $(".nes").css("visibility", "hidden"); 
        $(".modal-bg").css("visibility", "hidden");
    })

    $(document).on('click','#userInfo',function(e){
        e.preventDefault()
        var id=$(this).data('id')
        console.log(id)
        var data={
            "id":id
        }
        ajax2('models/user_info.php','post',data,function(result){
            printUserModal(result)
        })
       
    })
    
}
function printCartTable(array){
    let html=''
    let btnHtml=''
    if(array.length){
        for(let item of array){
            html+=`<tr class="red">
            <td class="img_cart"><img src="${item.cover_picture}"></td>
            <td>${item.sneaker_name}</td>
            <td>${item.price},00$</td>
            <td class=""><a class="btn-obrisiNek deleteItem" href="#" id="deleteAd" data-iddeleteitem=" ${item.cart_snaker_id}>"
            ><i class="fa fa-trash"></a></td>
        </tr>`
        }
        btnHtml+='<input type="button" id="btnZavrsi" class="btn btn-primary bojaDug" value="Confirm purchase">'
    }
    else{
        html+='<p class="error-text dark text-center">Your cart is empty</p>'
        btnHtml+='<input type="button" id="btnZavrsi" class="btn btn-primary bojaDug" value="Confirm purchase" disabled>'
    }
    $('#itemsList').html(html)
    $('#conf-btn').html(btnHtml)
}

function printUserModal(user){
   let html=`<div class="d-flex flex-column align-items-center text-center">
                    <img src="${profilePicture(user.profile_picture)}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>Full Name:${user.first_name + " " +user.last_name}</h4>
                      <p class="text-secondary mb-1">Username: ${user.username}</p>
                      <p class="text-secondary mb-1">Mail: ${user.mail}</p>
                      <p class="text-secondary mb-1">Role: ${user.role_name}</p>
                      <p class="text-secondary mb-1">City: ${user.city_name}</p>
                      <p class="text-secondary mb-1">Active: ${user.created_at}</p>
                      <p class="text-muted font-size-sm">Street: ${user.street + " " +user.street_number}</p>
                      <a href="#" id="closeModal"><button class="btn btn-outline-primary">Back to panel</button></a>
                    </div>
                  </div>`

    document.querySelector('#infoForUser').innerHTML=html
}

function profilePicture(picture){
    let src=""

    if(picture  != null) 
        src+=picture
    else 
        src+="assets/images/noimg.jpg";

    return src
}
/*
$(document).ready(function(){
    $('#icon').click(function(){
        $('ul').toggleClass('show')
    })
})*/

function changePrice(){
    $(document).on("click","#changePrice", function() {
        $(".modal-bg").css("visibility", "visible");   
        $(".nes").css("visibility", "visible"); 
    })
    $(document).on("click","#closeModal", function(){
        $(".nes").css("visibility", "hidden"); 
        $(".modal-bg").css("visibility", "hidden");
    })

    $(document).on('click','#changePrice',function(e){
        e.preventDefault()
        var id=$(this).data('id')
        console.log(id)
        var data={
            "id":id
        }
        ajax2('models/get_sneaker_model.php','post',data,function(result){
            printModelModal(result)
        })
       
    })
    
}

function printModelModal(model){
    let html=`<div class="d-flex flex-column align-items-center text-center">
                    <img src="${model.cover_picture}" alt="Admin" class="" width="150">
                    <div class="mt-3">
                      <h4>Model: ${model.sneaker_name}</h4>
                      <p class="text-secondary mb-1">Currently price: ${model.price},00$</p>
                      <form action="models/change_price.php" method="post" id="changePriceee">
                        <label for="price">Add new price</label>
                        <input type="text" name="price" id="price"/>
                        <input type="hidden" name="sneakerId" id="sneakerId" value="${model.sneaker_id}" disabled />
                        <div id="error">
                        </div>
                        <input type="button" class="btn btn-outline-primary mb-3 greenColor" value="Save new price" name="savePrice" id="savePrice"/>
                        <div id="responseSuccess">
                        </div>
                        </form>
                        <a href="#" id="closeModal"><button class="btn btn-outline-primary redColor">Back to panel</button></a>
                    </div>
                  </div>`

    document.querySelector('#modelPrice').innerHTML=html
}

$(document).on('blur','#price',function(){
    var neki=$('#price').val();
    var priceReg=/^[\d]{3}$/;
    console.log()
    let html=''
    let error=0
    if(!priceReg.test(neki)){
        html+='<p class="error">Price cannot start with 0 and price must be in range of 1-99999</p>'
        error++
    }

    $('#error').html(html)

    if(!error){
        $(document).on('click','#savePrice',function(){
            var id=$('#sneakerId').val()
            var data={
                "id" : id,
                "price" : neki
            }
            ajax2('models/change_price.php','post',data,function(result){
                printResultForPrice(result)
            })
        })
    }
})

function printResultForPrice(result){
    let html=`<p class="error-text green">${result.message}</p>`
    $('#responseSuccess').html(html)
}

var limit=0
var brand=document.querySelector('#brand')
var category=document.querySelector('#category')
var gender=document.querySelector('#gender')
var sort=document.querySelector('#sort')

$(".ddl-filter").on('change',function(){
    var data={
        "brand": brand.value,
        "category": category.value,
        "gender": gender.value,
        "sort": sort.value,
        "limit":0
    }
    
    ajax2('models/pagination.php','post',data,function(result){
        printProductPage(result.models)
        printPages(result.num_of_pages,result.models)
    })
})

$(document).on('click','.pagination',function(e){
    e.preventDefault()
    limit =$(this).data('limit');

    var data={
        "brand": brand.value,
        "category": category.value,
        "gender": gender.value,
        "sort": sort.value,
        "limit":limit
    }
    
    ajax2('models/pagination.php','post',data,function(result){
        printProductPage(result.models)
        printPages(result.num_of_pages,result.models)
    })
})

$(document).on('click','#srcBtn',function(){
    
    brand.value=0
    category.value=0
    gender.value=0
    sort.value=0
    limit=0

    var data={
        "brand": 0,
        "category": 0,
        "gender": 0,
        "sort": 0,
        "limit":0
    }
    
    ajax2('models/pagination.php','post',data,function(result){
        printProductPage(result.models)
        printPages(result.num_of_pages,result.models)
    })
})


function printProductPage(array){
    let html=''
    if(!array.length){
        html+='<p class="error">Sorry,we dont have any models in store.</p>'
    }
    for(let product of array){
        html+=`<div class="cart-properties ">
                    <div class="product-tumb">
                        <img src="${product.cover_picture}" alt="${product.sneaker_name}">
                    </div>
                    <div class="body-cart">
                        <span class="product-catagory">${product.category_name+","+product.gender_name}</span>
                        <h4><a href="index.php?page=product_page&&id=${product.sneaker_id}">${product.brand_name+" "+product.sneaker_name}</a></h4>
                    </div>
                    <div class="product-bottom-details">
                        <div class="product-price">${product.currently_price},00$</div>
                        <div class="product-links">
                            <a href="index.php?page=product_page&&id=${product.sneaker_id}"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>`
    }

    html+=`<div class="number">
                <ul id=paginacija class="page-number">
                </ul>
        </div>`

    document.querySelector('#products').innerHTML=html
}


function printPages(x,array){
    let html = ""

    console.log(array.length)


    if(array.length == 0){
        html += ""
    }
    else{
        for(let i = 0; i < x; i++){
            html += `<span><li><a class="pagination" data-limit="${i}" href="">${i+1}</a></li></span>`
        }
    }
    $('#paginacija').html(html)

}




var ddl = document.querySelectorAll("#ddl-brand").forEach(x => x.addEventListener('change',function(){

    var izabrani = document.querySelector("#ddl-brand").value
    console.log(izabrani)

    var data = {
        "id":izabrani
    }

    ajaxCallBack("models/specifikacije.php","post",data,function(result){
        ispisiSpec(result)
    })

}))

function ispisiSpec(result){
    let html = ""
    if(!result.length){
        html += '<p>Niste izabrali nista</p>'
    }
    else{
        
        for(let x of result){
            html += `
            <label class="labels" >${x.specifikacija_naziv}</label>
            <input type="text" class="form-control" name="$${x.specifikacija_naziv}">`
        }
    }

    document.querySelector('#mesto').innerHTML=html
}


function ajaxCallBack(url,method,data,result){
    $.ajax({
        url:url,
        method:method,
        data:data,
        dataType:"json",
        success:result,
        error:function(xhr){
            console.log(xhr)
        }
    })
}

