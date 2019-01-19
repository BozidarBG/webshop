


    //when clicked add to cart on the product
    // 1. read data from storage
    // 2. check if this product is already in the cart
    //  2.1 if is in the cart, update quantity
    //  2.2 if it is not in the cart, add new product to the cart
    // 3. populate modal with all products and quantities and calculations
    // 4. open modal with all products and other data

    //when click + button
    // 1. see if ordered quantity is > than $product->quantity
    // 2. increase ordered quantity

    //when click - button
    // 1. see if ordered quantity is 0
    // 2. decrease ordered quantity


    $('.open_cart_modal').click(function(){
        //get data from clicked product
        let added_product={};
        added_product.id=$(this).parent().data('id');
        added_product.name=$(this).siblings('input[name="name"]').val();
        added_product.price=$(this).siblings('input[name="price"]').val();
        added_product.discount=$(this).siblings('input[name="discount"]').val();
        added_product.quantity=$(this).siblings('input[name="quantity"]').val();
        added_product.ordered_quantity=1;
        //console.log(added_product)

        //check if this product is already in the cart. if it is, update, if not, add this product
        addToStorageCart(added_product);

        // populate modal with all products and quantities and calculations
        makeHtml();
        addDeleteListeners();
        addPlusMinusListeners();
        // open modal with all products and other data
        $('#cart_modal').modal('show');

    });//end open modal + add product


    //show hide cart modal without adding new products || quantity
    $('.show_cart_modal').click(function(){

        // populate modal with all products and quantities and calculations
        makeHtml();
        addPlusMinusListeners();

        addDeleteListeners();
        // open modal with all products and other data
        $('#cart_modal').modal('show');

        event.preventDefault();

    });//end open modal

    //receives object with product properties
    function addToStorageCart(product){

        let storageItems=[];
        let items=readStorage();
        if(items !=null){
            items.forEach(function(item){
                storageItems.push(item);
            });
        }
        //if we have items in storage, add
        if(storageItems.length > 0){

            let inStorage=false;
            //check if product id is in the storage cart.if it is, update ordered_quantity
            storageItems.forEach(function(item){
                if(item.id==product.id){
                    inStorage=true;
                    item.ordered_quantity++;
                }
            });

            //if item is not in storage, add it
            if(!inStorage){
                storageItems.push(product);
            }

           //convert storage items to string and place it in local storage
            updateLocalStorage(storageItems);
        }else{
            //storage is empty so we add this product
            let arr=[];
            arr.push(product);
            updateLocalStorage(arr);

        }
    }

    //deletes existing data and puts new string
    function updateLocalStorage(arrayOfItemsInCart){
        localStorage.removeItem('webshopx');
        localStorage.setItem('webshopx', JSON.stringify(arrayOfItemsInCart));
       }


    // reads from storage if exists. if not, returns empty array
    function readStorage(){
        return localStorage.getItem('webshopx') ? JSON.parse(localStorage.getItem('webshopx')) : null;
    }

    function makeHtml(){
        let productsArr=[];
        let items=readStorage();
        if(items !=null){
            items.forEach(function(item){
                productsArr.push(item);
            });
        }
        let html="";
        if(productsArr !=null){
            productsArr.forEach(function(product){
                let row_total=calculatePrice(product.price, product.ordered_quantity, product.discount);

                html +=`
                <div class="row py-1 cart_row" data-row-total="${row_total}" data-name="${product.name}" data-id="${product.id}" data-quantity="${product.quantity}" data-discount="${product.discount}" data-price="${product.price}">

                    <div class="col-md-4 text-left text-justify">
                        ${product.name}
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="quantity_selector">
                            <button class="btn btn-sm btn-outline-danger text-small minus" > - </button>
                            <button class="btn btn-sm btn-success text-small quantity_selected" disabled>${product.ordered_quantity}</button>
                            <button class="btn btn-sm btn-outline-primary text-small plus"> + </button>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        ${formatPrice(product.price)}
                    </div>
                    <div class="col-md-1 text-center">
                        ${product.discount}%
                    </div>
                    <div class="col-md-2  text-center text-justify price">
                        ${formatPrice(row_total)}
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-outline-danger btn-sm btn_circle delete_row"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>`;
            });
        }else{
            html=`
            <div class="modal-header">
                <h5 class="modal-title">Your Cart Is Empty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            `;
            $('.modal-content').html(html)
        }

        $('#cart_table').html(html);
        calculateTotal();
    }

//returns 1.123.456,78
    function formatPrice(price){
        let price_float=parseFloat(price)
        return price_float.toLocaleString('de-DE', {minimumFractionDigits: 2, maximumFractionDigits: 2});

    }
    //calculates total order with discounts
    function calculateTotal(){
        let total=0;
        let totalDiscount=0;
        let totalWithoutDiscount=0;

        //loop through all .cart_row, find price and calculate
        $('.cart_row').each(function(){
            let orderedQuantity=parseInt($(this).find('.quantity_selected').text());

            total +=parseFloat($(this).attr('data-row-total'));
            totalDiscount +=parseFloat(orderedQuantity * $(this).attr('data-price') * $(this).attr('data-discount')/100);
            totalWithoutDiscount +=parseFloat($(this).attr('data-price') * orderedQuantity);
        });

        //console.log(prices)
        $('#cart_total').html(formatPrice(total));

            //only for checkout page
        let discountDiv=$('#discount');
        let totalWithoutDiscountDiv=$('#totalWithoutDiscount');

        if(discountDiv && totalWithoutDiscountDiv){
            $(discountDiv).html(formatPrice(totalDiscount));
            $(totalWithoutDiscountDiv).html(formatPrice(totalWithoutDiscount));
        }

    }

    function addPlusMinusListeners(){
        //plus listener
        $('.plus').on('click', function(event){

            //find product id
            let parent=$(this).closest('.cart_row');
            let product_id=$(parent).attr('data-id');
            //check if max quantity is larger than ordered quantity+1
            let max_quantity=parseInt($(parent).attr('data-quantity'));

            let ordered_quantity=parseInt($(this).prev().text());

            if(max_quantity < ordered_quantity+1){
                //customer wants to order more than we have on stock
                let name=$(parent).attr('data-name');
                $('.modal-title').html('Your Cart<small class="text-danger"> We don\'t have any more ' +name+ ' on stock</small>');
                setTimeout(function(){
                    $('.modal-title').html('Your Cart');
                },3000);
            }else{
                //update quantity in local storage and html
                updateQuantity(parent, "plus", ordered_quantity);
            }

        });
        //minus listener
        $('.minus').on('click', function(){

            //find product id
            let parent=$(this).closest('.cart_row');
            let product_id=$(parent).attr('data-id');

            //check if ordered quantity-1 is lower than 0 (we can have 0 ordered, it will not be on invoice)
            let ordered_quantity=parseInt($(this).next().text());

            //if it is, show message, if not, update ordered quantity
            if(ordered_quantity-1 <0) {
                //customer wants to order less than 0
                let name = $(parent).attr('data-name');
                $('.modal-title').html('Your Cart<small class="text-danger"> Order of item ' + name + ' can not be less than 0</small>');
                setTimeout(function () {
                    $('.modal-title').html('Your Cart');
                }, 3000);
            }else{
                //update in local storage and html
                updateQuantity(parent, "minus", ordered_quantity);
            }

        });

    }

    //only for plus and minus quantities listeners
    function updateQuantity(parentObj, operation, ordered_quantity){

        if(operation=="minus"){
            $(parentObj).find('.quantity_selected').text(parseInt(ordered_quantity-1));
        }else{
            $(parentObj).find('.quantity_selected').text(parseInt(ordered_quantity+1));
        }

        let new_quantity=parseInt($(parentObj).find('.quantity_selected').text());
        let price=parseFloat($(parentObj).attr('data-price'));
        let discount=parseFloat($(parentObj).attr('data-discount'));

        //new_price is new_quantity * price - discount (only for this article)
        let new_price=calculatePrice(price, new_quantity, discount);
        $(parentObj).attr('data-row-total', new_price);

        //put new price  in html
        $(parentObj).find('.price').html(formatPrice(parseFloat(new_price)));
        calculateTotal();
        //change local storage
        let storageItems=readStorage();
        storageItems.forEach(function(item){
            if(item.id==parseInt($(parentObj).attr('data-id'))){
                if(operation=="minus"){
                    item.ordered_quantity--;
                }else{
                    item.ordered_quantity++;
                }

            }
        });

        updateLocalStorage(storageItems);
    }



    function calculatePrice(price, qty, discount){
        return (price*qty-price*qty*discount/100).toFixed(2);
    }

    function addDeleteListeners() {
        //when we click red circle with class btn_circle, that row must be removed from html and local storage
        $('.delete_row').on('click', function () {
            //get product id
            let productHtml=$(event.target).closest('.cart_row');
            let product_id = $(productHtml).attr('data-id');

            //remove that product object from local storage
            let productsArr=readStorage();
            productsArr.forEach(function(product, index){
                if(product.id==product_id){
                    //we have found this product and we need to remove it
                    productsArr.splice(index, 1);
                }
            });
            //update local storage
            updateLocalStorage(productsArr);

            //remove div from html
            $(productHtml).css('background', 'red').hide('slow', function(){
                $(this).remove();
                calculateTotal();
            });

        });
    }







