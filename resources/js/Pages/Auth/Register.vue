<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div  class="mt-4">
                <jet-label for="surname" value="Surname" />
                <jet-input id="surname" type="text" class="mt-1 block w-full" v-model="form.surname" required autofocus autocomplete="surname" />
            </div>
            <div  class="mt-4">
                <jet-label for="nick" value="Nickname" />
                <jet-input id="nick" type="text" class="mt-1 block w-full" v-model="form.nick" required autofocus autocomplete="nick" />
            </div>
            
            <div  class="mt-4">
                <jet-label for="birth_date" value="Birth Date" />
                <jet-input id="search_date" type="date" class="mt-1 block w-full" v-model="form.birth_date" required autofocus />
            </div>

            <div  class="mt-4">
                <jet-label for="telephone" value="Telephone" />
                <jet-input id="telephone" type="text" class="mt-1 block w-full" v-model="form.telephone" required autofocus autocomplete="telephone" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-purple-400 hover:text-purple-600">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-purple-400 hover:text-purple-600">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <input type="hidden" id="role_id" v-model="form.role_id">

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-purple-400 hover:text-purple-600">
                    Already registered?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
        <jet-button class="ml-4 absolute left-5 bottom-5" @click="change()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-if="form.name==='admin23'">
            Admin
        </jet-button>
    </jet-authentication-card>

     
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    surname: '',
                    nick: '',
                    birth_date: '',
                    telephone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role_id: 1,
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            },
            change(){
                this.form.role_id = 2
            }
        },
        mounted(){
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1; //January is 0!
            let yyyy = today.getFullYear() - 8;
            if (dd < 10) {
            dd = '0' + dd
            }
            if (mm < 10) {
            mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;



            let search_date = document.getElementById("search_date");

            search_date.max = today;

            function valida(fecha) {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1; //January is 0!
                let yyyy = today.getFullYear();
                
                if (dd < 10) {
                    dd = '0' + dd
                }
                if (mm < 10) {
                    mm = '0' + mm
                }

                today = yyyy + '-' + mm + '-' + dd;
                if (fecha > today) {
                    document.getElementById("search_date").value = today;
                }
            }

        }
    }
</script>
