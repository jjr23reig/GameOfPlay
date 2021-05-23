<template>
    <app-layout >
            <pre>{{intent.client_secret}}</pre>
           <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-5">
                        <h1 class="text-lg mb-5">Añadir card</h1>
                        <input id="card-holder-name" class="text-black h-10" type="text" placeholder="Name">

                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element" class="bg-gray-100 h-6"></div>

                        <button id="card-button" data-secret="{{intent.client_secret }}">
                            Update Payment Method
                        </button>
                    </div>
                </div>
            </div>
        </div>

           
                
                
            
        
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
export default {
    components:{
         AppLayout,
     },
     props:['intent'],
    mounted(){

        const stripe = Stripe('pk_test_F0X8kR85JYHrmqV93pPaAewe00nNCSpWwA');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', async (e) => {
            const { setupIntent, error } = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                payment_method_data: {
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
            if (error) {
                // Display "error.message" to the user...
            } else {
                $.post({
                    url: '/card-save',
                    data: {
                        card: setupIntent["payment_method"],
                        _token: "{{ csrf_token() }}",
                    }
                })
            }
        });
    }
}
</script>