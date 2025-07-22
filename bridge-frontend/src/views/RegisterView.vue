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
      </div>
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <div>
        <label for="c_password">Confirm Password:</label>
        <input type="password" id="c_password" v-model="c_password" required />
      </div>
      <button type="submit">Register</button>
    </form>

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