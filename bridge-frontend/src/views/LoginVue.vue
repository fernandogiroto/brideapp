<template>
  <div class="login">
    <h1>Login</h1>
    <form @submit.prevent="handleLogin" class="form">
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Senha" required />
      <button type="submit">Entrar</button>
    </form>
  </div>
</template>

<script setup lang="ts">

  import { ref } from 'vue'
  import { login } from '@/services/authService';

  const email = ref('')
  const password = ref('')

  const handleLogin = async () => {
    await login(email.value, password.value)
  }

</script>

<style lang="scss">

  @use '@/scss/mixings';
  @use '@/scss/variables';

  .login{
    @include mixings.flexbox(column, center, center);
    gap: 20px;
    width: 100%;
    height: 100%;
  }

  .form{
    @include mixings.flexbox(column, center, center);
    gap: 20px;
  }

</style>