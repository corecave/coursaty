import validator from "validator";
import notification from "../mixins/notification";
import { serialize } from "object-to-formdata";

export default () => ({
    ...notification,

    filters: {
        title: "",
        category: "",
        rating: "",
        hours: [],
        levels: [],
    },
    categoryRequest: {
        start: 0,
        length: 5,
        loadmore: true,
        loading: false,
    },
    categories: [
        {
            id: "",
            name: "All Categories",
            notes: "",
        },
    ],

    courseRequest: {
        start: 0,
        length: 9,
        loadmore: true,
        loading: false,
    },
    courses: [],

    init() {
        this.filters.category = this.categories[0];
        this.loadCategories();
        this.loadCourses();

        for (let filter in this.filters) {
            this.$watch(filter, (v) => {
                (this.courseRequest.start = 0), (this.courses = []);
                this.loadCourses();
            });
        }
    },

    async loadCategories() {
        const payload = (start) => ({
            draw: Math.random() * 100,
            columns: [{ data: "id" }, { data: "name" }, { data: "notes" }],
            active: 1,
            start,
            length: this.categoryRequest.length,
            _: Date.now(),
        });

        try {
            this.categoryRequest.loading = true;
            let resp = await axios.get(
                `${API.category.index}?${new URLSearchParams(
                    serialize(payload(0))
                ).toString()}&${new URLSearchParams(
                    serialize(payload(this.categoryRequest.start))
                ).toString()}`
            );

            this.categoryRequest.loadmore =
                resp.data.recordsFiltered > this.categories.length;

            if (resp.data.recordsFiltered == this.categoryRequest.length) {
                this.categories = resp.data.data;
            } else {
                for (let i = 0; i < resp.data.data.length; i++) {
                    const c = resp.data.data[i];
                    this.categories.push(c);
                }

                this.categoryRequest.start += this.categoryRequest.length;
            }
        } catch (err) {
            this.catch(err);
        } finally {
            this.categoryRequest.loading = false;
        }
    },
    async loadCourses() {
        const payload = (start) => ({
            draw: Math.random() * 100,
            columns: [
                { data: "id" },
                { data: "title" },
                { data: "description" },
                { data: "rating" },
                { data: "hours" },
                { data: "level" },
                { data: "category", name: "categores.name" },
            ],
            order: [{ column: 0, dir: "desc" }],
            active: 1,
            start,
            ...this.filters,
            category_id: this.filters.category.id,
            length: this.courseRequest.length,
            _: Date.now(),
        });

        try {
            this.courseRequest.loading = true;
            let resp = await axios.get(
                `${API.course.index}?${new URLSearchParams(
                    serialize(payload(0))
                ).toString()}&${new URLSearchParams(
                    serialize(payload(this.courseRequest.start))
                ).toString()}`
            );

            this.courseRequest.loadmore =
                resp.data.recordsFiltered > this.courses.length;

            if (resp.data.recordsFiltered == this.courseRequest.length) {
                this.courses = resp.data.data;
            } else {
                for (let i = 0; i < resp.data.data.length; i++) {
                    const c = resp.data.data[i];
                    this.courses.push(c);
                }

                this.courseRequest.start += this.courseRequest.length;
            }
        } catch (err) {
            this.catch(err);
        } finally {
            this.courseRequest.loading = false;
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
