<template>
  <div class="container">
    <div v-if="formPopupCreated" class="row">
      <div class="col-md-12 my-4">
        <div class="alert alert-success" role="alert">
          <p>Copy the code and paste it in every page above the /head</p>
          <div>
            <code>
              &lt;script id="poptin-script-id"
              src="https://popup-form-builder.herokuapp.com/popup.js?id={{
                popupFormId
              }}" async="true"&gt;&lt;/script&gt;
            </code>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 my-4">
        <strong>** Note</strong>
        Each elements (star, text, input field, button) can be dragged
        to update position on the preview container
        <hr/>
      </div>
      <div class="col-md-4">
        <FieldOptions @update-builder="updateBuilderData"/>
      </div>
      <div class="col-md-6">
        <Preview
            v-if="formData.length > 0"
            :builder-data="formData"
            @update-builder-data="updateAllBuilderData"
            :bg-color="bgColor"
        />
      </div>
      <div class="col-md-2">
        <button
            v-if="formPopupCreated"
            class="btn btn-primary btn-lg float-right"
            @click="updateFormData"
        >
          Update
        </button>
        <button
            v-else
            class="btn btn-primary btn-lg float-right"
            @click="saveFormData"
        >
          Save
        </button>
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
    Preview
  },
  data() {
    return {
      formData: [],
      bgColor: "#E85E5C",
      formPopupCreated: false,
      popupFormId: "",
    };
  },
  methods: {
    updateAllBuilderData(data) {
      this.formData = data;
    },
    updateBuilderData(data) {
      if (data.type === "text") {
        this.formData.find(item => {
          if (item.type === "text") {
            item.color = data.data.textColor;
            item.value = data.data.textValue;
          }
        });
      } else if (data.type === "bg") {
        this.bgColor = data.data.bgColor;
      }
    },
    saveFormData() {
      axios
          .post("/api/forms", {
            name: "Poptin Form",
            data: JSON.stringify(this.formData),
            bg_color: this.bgColor
          })
          .then(res => {
            this.formPopupCreated = true;
            this.popupFormId = res.data.id;
            window.localStorage.setItem('popupFormId', res.data.id);
          })
          .catch(error => {
            console.log(error);
          });
    },
    updateFormData() {
      axios
          .put(`/api/forms/${this.popupFormId}`, {
            name: "Poptin Form",
            data: JSON.stringify(this.formData),
            bg_color: this.bgColor
          })
          .then(res => {
            this.formData = JSON.parse(res.data.data)
          })
          .catch(error => {
            console.log(error);
          });
    },
    getFormData() {
      axios
          .get(`/api/forms/${this.popupFormId}`)
          .then(res => {
            this.formData = JSON.parse(res.data.data)
          })
          .catch(error => {
            console.log(error);
          });
    }
  },
  created() {
    let getPopupFormId = window.localStorage.getItem('popupFormId');
    if (getPopupFormId) {
      this.formPopupCreated = true
      this.popupFormId = getPopupFormId
      this.getFormData()
    } else {
      this.formData = [
        {
          type: "star",
          xPos: 172,
          yPos: 50,
        },
        {
          type: "text",
          color: "#FFFFFF",
          value: "This is the default header text.",
          xPos: 50,
          yPos: 120,
        },
        {
          type: "input",
          placeholder: "Email",
          xPos: 50,
          yPos: 220,
        },
        {
          type: "button",
          value: "Signup Now",
          xPos: 50,
          yPos: 280,
        }
      ]
    }
  }
};
</script>

<style scoped>
.popup_url_block {
  border: 1px solid #e85e5c;
}
</style>
