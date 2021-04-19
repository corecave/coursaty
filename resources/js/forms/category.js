import validator from "validator";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (category) => ({
    ...validation,
    ...notification,

    title: "Station" + (category ? ` "${category.name}"` : " Form"),
    form: {
        id: category ? category.id : "",
        name: category ? category.name : "",
        notes: category ? category.notes : "",
        active: category ? category.active : "",
    },

    validate(field) {
        switch (field) {
            case "name":
                if (!this.form.name.trim()) {
                    this.pushError("name", "Name is required.");
                }

                break;
            case "active":
                if (this.form.active.length == 0) {
                    this.pushError("active", "Status is required.");
                }

                if (
                    this.form.active.length != 0 &&
                    !validator.isIn(this.form.active.toString(), ["1", "0"])
                ) {
                    this.pushError("active", "Status is invalid.");
                }

                break;
            case "notes":
                if (
                    this.form.notes.trim() &&
                    !validator.isLength(this.form.notes.trim(), {
                        max: 2000,
                        min: 30,
                    })
                ) {
                    this.pushError(
                        "notes",
                        "Notes should be (30 - 2000) in length."
                    );
                }

                break;
        }
    },

    async submit() {
        if (!this.hasErrors()) {
            try {
                let resp;

                if (!this.form.id) {
                    resp = await axios.post(API.category.store, this.form);
                } else {
                    resp = await axios.put(
                        API.category.update.replace(/ID/, this.form.id),
                        this.form
                    );
                }

                if (resp.data.success) {
                    this.success("Data saved successfully");
                    setTimeout(() => {
                        location.href = API.category.index;
                    }, 1500);
                } else {
                    this.error(resp.data.msg);
                }
            } catch (error) {
                this.catch(error);
            }
        }
    },
});
