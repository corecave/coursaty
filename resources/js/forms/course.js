import validator from "validator";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (course) => ({
    ...validation,
    ...notification,

    title: "Course" + (course ? ` "${course.title}"` : " Form"),
    form: {
        id: course ? course.id : "",
        title: course ? course.title : "",
        author: course ? course.author : "",
        level: course ? course.level : "",
        description: course ? course.description : "",
        category_id: course ? course.category_id : "",
        category: course ? course.category : "",
        rating: course ? course.rating : "",
        views: course ? course.views : "",
        hours: course ? course.hours : "",
        active: course ? course.active : "",
    },

    init() {
        $(".categories-data-ajax").select2({
            ajax: {
                url: API.category.index,
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        draw: Math.random() * 100,
                        columns: [{ data: "id" }, { data: "name" }],
                        order: [{ column: 0, dir: "desc" }],
                        search: { value: params.term }, // search term
                        start: 0,
                        length: 10,
                        _: Date.now(),
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: params.page * 30 < data.recordsTotal,
                        },
                    };
                },
                cache: true,
            },
            placeholder: "Search for a category",
            minimumInputLength: 1,
            templateResult: formatCategory,
            templateSelection: formatCategorySelection,
        });

        function formatCategory(category) {
            if (category.loading) {
                return category.text;
            }

            var $container = $(
                "<div class='select2-result-category clearfix'>" +
                    "<div class='select2-result-category__meta'>" +
                    "<div class='select2-result-category__title'></div>" +
                    "<div class='select2-result-category__description'></div>" +
                    "</div>" +
                    "</div>"
            );

            $container
                .find(".select2-result-category__title")
                .text(category.name);
            $container
                .find(".select2-result-category__description")
                .text(category.notes);

            return $container;
        }

        function formatCategorySelection(category) {
            return category.name || category.text;
        }

        this.$refs.selectedCategory.onchange = (e) => {
            this.form.category_id = e.target.value;
            this.V(e);
        };

        this.initV();
    },

    validate(field) {
        switch (field) {
            case "name":
                if (!this.form.name.trim()) {
                    this.pushError("name", "Name is required.");
                }

                break;
            case "category_id":
                if (this.form.category_id.length == 0) {
                    this.pushError("category_id", "Category is required.");
                }

                break;
            case "views":
                if (this.form.views.length == 0) {
                    this.pushError("views", "Views count is required.");
                }

                if (
                    this.form.views.length != 0 &&
                    (this.form.views < 0 ||
                        !validator.isInt(this.form.views.toString()))
                ) {
                    this.pushError(
                        "views",
                        "Views count should be a positive integer number."
                    );
                }
            case "hours":
                if (this.form.hours.length == 0) {
                    this.pushError("hours", "Hours count is required.");
                }

                if (
                    this.form.hours.length != 0 &&
                    (this.form.hours < 0 ||
                        !validator.isInt(this.form.hours.toString()))
                ) {
                    this.pushError(
                        "hours",
                        "Hours count should be a positive integer number."
                    );
                }

                break;
            case "rating":
                if (this.form.rating.length == 0) {
                    this.pushError("rating", "Rating count is required.");
                }

                if (
                    this.form.rating.length != 0 &&
                    (this.form.rating < 0 ||
                        !validator.isInt(this.form.rating.toString()))
                ) {
                    this.pushError(
                        "rating",
                        "Rating count should be a positive integer number."
                    );
                }

                break;
            case "level":
                if (!this.form.level.trim()) {
                    this.pushError("level", "Level is required.");
                }

                if (
                    this.form.level.length != 0 &&
                    !validator.isIn(this.form.level, [
                        "beginner",
                        "immediate",
                        "high",
                    ])
                ) {
                    this.pushError("level", "Selected level is invalid.");
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
            case "description":
                if (
                    this.form.description.trim() &&
                    !validator.isLength(this.form.description.trim(), {
                        max: 2000,
                        min: 30,
                    })
                ) {
                    this.pushError(
                        "description",
                        "Description should be (30 - 2000) in length."
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
                    resp = await axios.post(API.course.store, this.form);
                } else {
                    resp = await axios.put(
                        API.course.update.replace(/ID/, this.form.id),
                        this.form
                    );
                }

                if (resp.data.success) {
                    this.success("Data saved successfully");
                    setTimeout(() => {
                        location.href = API.course.index;
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
