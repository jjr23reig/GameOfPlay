<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Library
            </h2>
        </template>

       <div class="py-10">
            <div class="max-w-7xl mx-auto ">
                <card-library :games="games"></card-library>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CardLibrary from '@/Jetstream/CardLibrary'

    export default {
        components: {
            AppLayout,
            CardLibrary,
        },
        props:['games']
    }
</script>