<template>
  <div class="container">
    <div v-if="formPopupCreated" class="row">
      <div class="col-md-12 my-4">
        <p>Form Created Successfully!</p>
        <p>Copy the code and paste it in every page above the /head</p>
        <div class="popup_url_block">
          <code>
            &lt;script id="poptin-script-id" src="http://popup-form-builder.herokuapp.com/popup.js?id={{ popupFormId }}" async="true"&gt;&lt;/script&gt;
          </code>
        </div>
      </div>
    </div>

    <div v-else class="row">
      <div class="col-md-12 my-4">
        <strong>** Note</strong>
        Each elements (star, text, input field, button) can be dragged to update position on the preview container
        <hr>
      </div>
      <div class="col-md-4">
        <FieldOptions @update-builder="updateBuilderData" />
      </div>
      <div class="col-md-6">
        <Preview :builder-data="formData" @update-builder-data="updateAllBuilderData" :bg-color="bgColor" />
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary btn-lg float-right" @click="saveFormData">Save</button>
      </div>
    </div>

  </div>
</template>

<script>
import FieldOptions from "./FieldOptions";
import Preview from "./Preview";

export default {
  name: "Index",
  components: {
    FieldOptions,
    Preview,
  },
  data() {
    return {
      formData: [
        {
          type: 'star'
        },
        {
          type: 'text',
          color: '#FFFFFF',
          value: 'This is the default header text.'
        },
        {
          type: 'input',
          placeholder: 'Email'
        },
        {
          type: 'button',
          value: 'Signup Now'
        }
      ],
      bgColor: '#E85E5C',
      formPopupCreated: false,
      popupFormId: ''
    }
  },
  methods: {
    updateAllBuilderData(data) {
      this.formData = data
    },
    updateBuilderData(data) {
      if (data.type === 'text') {
        this.formData.find(item => {
          if (item.type === 'text') {
            item.color = data.data.textColor
            item.value = data.data.textValue
          }
        })
      } else if (data.type === 'bg') {
        this.bgColor = data.data.bgColor
      }
    },
    saveFormData() {
      axios.post('/api/forms', {
        'name': 'Poptin Form',
        'data': JSON.stringify(this.formData),
        'bg_color': this.bgColor
      }).then(res => {
        this.formPopupCreated = true;
        this.popupFormId = res.data.id
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
.popup_url_block {
  border: 1px solid #E85E5C;
}
</style>