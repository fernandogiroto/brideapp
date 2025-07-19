<template>
  <Teleport to="#app">
    <div class="backdrop" v-if="isOpenModal" @click="toggleModal"></div>
    <div class="modal" v-if="isOpenModal">
      <div class="modal__content bottom-to-top--effect" v-show="isOpenModal">
        <slot name="content"></slot>
      </div>
    </div>
  </Teleport>
</template>

<script lang="ts" setup>
  import { ref, watch } from 'vue';

  const props = defineProps({
    isModalScan: { type: Boolean, default: false },
    isModalOpen: { type: Boolean, default: false },
    padding: { type: String, default: '25px' },
    width: { type: String, default: '100%' },
    widthTablet: { type: String, default: '80%' },
    widthDesktop: { type: String, default: '50%' },
    title: { type: String },
    background: { type: String, default: 'var(--theme-color)' },
    boxShadow: { type: String, default: '0 4px 8px rgba(0, 0, 0, 0.2)' }
  });

  const isOpenModal = ref(props.isModalOpen);

  const emit = defineEmits(['update:isModalOpen']);

  const toggleModal = () => {
    isOpenModal.value = !isOpenModal.value;
    emit('update:isModalOpen', isOpenModal.value);
  };

  watch(
    () => props.isModalOpen,
    (newVal) => {
      isOpenModal.value = newVal;
    }
  );
</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';

  .modal {
    @include mixings.flexbox(column, center, center);
    width: 100%;
    height: 100%;
    position: absolute;
    &__content {
      width: v-bind(width);
      @include mixings.flexbox(column, center, center);
      position: relative;
      background-color: v-bind(background);
      z-index: 1000;
      padding: v-bind(padding);
      border-radius: 8px;
      box-shadow: v-bind(boxShadow);
      @media (min-width: variables.$md-breakpoint) {
        width: v-bind(widthTablet);
      }
      @media (min-width: variables.$lg-breakpoint) {
        width: v-bind(widthDesktop);
      }
    }
  }

  .modal-content {
    @include mixings.flexbox(column, center, center);
    gap: 35px;
    &__info {
      @include mixings.flexbox(column, center, center);
      gap: 15px;
      &--title {
        color: var(--Grey-Scale-Black, #000);
        text-align: center;
        font-family: 'Open Sans';
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: 22px;
      }
      &--description {
        color: var(--Grey-Scale-Black, #000);
        text-align: center;
        /* Body/M/reg */
        font-family: 'Open Sans';
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 22px;
      }
    }
    &__actions {
      @include mixings.flexbox(row, center, center);
      gap: 15px;
    }
  }
</style>
