let scriptTag = document.getElementById('poptin-script-id');
let scriptTagSrc = scriptTag.src;
const scriptTagSrcSplit = scriptTagSrc.split("?id=");
let formId = scriptTagSrcSplit[1]

// let textValue = ''
// let textColor = ''
// let bgData = ''

// Creating the XMLHttpRequest object
let request = new XMLHttpRequest();

// Instantiating the request object
// request.open("GET", `http://poptin-task.test/api/forms/${formId}`);

request.open("GET", `http://popup-form-builder.herokuapp.com/api/preview/form/${formId}`);
request.onreadystatechange = function() {
  // Check if the request is compete and was successful
  if(this.readyState === 4 && this.status === 200) {
    setTimeout(() => getFormPreview(this.responseText), 1000)
  }
};
request.send();

function getFormPreview (data) {
  let formPopup = document.createElement("div");
  formPopup.id = 'form_popup_id';
  formPopup.innerHTML = data;
  document.body.appendChild(formPopup);
}

function closeModal() {
  let poptin_popup_dialog = document.getElementById('poptin-popup-dialog')
  poptin_popup_dialog.style.display = 'none'
}