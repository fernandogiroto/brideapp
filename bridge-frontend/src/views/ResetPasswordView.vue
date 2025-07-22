<template>
  <div>
    <h2>Reset Password</h2>
    <form @submit.prevent="resetPassword">
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <div>
        <label for="password_confirmation">Password Confirmation:</label>
        <input
          type="password"
          id="password_confirmation"
          v-model="password_confirmation"
          required
        />
      </div>
      <button type="submit">Reset</button>
    </form>


  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axiosInstance from '@/services/api'

export default defineComponent({
  name: 'ResetPasswordView',
  data() {
    return {
      password: '',
      password_confirmation: '',
      token: '',
      email: '',
      errorMessage: '',
      successMessage: '',
    }
  },
  created() {
    this.token = this.$route.query.token as string
    this.email = this.$route.query.email as string
  },
  methods: {
    async resetPassword() {
      this.errorMessage = ''
      this.successMessage = ''

      if (this.password !== this.password_confirmation) {
        this.errorMessage = 'Passwords do not match.'
        return
      }

      try {
        const response = await axiosInstance.post('/reset-password', {
          password: this.password,
          password_confirmation: this.password_confirmation,
          email: this.email,
          token: this.token,
        })

        if (response.data.message) {
          this.successMessage = response.data.message
          // Redirect to Login page.
          setTimeout(() => {
            this.$router.push({ name: 'Login' })
          }, 2000)
        }
      } catch (error) {

      }
    },
  },
})
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 10px;
}

.success-message {
  color: green;
  margin-top: 10px;
}
</style>