<template>
  <div>
    <h2>Register</h2>
    <form @submit.prevent="register">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="name" required />
      </div>
      <div>
        <label for="surname">Surname:</label>
        <input type="text" id="surname" v-model="surname" required />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
        <div v-if="errors.email" class="error-message">{{ errors.email[0] }}</div>
      </div>
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required />
        <div v-if="errors.username" class="error-message">{{ errors.username[0] }}</div>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
        <div v-if="errors.password" class="error-message">{{ errors.password[0] }}</div>
      </div>
      <div>
        <label for="c_password">Confirm Password:</label>
        <input type="password" id="c_password" v-model="c_password" required />
        <div v-if="errors.c_password" class="error-message">{{ errors.c_password[0] }}</div>
      </div>
      <button type="submit">Register</button>
    </form>
    <div v-if="errorMessage" class="error-message">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axiosInstance from '@/services/api'

export default defineComponent({
  name: 'RegisterView',
  data() {
    return {
      name: '',
      surname: '',
      email: '',
      username: '',
      password: '',
      c_password: '',
      errorMessage: '',
      errors: {
        email: [],
        username: [],
        password: [],
        c_password: [],
      },
    }
  },
  methods: {
    async register() {
      this.errorMessage = ''
      this.errors = { email: [], username: [], password: [], c_password: [] }

      try {
        const response = await axiosInstance.post('/register', {
          name: this.name,
          surname: this.surname,
          email: this.email,
          username: this.username,
          password: this.password,
          c_password: this.c_password,
        })

        if (response.data.success) {
          // @todo check what we can do with this message.
          this.$router.push({ name: 'Login', query: { message: 'Registration successful!' } })
        }
      } catch (error) {
        if (error.response && error.response.data) {
          const { data } = error.response.data
          if (data.email) this.errors.email = data.email
          if (data.username) this.errors.username = data.username
          if (data.password) this.errors.password = data.password
          if (data.c_password) this.errors.c_password = data.c_password

          this.errorMessage = 'Validation Error. Please check the errors below.'
        } else {
          this.errorMessage = 'An unexpected error occurred.'
        }
        console.error('Error registering:', error)
      }
    },
  },
})
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 5px;
  font-size: 0.9em;
}
</style>