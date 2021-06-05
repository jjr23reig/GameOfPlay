<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-purple-500 leading-tight">
                Support
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg flex flex-col justify-end">
                    <div class="overflow-y-scroll">
                        <div class="p-5">
                            <p>Pregunta: {{faq.ask}}</p>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="w-full p-2 bg-gray-700 ">
                        <div>
                            <input type="text" id="faq" v-model="form.faq" class="w-full">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        props:['faq'],
        components: {
            AppLayout,
            Welcome,
        },
        data(){
            return{
                form: this.$inertia.form({
                     faq: '',
                     id: this.faq.id
                })
            }
        },
        methods: {
            submit() {
            
                this.form.post(this.route('addFaq'), {
                    onFinish: () => this.form.reset('faq'),
                })
            }
        }
    }
</script>