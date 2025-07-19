<template>
  <div>
    <h2>Forgot Password</h2>
    <form @submit.prevent="forgotPassword">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <button type="submit">Enviar</button>
    </form>
    <div v-if="message">
      <pre>{{ message }}</pre>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axiosInstance from '@/services/api'

export default defineComponent({
  name: 'ForgotPasswordView',
  data() {
    return {
      email: '',
      message: '',
    }
  },
  methods: {
    async forgotPassword() {
      try {
        const response = await axiosInstance.post('/forgot-password', {
          email: this.email,
        })
        console.log(response.data)
        this.message = 'O link para resetar a password foi enviado para o seu email.'
      } catch (error) {
        // Exibir erros no console ou em uma mensagem para o usuário
        if (error.response && error.response.data && error.response.data.errors) {
          console.error('Failed:', error.response.data.errors)
        } else {
          console.error('Failed:', error)
        }
      }
    },
  },
})
</script>

<style scoped>
</style>