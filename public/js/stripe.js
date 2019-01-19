// Create a Stripe client
var stripe = Stripe('pk_test_BUBtWBX5IGC1ORIaHzzYoRtu');

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: 'Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element
var card = elements.create('card', {
    style: style,
    hidePostalCode: true
});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Disable the submit button to prevent repeated clicks
    document.getElementById('complete-order').disabled = true;

    var options = {
        name:document.getElementById('users_name').innerText,

    };

    stripe.createToken(card, options).then(function(result) {
        if (result.error) {

            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            // Enable the submit button
            document.getElementById('complete-order').disabled = false;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    //we send for each ordered product id and quantity to the server to place order
    var order=[];
    var productsInStorage=readStorage();
    productsInStorage.forEach(function(product){
        if(product.ordered_quantity>0){
            order.push({id:product.id, ordered_quantity:product.ordered_quantity});
        }

    });
    if(order.length){
        var orderInput = document.createElement('input');
        orderInput.setAttribute('type', 'hidden');
        orderInput.setAttribute('name', 'order');
        orderInput.setAttribute('value', JSON.stringify(order));
        form.appendChild(orderInput);

        // Submit the form
        form.submit();
    }

}