<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                News
            </h2>
        </template>

       <div class="py-10">
            <div class="max-w-7xl mx-auto flex flex-row flex-wrap justify-between">
                <div v-for="newsl in news" :key="newsl.id" >
                        <div  class=" w-96 bg-gray-900 sm:rounded-xl p-0 mb-8  flex flex-col p-5 items-center mr-9">
                            <span class=" text-purple-500 text-4xl">{{newsl.title}}</span>
                            <span style=" max-width: 300px" class="text-justify mt-2">{{newsl.content}}</span>
                        </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props:['news']
    }
</script>