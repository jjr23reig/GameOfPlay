<template>
    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-800">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <jet-authentication-card-logo />
                </div>

                <div v-html="policy" class="w-full sm:max-w-2xl mt-6 p-6 bg-gray-700 shadow-md overflow-hidden sm:rounded-lg prose text-gray-100">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'

export default {
    props: ['policy'],

    components: {
        JetAuthenticationCardLogo,
    },
}
</script>
<style>
  .prose h1{
      color: #7C3AED;
  }
  .prose h2{
      color: #9b6fe7;
  }
  .prose ol > li::before{
      color: #F3F4F6;
  }
</style>
