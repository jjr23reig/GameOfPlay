<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                Store
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden sm:rounded-lg ">
                    <div v-for="game in games" :key="game.id" class="bg-gray-900 sm:rounded-xl p-0 mb-8 sm:h-60 h-40 flex flex-row">
                        <img v-bind:src="game.photo" alt=""  class="sm:rounded-xl sm:h-60 h-40">
                        <div class="w-full relative rounded-sm flex flex-col text-gray-100 sm:p-5 p-2">
                            <span>{{game.name}}</span>
                            <span class="mb-4">{{game.gender}}</span>
                            <span class="lg:block hidden">{{game.description}}</span>
                            <span class="absolute bottom-3 -left-10 text-white  text-2xl font-bold" style="text-stroke: 1px black">{{game.age}}</span>
                            <inertia-link :href="route('gamepage', game.id)">
                                <jet-button class="absolute bottom-5 sm:right-10 mr-2 ">{{game.price}}€</jet-button>
                            </inertia-link>
                            
                            
                        </div>
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

    export default {
        props:['games'],
         data() {
            return {
                description: false,
            }
        },
        components: {
            AppLayout,
            Welcome,
            JetButton
            },
    }
</script>
