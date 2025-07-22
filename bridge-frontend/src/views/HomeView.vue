<template>
  <div class="home-page">
    <!-- <button @click="apiTestData">Fetch Test Data</button>-->
    <span>{{ responseMessage }}</span>
    <Card 
      :background="'var(--tertiary-color)'" 
      :headerType="'progress'"
      :headerIcon="'student'"
      :footerLabel="'Última Atulização - 22/07'"
      :footer="true">
      <template #progressIcon>
        <IconFileDescription color="var(--tertiary-color)" :size="30" stroke-width="2" />
      </template>
      <template #content>
        <ProgressBar :value="50" :showValue="false" :style="customStyle"></ProgressBar>
      </template>
    </Card>
    <div class="services-list">
      <Card 
        :background="'#F9F5FF'" 
        :title="'Visto de Residencia'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'student'"
        :headerIconBackground="'#C6D4F1'">
      </Card>
      <Card 
        :background="'#EDFCF2'" 
        :title="'Visto de Trabalho'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'work'"
        :headerIconBackground="'#D3F8DF'">
      </Card>
    </div>
  </div>
</template>

<script lang="ts" setup>

  import { ref } from 'vue'
  import { fetchTestData } from '@/utils/globals';

  import Card from '@/components/ui/Card.vue';
  import ProgressBar from 'primevue/progressbar';
  import { IconFileDescription } from '@tabler/icons-vue';

  const responseMessage = ref<string>('')
  const apiTestData = async () => {
    const result = await fetchTestData()
    responseMessage.value = result
  }  

  const customStyle = {
    '--p-progressbar-value-background': 'var(--secondary-color)',
    height: '10px',
    backgroundColor: 'var(--theme-color)'
  };
  


</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';
  
  .home-page {
    @include mixings.flexbox(column, initial, center);
    flex: 1;
    gap: 20px;
    width: 100%;
    height: 100%;
    padding: 10px 20px;
  }

  .services-list {
    @include mixings.flexbox(row, center, center);
    gap: 20px;
    width: 100%;
  }

</style>
