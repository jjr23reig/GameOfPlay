<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight" v-if="$page.props.user.role_id == 1">
                Store
            </h2>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight" v-if="$page.props.user.role_id == 2">
                Users List
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden sm:rounded-lg " v-if="$page.props.user.role_id == 1">
                    <div v-for="game in games" :key="game.id" class="bg-gray-900 sm:rounded-xl p-0 mb-8 sm:h-60 h-40 flex flex-row" >
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
                <div class=" sm:rounded-lg " v-if="$page.props.user.role_id == 2">
                    <table class="bg-gray-900 sm:rounded-xl p-0 mb-8 w-full">
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Nickname</th>
                            <th class="sm:table-cell hidden">Email</th>
                            <th>Telephone</th>
                        </tr>
                        <tr v-for="user in users" :key="user.id" class="bg-gray-700 h-20">
                            <td class="text-center">{{user.name}}</td>
                            <td class="text-center">{{user.surname}}</td>
                            <td class="text-center">{{user.nick}}</td>
                            <td class="text-center sm:table-cell hidden">{{user.email}}</td>
                            <td class="text-center">{{user.telephone}}</td>
                            <td class="text-center">
                                <inertia-link :href="route('userpage', user.id)">
                                    <jet-view-button>Datos</jet-view-button>
                                </inertia-link>
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetButton from '@/Jetstream/Button'
    import JetViewButton from '@/Jetstream/ViewButton'

    export default {
        props:['games','users'],
         data() {
            return {
                description: false,
            }
        },
        components: {
            AppLayout,
            Welcome,
            JetButton,
            JetViewButton
            },
    }
</script>
