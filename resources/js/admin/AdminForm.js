class AdminForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data() {
        return Object.keys(this.originalData).reduce((data, attribute) => {
            data[attribute] = this[attribute];

            return data;
        }, {});
    }

    post(endpoint) {
        return this.submit(endpoint);
    }

    put(endpoint) {
        return this.submit(endpoint, 'put');
    }

    delete(endpoint) {
        return this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        this.submitted = true;

        return axios[requestType](endpoint, this.data())
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    submitFormData(endpoint, requestType = 'post') {
        this.submitted = true;

        const formData = new FormData();

        const form = Object.keys(this.originalData).reduce((data, attribute) => {
            formData.append(attribute, this[attribute]);

            return formData;
        }, {});

        if (requestType == 'PUT' || 'PATCH') {
            // laravel/php bug solution for put endpoint using FormData
            formData.append("_method", "PUT");

            requestType = "post";

            // if banner state is not a File type
            if (!(this.banner instanceof File)) {
                formData.delete('banner');
            }
        }

        return axios[requestType](endpoint, form, {
            headers: { "Content-Type": "multipart/form-data" }
        })
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = false;
        this.reset();
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;

        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default AdminForm;
