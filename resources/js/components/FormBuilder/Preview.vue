<template>
  <div>
    <h2 class="text-center">PREVIEW</h2>
    <div class="main-editor" :style="{ 'background': bgColor }">
      <template v-for="(field, i) in updatedBuilderData">
        <vue-draggable-resizable
          v-if="field.type === 'star'"
          class-name="star-popup-field"
          :w="105"
          :h="40"
          @dragstop="onDrag"
          :parent="false"
          @activated="onActivated('star')"
          :style="{ position: 'absolute', top: initialStarPositions.top+'px', left: initialStarPositions.left+'px' }"
        >
          <StarIcon v-for="(n, i) in 3" :key="i" class="mr-2" :class="{ 'mb-4 big-star': n === 2}" />
        </vue-draggable-resizable>

        <vue-draggable-resizable
          class-name="text-popup-field"
          v-if="field.type === 'text'"
          :w="350"
          :min-height="80"
          @dragstop="onDrag"
          :parent="false"
          @activated="onActivated('text')"
          :style="{ position: 'absolute', top: initialTextPositions.top+'px', left: initialTextPositions.left+'px' }"
        >
          <editor
            api-key="4qmvv323qilv57chpw6pbs6l3bfq89onfn4xr7ct7idwlnw8"
            :init="editorConfig"
            v-model="field.value"
            inline
            @blur="editingText = false"
          />
        </vue-draggable-resizable>

        <vue-draggable-resizable
          class-name="input-popup-field"
          v-if="field.type === 'input'"
          :w="350"
          :h="40"
          @dragstop="onDrag"
          :parent="false"
          @activated="onActivated('input')"
          :style="{ position: 'absolute', top: initialInputPositions.top+'px', left: initialInputPositions.left+'px' }"
        >
          <input type="text" class="form-control" :placeholder="field.placeholder">
        </vue-draggable-resizable>

        <vue-draggable-resizable
          class-name="button-popup-field"
          v-if="field.type === 'button'"
          :w="350"
          :h="40"
          @dragstop="onDrag"
          :parent="false"
          @activated="onActivated('button')"
          :style="{ position: 'absolute', top: initialButtonPositions.top+'px', left: initialButtonPositions.left+'px' }"
        >
          <button class="btn btn-dark btn-lg text-uppercase">{{ field.value }}</button>
        </vue-draggable-resizable>

      </template>

      <p class="info">
        No credit card is required. No Surprises
      </p>

    </div>
  </div>
</template>

<script>
import { StarIcon } from "@vue-hero-icons/outline";
import VueDraggableResizable from 'vue-draggable-resizable'
import Editor from '@tinymce/tinymce-vue'

export default {
  name: "Preview",
  props: {
    builderData: Array,
    bgColor: String
  },
  components: {
    StarIcon,
    VueDraggableResizable,
    'editor': Editor
  },
  data() {
    return {
      updatedBuilderData: [],
      activeType: '',
      initialStarPositions: null,
      initialTextPositions: null,
      initialInputPositions: null,
      initialButtonPositions: null,
      editingText: false,
      editorConfig: {
        height: 100,
        menubar: true,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar:
            'undo redo | formatselect | bold italic forecolor backcolor | \
            alignleft aligncenter alignright alignjustify | \
            bullist numlist outdent indent | removeformat | help'
      }
    }
  },
  created() {
    this.updatedBuilderData = this.builderData
    this.getInitialPositions()
  },
  methods: {
    onActivated(type) {
      this.activeType = type
    },
    onDrag (x, y) {
      let draggedItem = this.updatedBuilderData.find(item => this.activeType === item.type);
      if (draggedItem.type === 'star') {
        draggedItem.xPos = x + this.initialStarPositions.left;
        draggedItem.yPos = y + this.initialStarPositions.top;
      } else if (this.activeType === 'text') {
        draggedItem.xPos = x + this.initialTextPositions.left;
        draggedItem.yPos = y + this.initialTextPositions.top;
      } else if (this.activeType === 'input') {
        draggedItem.xPos = x + this.initialInputPositions.left;
        draggedItem.yPos = y + this.initialInputPositions.top;
      } else if (this.activeType === 'button') {
        draggedItem.xPos = x + this.initialButtonPositions.left;
        draggedItem.yPos = y + this.initialButtonPositions.top;
      }
    },
    getInitialPositions() {
      let starData = this.updatedBuilderData.find(item => item.type === 'star');
      let textData = this.updatedBuilderData.find(item => item.type === 'text');
      let inputData = this.updatedBuilderData.find(item => item.type === 'input');
      let buttonData = this.updatedBuilderData.find(item => item.type === 'button');

      this.initialStarPositions = { top: starData.yPos, left: starData.xPos }
      this.initialTextPositions = { top: textData.yPos, left: textData.xPos }
      this.initialInputPositions = { top: inputData.yPos, left: inputData.xPos }
      this.initialButtonPositions = { top: buttonData.yPos, left: buttonData.xPos }
    }
  },
  mounted() {
    setInterval(() => {
      this.$emit('update-builder-data', this.updatedBuilderData)
    }, 1000)
  }
}
</script>

<style scoped lang="scss">
.main-editor {
  width: 450px;
  height: 450px;
  border-radius: 100%;
  position: relative;
}
.big-star {
  width: 30px !important;
  height: 30px !important;
}
.star-popup-field {
  cursor: pointer;
}
.text-popup-field {
  cursor: pointer;
  .text-input {
    width: 100% !important;
    height: auto !important;
    background: rgba(255, 255, 255, 0);
    padding: 0;
    overflow-y: auto;
    overflow-wrap: break-word !important;
  }
}
.button-popup-field {
  .btn {
    width: 350px;
  }
}
.info {
  width: 100%;
  text-align: center;
  position: absolute;
  top: 350px;
  left: 0;
}
</style>