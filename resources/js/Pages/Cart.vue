<template>
    <app-layout >
        <div v-if="cantidad != 0" class="py-10">
            <div class="max-w-7xl mx-auto lg:px-8"> 
                <div class=" overflow-hidden bg-gray-900 lg:p-10 py-10 ">
                    <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                        Your shopping cart
                    </h2>
                    <div v-for="product in products" :key="product.id" class="bg-gray-800 mt-8  sm:h-20 h-20 flex flex-row rounded-l-xl">
                        <img v-bind:src="product.photo" alt=""  class="lg:rounded-xl sm:h-20 h-20">
                        <div class="relative rounded-sm flex flex-row text-gray-100 py-1 " style="max-width: 800px;">
                            <div class="mr-9 ml-5 mt-2" style="min-width: 100px; max-width: 300px;"> 
                                <p class="text-purple-500 text-2xl">{{product.name}}</p>
                                <p class="mt-1">{{product.gender}} </p>
                            </div>
                            <p class="lg:block hidden  max-w-lg text-justify">{{product.description}}</p>
                        </div>
                        <div style="min-width: 300px;" class="mt-6 mr-4 flex flex-row lg:justify-end justify-start z-10">
                            <p class="mr-5">{{product.price}}€</p>
                            <inertia-link :href="route('deletecart', product.idAtCart)">
                                <button class="h-6 w-6 inline-flex items-center justify-center bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </inertia-link>
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <h2 class="font-semibold  text-white leading-tight mt-8">
                            Your total buy is .................................. {{total}}€
                        </h2>
                        <inertia-link :href="route('payment', $page.props.user.id)">
                                    <jet-button class="ml-4 mt-4" style="padding:7px 17px; height:40px" >
                                        buy<i class="far fa-credit-card ml-2"></i>
                                    </jet-button>
                        </inertia-link>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import JetCountProducts from '@/Jetstream/CountProducts'

export default {
     props:['products'],
     components:{
         AppLayout,
         JetButton,
         JetCountProducts
         
     },
     computed:{
        total(){
            let num = this.products.map((product)=>{return product.price}).reduce((a,b)=>{return a+b});
            let signo = (num >= 0 ? 1 : -1);
            let decimales = 2;
            num = num * signo;
            if (decimales === 0) //con 0 decimales
                return signo * Math.round(num);
            // round(x * 10 ^ decimales)
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
            // x * 10 ^ (-decimales)
            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
            
        },
        cantidad(){
            return this.products.length;
        }
    },
}
</script>
