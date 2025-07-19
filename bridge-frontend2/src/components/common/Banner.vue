<template>
  <div
    :class="['banner-jogo', bannerType === 'end' ? 'banner-jogo--end' : '', bannerType === 'initial' ? 'banner-jogo--initial' : '', bannerType === 'center' ? 'banner-jogo--center' : '', { 'banner-jogo--loading': !isImageLoaded }]"
    :style="{
      backgroundImage: isImageLoaded ? replaceSpaces(background) : 'none'
    }"
  >
    <div class="banner-jogo__info" v-if="isImageLoaded">
      <h1 class="banner-jogo__info--title" v-if="showTitle">{{ title }}</h1>
      <h2 class="banner-jogo__info--subtitle" v-if="showSubtitle">
        {{ subtitle }}
      </h2>
      <slot name="action"></slot>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { ref, onMounted, watch } from 'vue';
  const props = defineProps({
    bannerType: { type: String },
    background: { type: String },
    justify: { type: String, default: 'center' },
    mobileHeight: { type: String, default: '100%' },
    infoPadding: { type: String, default: '32px 55px' },
    showTitle: { type: Boolean, default: true },
    title: { type: String },
    titleSize: { type: String, default: '2.5rem' },
    titleWeight: { type: String, default: '700' },
    titleTransform: { type: String, default: 'none' },
    showSubtitle: { type: Boolean, default: true },
    subtitle: { type: String }
  });

  const isImageLoaded = ref(false);

  const loadImage = (src: any) => {
    isImageLoaded.value = false;
    const img = new Image();
    img.src = src;
    img.onload = () => {
      isImageLoaded.value = true;
    };
  };

  watch(
    () => props.background,
    (newSrc) => {
      if (newSrc) {
        loadImage(newSrc);
      }
    }
  );

  const replaceSpaces = (url: any) => {
    return url ? `url('${url.replace(/ /g, '%20')}')` : '';
  };

  onMounted(() => {
    if (props.background) {
      loadImage(props.background);
    }
  });
</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';

  .banner-jogo {
    @include mixings.flexbox(column, v-bind(justify), center);
    align-self: stretch;
    gap: 32px;
    height: v-bind(mobileHeight);
    padding: 32px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    &__info {
      @include mixings.flexbox(column, center, center);
      gap: 16px;
      width: auto;
      padding: v-bind(infoPadding);
      background: rgba(16, 24, 32, 0.4);
      &--title {
        color: var(--light-color);
        font-size: v-bind(titleSize);
        font-weight: v-bind(titleWeight);
        line-height: normal;
        text-transform: v-bind(titleTransform);
        text-align: center;
        @media (max-width: variables.$md-breakpoint) {
          font-size: 20px;
        }
      }
      &--subtitle {
        color: var(--light-color);
        font-size: 1.5rem;
        font-weight: 400;
        line-height: normal;
        padding-bottom: 10px;
        @media (max-width: variables.$md-breakpoint) {
          font-size: 15px;
          margin-bottom: 10px;
        }
      }
      @media (max-width: variables.$md-breakpoint) {
        gap: 5px;
      }
    }
    &--initial {
      align-items: flex-start;
      @media (max-width: variables.$md-breakpoint) {
        @include mixings.flexbox(column, center, center);
      }
    }
    &--end {
      align-items: end;
      @media (max-width: variables.$md-breakpoint) {
        @include mixings.flexbox(column, center, center);
      }
    }
    @media (min-width: variables.$xl-breakpoint) {
      height: 100%;
      height: 490px;
      background-position: top;
      @include mixings.flexbox(column, v-bind(justify), center);
    }
  }
</style>
