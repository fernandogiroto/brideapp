<template>
  <div class="home">
    <button @click="apiTestData">Fetch Test Data</button>
    <span>{{ responseMessage }}</span>
   <Button>teste</Button>
  </div>
</template>

<script lang="ts" setup>

  import { ref } from 'vue'
  import { fetchTestData } from '@/utils/globals';
  import Button from "primevue/button"

  const responseMessage = ref<string>('')
  const apiTestData = async () => {
    const result = await fetchTestData()
    responseMessage.value = result
  }  

</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';

  

  .home {
    @include mixings.flexbox(column, center, center);
    width: 100%;
    height: 100%;
    padding: 20px;
  }

</style>
