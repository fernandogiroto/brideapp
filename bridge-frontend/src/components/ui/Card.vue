<template>
  <div class="card">
    <div class="card-header" v-if="header">
        <div class="card-icon" v-if="headerType=='icon'">
            <img src="@/assets/icons/passport.png" alt="" width="40" height="40" v-if="headerIcon=='residence'">
            <img src="@/assets/icons/visa-travel.png" alt="" width="40" height="40" v-if="headerIcon=='travel'">
            <img src="@/assets/icons/visa-student.png" alt="" width="40" height="40" v-if="headerIcon=='student'">
            <img src="@/assets/icons/visa-documents.png" alt="" width="40" height="40" v-if="headerIcon=='documents'">
        </div>
        <div class="card-progress" v-if="headerType=='progress'">
           <div class="card-progress__icon">
                <slot name="progressIcon" />
           </div>
            <div class="card-progress__info">
                <span class="card-progress__info--label">Visto de Estudante</span>
                <span class="card-progress__info--lawyer">Luis Gama</span>
           </div>
            <div class="card-progress__action">
                <span class="card-progress__action--label">Ver Detalhes</span>
                <IconChevronRight color="var(--theme-color)" :size="15" stroke-width="2" />
           </div>
        </div>
    </div>
    <div class="card-content">
        <span class="card-content__title" v-if="title">
            {{ title }}
        </span>
        <span class="card-content__description" v-if="description">
            {{ description }}
        </span>
        <slot name="content" />
    </div>
    <div class="card-footer" v-if="footer">
        <span class="card-footer__label">
            {{ footerLabel }}
        </span>
    </div>
  </div>
</template>

<script setup lang="ts">

  import { IconChevronRight } from '@tabler/icons-vue';


  const props = defineProps({
    header: { type: Boolean, default: true },
    headerType: { type: String },
    headerIcon: { type: String },
    headerIconBackground: { type: String },
    footer: { type: Boolean, default: false },
    footerLabel: { type: String },
    background: { type: String, default: 'var(--theme-color)' },
    title: { type: String },
    description: { type: String },
  });

</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';

    .card {
        @include mixings.flexbox(column, initial, initial);
        gap: 15px;
        width: 100%;
        background: v-bind('background');
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 1rem;
        &-header {
            @include mixings.flexbox(row, initial, initial);
            .card-icon {
                border-radius: 8px;
                padding: 5px;
                background: v-bind('headerIconBackground');
                border: 2px solid v-bind('headerIconBackground');
                width: auto;
            }
            .card-progress {
                @include mixings.flexbox(row, initial, initial);
                gap: 10px;
                width: 100%;
                &__icon {
                    border-radius: 8px;
                    padding: 5px;
                    background: var(--theme-color);
                    border: 2px solid v-bind('headerIconBackground');
                    width: auto;
                }
                &__info {
                    @include mixings.flexbox(column, center, initial);
                    gap: 5px;
                    &--label {
                        color: var(--theme-color);
                        font-size: 12px;
                        font-weight: 500;
                    }
                    &--lawyer {
                        @include mixings.flexbox(row, initial, center);
                        color: var(--theme-color);
                        font-size: 14px;
                        font-weight: 600;
                    }
                }
                &__action {
                    @include mixings.flexbox(row, flex-end, initial);
                    flex: 1;
                    gap: 5px;
                    &--label {
                        color: var(--theme-color);
                        font-size: 12px;
                        font-weight: 600;
                    }
                }
            }
        }
        &-content {
            @include mixings.flexbox(column, center, initial);
            gap: 0.5rem;
            &__title {
                font-size: 15px;
                font-weight: 600;
            }
            &__description {
                font-size: 14px;
                font-weight: 400;
                color: var(--neutral-10);
            }
        }
        &-footer {
            &__label {
                color: var(--theme-color);
                font-size: 12px;
                font-weight: 400;
            }
        }
    }
</style>
