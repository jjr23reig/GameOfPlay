<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                Faqs from client {{client.name}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg flex flex-col justify-end " style="height:730px">
                    <div v-for="faq in faqs" :key="faq.id" class="p-5">
                        <p>Pregunta: {{faq.ask}}</p>
                        <p v-if="faq.answer">Respuesta: {{faq.answer}}</p>
                        <inertia-link :href="route('respondFaq', faq.id)" v-if="!faq.answer">
                                <jet-button class="ml-4 mt-4" style="padding:7px 17px; height:40px" >
                                       respond<i class="fas fa-arrow-alt-circle-right ml-2"></i>
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

    export default {
        props:['faqs','client'],
        components: {
            AppLayout,
            JetButton
        },
        data(){
            return{
                form: this.$inertia.form({
                     faq: '',
                     id: this.client.id
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('respondFaq'), {
                    onFinish: () => this.form.reset('faq'),
                })
            }
        }
    }
</script>