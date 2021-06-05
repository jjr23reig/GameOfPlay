<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                UserPage
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex sm:flex-row flex-col ">
                <card-user :user="client" ></card-user>
                <card-buy :games="games"  ></card-buy>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CardUser from '@/Jetstream/CardUser'
    import CardBuy from '@/Jetstream/CardBuy'

    export default {
        components: {
            AppLayout,
            CardUser,
            CardBuy
        },
        props:['client','games']
    }
</script>