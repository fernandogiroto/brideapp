<template>
<Listbox v-model="selectedCountry" :options="countries" optionLabel="name" class="w-full md:w-56" listStyle="max-height:250px">
    <template #option="slotProps">
        <div class="flex items-center">
            <img :alt="slotProps.option.name" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`flag flag-${slotProps.option.code} mr-2`" style="width: 18px" />
            <div>{{ slotProps.option.name }}</div>
        </div>
    </template>
</Listbox>
</template>

<script lang="ts" setup>


import Listbox from 'primevue/listbox';
import { ref } from 'vue';
const selectedCountry = ref(null);
const countries = ref([
    { name: 'United States', code: 'US' },
    { name: 'Canada', code: 'CA' },
    { name: 'United Kingdom', code: 'GB' },
    { name: 'Australia', code: 'AU' },
    { name: 'Germany', code: 'DE' }
]);
</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';
  
</style>



