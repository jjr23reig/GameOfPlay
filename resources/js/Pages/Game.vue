<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
               <div class=" overflow-hidden shadow-xl sm:rounded-lg bg-gray-900 sm:rounded-xl p-0 mb-8 h-full flex flex-col relative  ">
                    <img v-bind:src="game.photo" alt="" class="sm:rounded-xl ">
                    <div class=" bg-gray-900 text-gray-100 absolute sm:bottom-0 -bottom-3 inset-x-0  lg:h-96 h-44  p-8 leading-loose">
                        <span class="absolute -top-10 text-white  text-2xl font-bold" style="text-stroke: 1px black">{{game.age}}</span>
                        <p class="text-purple-500 font-bold lg:text-7xl text-2xl ">
                            {{game.name}}
                            <span class="text-gray-100 text-2xl absolute right-10 ">{{game.price}}€</span>
                        </p>
                        <p class="font-bold lg:mt-5 lg:text-2xl">{{game.gender}}</p>
                        <span class="lg:block hidden mt-5">{{game.description}}</span>

                        <form @submit.prevent="submit" class="absolute sm:bottom-5 bottom-8 sm:right-10 mr-2">
                            <jet-input type="hidden" class="mt-1 block w-full" v-model="form.idGame" />
                            <jet-input type="hidden" class="mt-1 block w-full" v-model="form.idUser" />
                            <jet-button class="ml-4"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                add to cart <i class="fas fa-cart-plus  ml-2 "></i>
                            </jet-button>
                        </form>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'

    export default {
        data(){
            return{
                form: this.$inertia.form({
                     idGame: this.game.id,
                     idUser: this.user.id
                })
            }
        },
        props:['game','user'],
        components: {
            AppLayout,
            Welcome,
            JetInput,
            JetButton
        },
        methods: {
            submit() {
                this.form.post(this.route('addcart'))
            }
        }
    }
</script>