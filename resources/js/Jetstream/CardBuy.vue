<template>
    <div class=" lg:px-40 sm:px-10 px-0  w-3/4 sm:mt-0  mt-10 ">
         <table class="bg-gray-900 sm:rounded-xl p-0 mb-8 w-full">
            <tr>
                <th>Name</th>
                <th class="">Gender</th>
                <th class="xl:table-cell hidden">Description</th>
                <th>Photo</th>
            </tr>
            <tr v-for="game in games" :key="game.id" class="bg-gray-700 sm:h-20  border-b-2 border-gray-800">
                <td class="text-center p-2  ">{{game.name}}</td>
                <td class="text-center  p-2 ">{{game.gender}}</td>
                <td class="text-justify  p-2  xl:table-cell hidden">{{game.description}}</td>
                <td style="min-width: 200px"><img v-bind:src="game.photo" alt=""  class=" w-full"></td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        props: ['games'],

    }
</script>