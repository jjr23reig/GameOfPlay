<template>
    <div class=" bg-gray-900 p-5 flex flex-col sm:w-80 w-full" style="height:210px" >
        <h1 class="text-purple-500 text-2xl">Datos del usuario</h1>
        <h3>Name: {{user.name}}</h3>
        <h3>Surname: {{user.surname}}</h3>
        <h3>Nickname: {{user.nick}}</h3>
        <h3>Email: {{user.email}}</h3>
    </div>
</template>
<script>
    export default {
        props: ['user'],

    }
</script>