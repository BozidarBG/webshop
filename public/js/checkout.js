//populate table with ordered products from local storage
//images must be taken from DB via ajax
//append div with calculated totals
//send arr of product ids to controller to return quantities for those products to check if there are enough
//compare if there are enough products on the stock
    //if there are, do nothing
    //if not, show message and reduce quantity

let productsFromStorage=readStorage();


let ids=[];
if(productsFromStorage){
    productsFromStorage.forEach(function(product){
        ids.push({id:product.id, ordered_quantity:product.ordered_quantity});
    });
}


let productsFromDB;
let imagesFromDB;
if(ids.length){
    retrieveProductFromDB();
}

placeRowsAndTotals();
//add listeners to html
addPlusMinusListeners();
addDeleteListeners();

function placeRowsAndTotals(){
    let htmlProducts='';
    let haveRows=false;
    if(productsFromStorage){
        haveRows=true;
        productsFromStorage.forEach(function(product, index){
            let row_total=calculatePrice(product.price, product.ordered_quantity, product.discount);
            htmlProducts +=`
    <div class="row cart_row text-center text-dark checkout-row" data-row-total="${row_total}" data-name="${product.name}" data-id="${product.id}" data-quantity="${product.quantity}" data-discount="${product.discount}" data-price="${product.price}">
        <div class="col-md-1 col-sm-1 col-xs-1 border-h-r id">
            ${index+1}.
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1 border-h-r image">
            <img src="" class="cart-image" alt="" width="30px">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 border-h-r align-self-center">
            <div class="quantity_selector">
                <button class="btn btn-sm btn-outline-danger text-small minus" > - </button>
                <button class="btn btn-sm btn-success text-small quantity_selected" disabled>${product.ordered_quantity}</button>
                <button class="btn btn-sm btn-outline-primary text-small plus"> + </button>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 border-h-r">
            ${product.name}
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1 text-center border-h-r">
            ${formatPrice(product.price)}
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1 border-h-r discount">
            ${product.discount}%
        </div>
        <div class="col-1half border-h-r text-right pr-1 price">
            ${formatPrice(calculatePrice(product.price, product.ordered_quantity, product.discount))}
        </div>
        <div class="col-half align-self-center">
            <button class="btn btn-outline-danger btn-sm btn_circle delete_row"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    `;
        });
    }else{
        htmlProducts +=`
    <div class="row cart_row text-center text-danger">There are no articles in your cart!</div>
    `;
    }
//add product rows in html
    $('#products').html(htmlProducts);

    if(haveRows){

        let html1=`
        <div class="col-md-8 col-sm-8 col-xs-8 border-h-r">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 border-b-r ">
            Total without discount
        </div>
        <div class="col-1half border-b-r text-right pr-1" id="totalWithoutDiscount">

        </div>
        `;

        let html2=`
        <div class="col-md-8 col-sm-8 col-xs-8 border-h-r">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 border-b-r">
            Total discount
        </div>
        <div class="col-1half border-b-r text-right pr-1" id="discount">

        </div>
        `;

        let html3=`
        <div class="col-md-8 col-sm-8 col-xs-8 border-h-r">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 border-b-r">
            Total Order
        </div>
        <div class="col-1half border-b-r text-right pr-1" id="cart_total">

        </div>
    `;
        $('#total1').html(html1);
        $('#total2').html(html2);
        $('#total3').html(html3);
        calculateTotal();


    }


}

function retrieveProductFromDB(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let arrData={};
    arrData.ids=ids;

    $.ajax({
        url: "/products-by-ajax",
        method: 'GET',
        data: arrData,
        dataType: 'json',
        success: function (data) {
            //console.log(data['success'])
            if (data['success']) {
                productsFromDB=data['success'][0];
                imagesFromDB=data['success'][1];
                putImages();
                comparePricesQuantitiesDiscounts();
            }
        }

    });//end .ajax
}

//puts images (or placeholder 'noimage.jpg') from DB via ajax, in the src tag
function putImages(){
    //images are stored in productsFromDB var, after ajax has ended
    //loop through all rows, take id and find it in productsAjax
    $('.cart_row').each(function(){
        let row_id=$(this).attr('data-id');
        //we look for array containing id:row_id
        let img = imagesFromDB.find(x=>x.id == row_id) ? imagesFromDB.find(x=>x.id == row_id).image : null;
        if(!img){
            img='placeholders/noimage.jpg';
        }
        //in row, child with class .cart-image, put that image
        $(this).find('.cart-image').attr('src', 'storage/'+img);
    });
}

//checks if data for each product in the cart are the same as in DB (user may have changed something or product are being sold...)
function comparePricesQuantitiesDiscounts(){
    //console.log(productsFromStorage)
    //console.log(productsFromDB)
    $('.cart_row').each(function(){
        let stateChanged=false;
        let message='';
        let row_id=$(this).attr('data-id');
        let row_price=$(this).attr('data-price');
        let row_name=$(this).attr('data-name');
        let row_discount=$(this).attr('data-discount');
        //we look for ordered quantity
        let row_ordered_quantity=$(this).find('.quantity_selected').text();
        //
        //let row_max_quantity=$(this).attr('data-quantity');
        //we look for array containing id:row_id and check if the data are the same
        //DB_row is an object with data for one product, from DB
        let DB_row=productsFromDB.find(x=>x.id == row_id);

        //compare values and change html
        if(row_price != DB_row.price){
            message +=`<span class="text-danger">Price of article ${row_name} has changed. It is ${formatPrice(DB_row.price)} and it was ${formatPrice(row_price)}</span><br>`;
            stateChanged=true;
        }
        if(row_discount != DB_row.discount){
            message +=`<span class="text-danger">Discount of article ${row_name} has changed. It is ${DB_row.discount}% and it was ${row_discount}%</span><br>`;
            stateChanged=true;
        }
        if(row_ordered_quantity > DB_row.quantity){
            message +=`<span class="text-danger">Quantity on our stock for article ${row_name} is changed. It is ${DB_row.quantity} and you wanted to order ${row_ordered_quantity}</span>`;
            stateChanged=true;
            //we need to reduce ordered quantity
            //console.log(DB_row.quantity);
            productsFromDB.find(x=>x.id == row_id).ordered_quantity=DB_row.quantity
        }

        //if there were changes in DB, show message and update fields
        if(stateChanged){
            $('#message').html(message);

            //there were changes so we update local storage with productsFromDB and put new values on html
            updateLocalStorage(productsFromDB);
            productsFromStorage=readStorage();

            placeRowsAndTotals();
            putImages();
        }

    });
}



