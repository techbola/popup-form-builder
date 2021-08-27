<template>
  <div class="builder-container">
    <h2 class="text-center">PREVIEW</h2>
    <div class="main-editor d-flex flex-column justify-content-center align-items-center mx-auto" :style="{ 'background': bgColor }">
      <draggable :list="updatedBuilderData" :options="{ animation: 200 }" @change="updateBuilderData">
        <div v-for="(field, i) in updatedBuilderData" :key="i" class="field-block">
          <div v-if="field.type === 'star'" class="text-center">
            <StarIcon v-for="(n, i) in 3" :key="i" class="mr-2" :class="{ 'mb-4 big-star': n === 2}" />
          </div>
          <div v-if="field.type === 'text'" class="form-item" :style="{ 'color': field.color }">
            <h2 class="text-center">{{ field.value }}</h2>
          </div>
          <div v-if="field.type === 'input'" class="form-item">
            <input type="text" class="form-control" :placeholder="field.placeholder">
          </div>
          <div v-if="field.type === 'button'" class="form-item">
            <button class="btn btn-dark btn-lg btn-block text-uppercase">{{ field.value }}</button>
          </div>
        </div>
      </draggable>
      <p>
        No credit card is required. No Surprises
      </p>
    </div>
  </div>
</template>

<script>
import { StarIcon } from "@vue-hero-icons/outline";
import draggable from 'vuedraggable'

export default {
  name: "Preview",
  props: {
    builderData: Array,
    bgColor: String
  },
  components: {
    StarIcon,
    draggable,
  },
  data() {
    return {
      updatedBuilderData: []
    }
  },
  mounted() {
    this.updatedBuilderData = this.builderData
  },
  methods: {
    updateBuilderData() {
      this.$emit('update-builder-data', this.updatedBuilderData)
    }
  }
}
</script>

<style scoped lang="scss">
.builder-container {
  .main-editor {
    width: 450px;
    height: 450px;
    border-radius: 100%;

    .field-block {
      cursor: pointer;
      width: 75%;
      margin: 0 auto;
      padding: 10px;
      &:hover {
        border: 1px dashed #040505;
      }
    }
  }
}
.big-star {
  width: 30px !important;
  height: 30px !important;
}
</style>