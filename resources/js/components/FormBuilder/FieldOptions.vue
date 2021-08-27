<template>
  <div>
    <div class="select-element-container">
      <div>
        <a class="btn btn-primary btn-block" data-toggle="collapse" href="#collapseFieldOptions" role="button" aria-expanded="false" aria-controls="collapseFieldOptions">
          Update elements
          <ChevronDownIcon />
        </a>
      </div>
      <div class="collapse" id="collapseFieldOptions">
        <div class="card card-body">
          <div class="mt-2">
            <div>
              <a class="btn btn-light btn-block" data-toggle="collapse" href="#collapseText" role="button" aria-expanded="false" aria-controls="collapseText">
                Text
                <ChevronDownIcon />
              </a>
            </div>
            <div class="collapse" id="collapseText">
              <div class="card card-body">
                <input type="text" v-model="textData.textValue" required>
                <h6 class="mt-2">Select Color</h6>
                <color-picker
                  :color="textData.textColor"
                  :sucker-hide="false"
                  @changeColor="changeTextColor"
                />
                <button class="btn btn-primary btn-sm mt-2" @click="updateBuilder('text')">Update</button>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div>
              <a class="btn btn-light btn-block" data-toggle="collapse" href="#collapseBackground" role="button" aria-expanded="false" aria-controls="collapseBackground">
                Background color
                <ChevronDownIcon />
              </a>
            </div>
            <div class="collapse" id="collapseBackground">
              <div class="card card-body">
                <color-picker
                  :color="bgData.bgColor"
                  :sucker-hide="false"
                  @changeColor="changeBgColor"
                />
                <button class="btn btn-primary btn-sm mt-2" @click="updateBuilder('bg')">Update</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ChevronDownIcon } from "@vue-hero-icons/outline";
import colorPicker from '@caohenghu/vue-colorpicker'
export default {
  name: "FieldOptions",
  components: {
    ChevronDownIcon,
    colorPicker,
  },
  data() {
    return {
      textData: {
        textColor: '#FFFFFF',
        textValue: 'This is the default header text.'
      },
      bgData: {
        bgColor: '#E85E5C',
      }
    }
  },
  methods: {
    changeTextColor(color) {
      this.textData.textColor = color.hex
    },
    changeBgColor(color) {
      this.bgData.bgColor = color.hex
    },
    updateBuilder(type) {
      const payload = {
        type,
        data: type === 'text' ? this.textData : this.bgData
      }
      this.$emit('update-builder', payload)
    }
  }
}
</script>

<style scoped lang="scss">
.element-block {
  border: 1px solid #3490DC;
  margin-bottom: 10px;
  border-radius: 10px;
  padding: 4px;

  .plus-icon {
    width: 20px;
    height: 20px;
  }
}
</style>