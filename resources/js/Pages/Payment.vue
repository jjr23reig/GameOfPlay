<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" id="stripe" method="post" autocomplete="off">
                        <input id="card-holder-name" type="text">
                        
                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element"></div>
                        <input name="pmethod" type="hidden" id="pmethod" value="" />
                        <button id="card-button">
                            Process Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'

    

    export default {
        components: {
            AppLayout,
        },
         methods: {
            submit() {
                this.form.post(this.route('addcart'))
            }
        },
        mounted() {
            const stripe = Stripe('{{ env("STRIPE_KEY") }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const form = document.getElementById('stripe');


            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );
                if (error) {
                    // Display "error.message" to the user...
                } else {
                    console.log('Card verified successfully');
                    console.log(paymentMethod.id);
                    document.getElementById('pmethod').setAttribute('value', paymentMethod.id);
                    form.submit();
                }
            });

        }
    }
    
</script>