//Event handling root
window.VueEventHandler = new class {

  constructor() {
    this.vue = new Vue();
  }

  fire(event, data = null) {
    this.vue.$emit(event, data);
  }

  listen(event, callback) {
    this.vue.$on(event, callback);
  }

}

// Errors class
window.VueErrorsHandler = class {

  /**

  * Create New Errors instance

  */

  constructor() {

    this.errors = {};

  }

  /**

  * Determine if errors existing for a given field

  *

  * @param {string} field

  */

  has(field) {

    return this.errors.hasOwnProperty(field);

  }

  /**

  * Determine if we have any errors

  */

  any() {

    return Object.keys(this.errors).length > 0;

  }

  /**

  * Retrieve error messages for a field

  *

  * @param {string} field

  */
  get(field) {

    if (this.errors[field]) {

    return this.errors[field][0];

    }

  }

  /**

  * Record the New errors

  *

  * @param {object} errors

  */
  record(errors) {
    this.errors = errors;

  }

  /**

  * Clear one or all error fields.

  *

  * @param {string|null} field

  */
  clear(field) {

    if (field) {

      delete this.errors[field];

      return;
    }

    this.errors = {};

  }

}

// Vue Form
window.VueForm = class {

  /**

  * Create New form object

  *

  * @param {object} data

  */

  constructor(data) {
    this.originalData = data;

    // Set data as attributes
    for (let field in data) {

      this[field] = data[field];

    }


    // Set form error handler
    this.errors = new VueErrorsHandler();

  }

  /**

  * Fetch all relevent data of the form.

  */

  data() {

    let data = {};

    for (let property in this.originalData) {

      data[property] = this[property];

    }


    return data;
  }

  /**

  * Reset the form details.

  */
  reset() {

    for (let field in this.originalData) {

      this[field] = '';

    }


    // Clear errors
    this.errors.clear();

  }

  /**

  * Submit the form.

  *

  * @param {string} requestType

  * @param {string} url

  */

  submit(requestType, url) {

    return new Promise((resolve, reject) => {

      axios[requestType](url, this.data())

           .then(response => {

             this.onSuccess(response.data);

             resolve(response.data);

           })

           .catch(error => {
             this.onFail(error.response.data.errors);

             reject(error.response.data.errors);

           })

    });
  }

  /**

  * Handle a successful form submission.

  *

  * @param {object} data

  */

  onSuccess(data) {


    // Reset form inputs
    this.reset();

  }

  /**

  * Handle failed form submission

  *

  * @param {object} error

  */

  onFail(error) {
    this.errors.record(error);

  }


  post(url) {

    return this.submit('post', url);

  }


  delete(url) {
    return this.submit('delete', url);
  }


}

// Set localization
Vue.prototype.trans = string => lodashLib.get(window.i18n, string);

// Vue Root
const app = new Vue({
  el: '#vue-app',
  data() {
    return {
      isVisible: false
    }
  }
});
