<template>
    <div class=" bg-gray-900 p-5 flex flex-col sm:w-80 w-full" style="height:260px" >
        <h1 class="text-purple-500 text-2xl">Datos del usuario</h1>
        <h3>Name: {{user.name}}</h3>
        <h3>Surname: {{user.surname}}</h3>
        <h3>Nickname: {{user.nick}}</h3>
        <h3>Email: {{user.email}}</h3>
        <inertia-link :href="route('userchat', user.id)" class="mt-4">
            <jet-button>Support</jet-button>
        </inertia-link>
    </div>
</template>
<script>
import JetButton from '@/Jetstream/Button'
    export default {
        components: {
            JetButton
        },
        props: ['user'],

    }
</script>